

composer内存超出处理：  
处理方法： 
https://stackoverflow.com/questions/49212475/composer-require-runs-out-of-memory-php-fatal-error-allowed-memory-size-of-161  

composer2貌似已经解决了该问题，不过考虑到composer2还不是很成熟，先忽略   
composer install -vvv    

```bat
@echo OFF
:: in case DelayedExpansion is on and a path contains ! 
setlocal DISABLEDELAYEDEXPANSION
php -d memory_limit=-1 "%~dp0composer.phar" %*
```

