yii2-rsa
========

composer.json
-----
```json
"require": {
    "mikeching/yii2-rsa": "*"
},
```

example:
-----
```php
use mikeching\rsa\Rsa;

//init
set private and public key to you common/config/params.php
$str = 'yii2-rsa';

//private encrypt -> public decrypt
$enStr = Rsa::rsaPrivateEncrypt($str);
echo $enStr;
$deStr = Rsa::rsaPublicDecrypt($enStr);
echo $deStr;

//public encrypt -> private decrypt
$enStr = Rsa::rsaPublicEncrypt($str);
echo $enStr;
$deStr = Rsa::rsaPrivateDecrypt($enStr);
echo $deStr;

