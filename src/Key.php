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
       $keyHex = bin2hex(random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES));
       return base64_encode(hex2bin($keyHex));
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

   public function getKey(): string
   {
       $rootDir = dirname(__DIR__, 1);
       $envFile = $rootDir . '/.env';

// Vérifier si le fichier .env existe
       if (!file_exists($envFile)) {
           throw new \Exception('Le fichier .env est introuvable.');
       }

// Lire le fichier .env ligne par ligne
       $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Extraire la clé de cryptage
       $key = null;
       foreach ($lines as $line) {
           if (strpos($line, 'ENCRYPTION_KEY=') === 0) {
               $key = substr($line, strlen('ENCRYPTION_KEY='));
               break;
           }
       }

// Vérifier que la clé a été trouvée
       if (empty($key)) {
           throw new \Exception('La clé de cryptage est manquante dans le fichier .env.');
       }
       return $key;
   }

}