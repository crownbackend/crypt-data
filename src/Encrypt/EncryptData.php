<?php

namespace Crownbackend\CryptoPackage\Encrypt;

use Crownbackend\CryptoPackage\Contracts\CryptInterface;

class EncryptData implements CryptInterface
{
    private $key;
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @throws \SodiumException
     */
    public function encrypt(string $data): string
    {
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $encrypted = sodium_crypto_secretbox($data, $nonce, base64_decode($this->key));
        $combined = $nonce . $encrypted;
        return base64_encode($combined);
    }

    public function decrypt(string $data): string
    {
        return 'tets';
    }
}