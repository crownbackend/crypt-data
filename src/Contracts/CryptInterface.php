<?php

namespace Crownbackend\CryptoPackage\Contracts;

interface CryptInterface
{
    public function encrypt(string $data): string;
    public function decrypt(string $data): string;
}