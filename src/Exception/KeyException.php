<?php

namespace Crownbackend\CryptoPackage\Exception;

use Exception;

class KeyException extends Exception
{
    protected $message = 'Encryption key already exists.';
    protected $code = 500;
}