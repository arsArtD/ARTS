

## 使用方法

php artisan key:generate

## 加密解密的文件位置：
vendor/illuminate/encryption/
EncryptionServiceProvider Encrypter

## 分析 EncryptionServiceProvider
```
  public function register()
    {
        $this->app->singleton('encrypter', function ($app) {
            $config = $app->make('config')->get('app'); //从config/app.php里拿到配置文件

            if (Str::startsWith($key = $config['key'], 'base64:')) { //分析配置文件里的key里面有没有带'base64'
                $key = base64_decode(substr($key, 7));   //如果有的话，把key前面的base64:给取消，并且解析出原来的字符串
            }

            return new Encrypter($key, $config['cipher']);  //实例化Encrypte类，注入到框架里
        });
    }
```


## 分析 Encrypter文件

### 构造函数分析
```
    public function __construct($key, $cipher = 'AES-128-CBC')
    {
        $key = (string) $key;  //把key转换为字符串

        if (static::supported($key, $cipher)) {  //调用一个自定义的方法，用来判断加密方式和要求的key长度是否一样
            $this->key = $key;
            $this->cipher = $cipher;
        } else {
            throw new RuntimeException('The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths.');
        }
    }
    
```

```
    public static function supported($key, $cipher)
    {
        $length = mb_strlen($key, '8bit'); //判断key的字符的长度，按照8bit位的方式计算字符长度

        return ($cipher === 'AES-128-CBC' && $length === 16) ||
               ($cipher === 'AES-256-CBC' && $length === 32);   //编码格式为AES128的要求字符长度为16。编码格式为AES256的要求字符长度为32位
    }
```

### 分析 encrypt方法 
```
  public function encrypt($value, $serialize = true)
    {
        $iv = random_bytes(16); //生成一个16位的随机字符串
        
        
        // 使用openssl_encrypt把数据生成一个加密的数据
        // 1、判断需要不需要生成一个可存储表示的值，这样做是为了不管你的数据是数组还是字符串都能给你转成一个字符串，不至于在判断你传过来的数据是数组还是字符串了。
        // 2、使用openssl_encrypt。第一个参数是传入数据，第二个参数是传入加密方式，目前使用AES-256-CBC的加密方式，第三个参数是，返回加密后的原始数据，还是把加密的数据在经过一次base64的编码，0的话表示base64位数据。第四个参数是项量，这个参数传入随机数，是为了在加密数据的时候每次的加密数据都不一样。
        $value = \openssl_encrypt(
            $serialize ? serialize($value) : $value,
            $this->cipher, $this->key, 0, $iv
        );  //使用AES256加密内容

        if ($value === false) {
            throw new EncryptException('Could not encrypt the data.');
        }

        $mac = $this->hash($iv = base64_encode($iv), $value);  //生成一个签名，用来保证内容参数没有被更改

        $json = json_encode(compact('iv', 'value', 'mac'));  //把随机码，加密内容，已经签名，组成数组，并转成json格式

        if (! is_string($json)) {
            throw new EncryptException('Could not encrypt the data.');
        }

        return base64_encode($json);  //把json格式转换为base64位，用于传输
    }
    
```
```
  protected function hash($iv, $value)
    {
        // 生成签名
        // 1、把随机值转为base64
        // 2、使用hash_hmac生成sha256的加密值，用来验证参数是否更改。第一个参数表示加密方式，目前是使用sha256，第二个是用随机值连上加密过后的内容进行，第三个参数是上步使用的key。生成签名。
        return hash_hmac('sha256', $iv.$value, $this->key);  /根据随机值和内容，生成一个sha256的签名
    }
    
```

### 分析 decrypt方法

```
public function decrypt($payload, $unserialize = true)
    {
        $payload = $this->getJsonPayload($payload);  //把加密后的字符串转换出成数组。

        $iv = base64_decode($payload['iv']);   //把随机字符串进行base64解密出来

        $decrypted = \openssl_decrypt(  //解密数据
            $payload['value'], $this->cipher, $this->key, 0, $iv
        );

        if ($decrypted === false) {
            throw new DecryptException('Could not decrypt the data.');
        }

        return $unserialize ? unserialize($decrypted) : $decrypted; //把数据转换为原始数据
    }
```

```
   protected function getJsonPayload($payload)
    {
        $payload = json_decode(base64_decode($payload), true); //把数据转换为原来的数组形式

        if (! $this->validPayload($payload)) {  //验证是不是数组以及数组里有没有随机字符串，加密后的内容，签名
            throw new DecryptException('The payload is invalid.');
        }

        if (! $this->validMac($payload)) {  //验证数据是否被篡改
            throw new DecryptException('The MAC is invalid.');
        }

        return $payload;
    }
```

```
   protected function validMac(array $payload)
    {
        $calculated = $this->calculateMac($payload, $bytes = random_bytes(16));  //拿数据和随机值生成一个签名

        return hash_equals( //比对上一步生成的签名和下面生成的签名的hash是否一样。
            hash_hmac('sha256', $payload['mac'], $bytes, true), $calculated  //根据原始数据里的签名在新生成一个签名
        );
    }

```

```
    protected function calculateMac($payload, $bytes)
    {
        return hash_hmac(
            'sha256', $this->hash($payload['iv'], $payload['value']), $bytes, true
        );
    }

```
以上解密共分了三大步   
1、判断数据的完整性  
2、判断数据的一致性  
3、解密数据内容。  

这个验证签名有个奇怪的地方，他并不像我们平常验证签名一样。我们平常验证签名都是，拿原始数据和随机值生成一个签名，  
然后拿生成的签名和原始数据的签名进行比对来判断是否有被篡改。  
而框架却多了一个，他用的是，通过原始数据和随机值生成签名后，又拿这个签名生成了一个签名，  
而要比对的也是拿原始数据里的签名在生成一个签名，然后进行比对。目前想不出，为什么要多几步操作。  
在加密的时候，我们把原始数据使用 serialize转换了一下，所以我们相应的也需要使用 unserialize把数据转换回来。  

注意

加密时使用的openssl_encrypt里的随机项量值是使用的原始数据raw这种二进制的值，   
使用openssl_decrypt解密后的值是使用的经过base64位后的随机字符串。  

解密的时候生成签名比较的时候，不是用原来的签名，然后根据原始数据的内容，重新生成一次签名进行比较，  
而是使用原始签名为基础生成一个签名，然后在拿原始数据为基础生成的签名，在用这个新生成的签名重新生成了一次签名。然后进行比较的。  

AES256是加密数据，后面能够逆向在进行解密出数据。而SHA256是生成签名的，这个过程是不可逆的，是为了验证数据的完整性。  
