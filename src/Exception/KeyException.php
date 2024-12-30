<?php

namespace Crownbackend\CryptoPackage\Exception;

class KeyException extends \Exception
{
    protected $message = 'Encryption key already exists.';

    protected $code = 500;
}