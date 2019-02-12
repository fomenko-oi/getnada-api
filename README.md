Simple library for reading emails from inbox getnada.com

## Install
For install use composer, and call in the command line:
`composer require fomenko-oi/getnada-api`


## Basic usage of the lib
```php
<?php 
require __DIR__ . '/vendor/autoload.php';

use Truehero\Getnada;

$getnada = new Getnada();
```


### OR with custom configured client
```php
$api_version = 1;
$client = new \Truehero\CommonClient($api_version);
//$client->setUserAgent('Custom UA');
//$client->setHeaders(['Custom-Header' => 'Custom Header Value']);
//$client->setProxy('121.100.26.6');

$getnada = new Getnada($client);
```

### Get list of available domains
```php
$domains = $getnada->domains();

foreach ($domains as $domain) {
    echo 'Name: ' . $domain->getName();
    echo 'ID: ' . $domain->getId();
}
```

### Get list of messages by inbox name
```php
$email = 'hardcodedemail@getnada.com';
$box = $getnada->inbox($email);

foreach($box as $message) {
    echo 'ID: ' . $message->getId();
    echo 'From: ' . $message->getFrom();
    echo 'To: ' . $message->getTo();
    echo 'Date: ' . $message->getDate()->format('d-m-Y H:i:s');
    // echo $message->getDate()->getDate(); - date with default format
    echo 'Message: ' . $message->getMessage();
}
```

### Get attaches of message
```php
// directory, where we want to save attaches
$saveDir = __DIR__ . '/storage';

foreach($box as $message) {
   echo 'ID: ' . $message->getId();
   // ...
   echo 'Message: ' . $message->getMessage();

   // Check, if message has attaches
   if($message->hasAttaches()) {
       foreach($message->getAttaches() as $attach) {
           $file = $getnada->downloadFile($message, $attach, $saveDir);

           echo 'File was saved by path: ' . $file;
           
           echo 'Name: ' . $attach->getName();
           echo 'ID: ' . $attach->getId();
           echo 'Type: ' . $attach->getType();
           echo 'Size: ' . $attach->getSize()->format();
           echo 'Total Attaches: ' . $message->countAttaches();
       }
   }
}
```

### Helper for generate a random email name
```php
$email = $getnada->randomEmail($getnada->domains());
$box = $getnada->inbox($email);
// ...
```

### Get info about new unread messages
```php
if($getnada->hasNew($email)) {
    // mailbox has new unread messages   
}
```
