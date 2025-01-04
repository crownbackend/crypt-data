<?php

require './vendor/autoload.php';

echo '<pre>';
$key = new \Crownbackend\CryptoPackage\Key();
$crypto = new \Crownbackend\CryptoPackage\Encrypt\EncryptData($key->getKey());
$data = 'salut les gens';
$result = $crypto->encrypt($data);
var_dump($result);

echo '</pre>';