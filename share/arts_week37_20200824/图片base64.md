
# 图片base64的几种处理方法


## 图片本地化存储
```
$bin = base64_decode($base64Info);
// Load GD resource from binary data
$im = imageCreateFromString($bin);
// Make sure that the GD library was able to load the image
// This is important, because you should not miss corrupted or unsupported images
if (!$im) {
    die('Base64 value is not a valid image');
}
// Specify the location where you want to save the image
$img_file = '/test.png';
// Save the GD resource as PNG in the best possible quality (no compression)
// This will strip any metadata or invalid contents (including, the PHP backdoor)
// To block any possible exploits, consider increasing the compression level
imagepng($im, $img_file, 0);
```

## 返回图片的base64字符串，适合接口返回 
```
header("Content-type: image/jpeg");
$base64 = 'data:image/png;base64,'.$base64Info;
echo $base64;
```

## 直接输出图片
```
$bin = base64_decode($base64Info);
header("Content-type: image/jpeg");
echo $bin;
```
