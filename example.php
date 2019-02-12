<?php

require __DIR__ . '/vendor/autoload.php';

use Truehero\Getnada;

//$client = new \Truehero\CommonClient(1);
//$client->setUserAgent('Custom UA');
//$client->setHeaders(['Custom-Header' => 'Custom Header Value']);
//$client->setProxy('121.100.26.6');
//$getnada = new Getnada($client);

$getnada = new Getnada();

$email = 'lunyzeq@getnada.com';
//$email = $getnada->randomEmail($getnada->domains());

$domains = $getnada->domains();
foreach ($domains as $domain) {
    echo 'Name: ' . $domain->getName();
    echo 'ID: ' . $domain->getId();
}

$box = $getnada->inbox($email);

// save attaches to dir
$saveDir = __DIR__ . '/storage';

foreach($box as $message) {
    echo 'ID: ' . $message->getId();
    echo 'From: ' . $message->getFrom();
    echo 'To: ' . $message->getTo();
    echo 'Date: ' . $message->getDate()->format('d-m-Y H:i:s');
    // echo $message->getDate()->getDate(); - date with default format
    echo 'Message: ' . $message->getMessage();

    if($message->hasAttaches()) {
        foreach($message->getAttaches() as $attach) {
            $file = $getnada->downloadFile($message, $attach, $saveDir);

            echo 'File was saved by path: ' . $file;
            echo '<hr>';
            echo 'Name: ' . $attach->getName();
            echo 'ID: ' . $attach->getId();
            echo 'Type: ' . $attach->getType();
            echo 'Size: ' . $attach->getSize()->format();
            echo 'Total Attaches: ' . $message->countAttaches();
        }
    }
}

if($getnada->hasNew($email)) {
    echo $email . ' has new messages';
}
