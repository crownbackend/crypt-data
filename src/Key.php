<?php

namespace Crownbackend\CryptoPackage;

use Crownbackend\CryptoPackage\Exception\KeyException;

class Key
{
    /**
     * @return string
     */
   private function generateKey(): string
   {
       return bin2hex(random_bytes(64));
   }

    /**
     * @return void
     * @throws KeyException
     */
   public function ensureEnvFileExists()
   {
       $rootDir = dirname(__DIR__, 1);
       $envFile = $rootDir . '/.env';

       if (!file_exists($envFile)) {
           file_put_contents($envFile, '');
       }

       $envContent = file_get_contents($envFile); // Lit le contenu actuel

       if (strpos($envContent, 'ENCRYPTION_KEY=') !== false) {

           throw new KeyException();
       }

       file_put_contents($envFile, "ENCRYPTION_KEY={$this->generateKey()}\n", FILE_APPEND);
   }

}

try {
    $key = new Key();
    $key->ensureEnvFileExists();
} catch (KeyException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
