<?php
declare(strict_types=1);

namespace Core;

class Security
{
    protected $plaintext = "message to be encrypted";
    protected $cipher = "aes-128-gcm";
    protected $key = "";

    public function __construct()
    {
        switch (PHP_OS) {
            case 'Linux':
                shell_exec('wmic bios get serialnumber 2>&1');
                break;
            case 'WINNT':
                $this->key = trim(explode("\n", shell_exec('wmic bios get serialnumber 2>&1'))[1], "\t\n\r\0\x0B ");
                var_dump($this->key);
                break;
        }
    }

//    public function encrypt($plaintext){
//        if (in_array($cipher, openssl_get_cipher_methods()))
//        {
//            $ivlen = openssl_cipher_iv_length($cipher);
//            $iv = openssl_random_pseudo_bytes($ivlen);
//            $ciphertext = openssl_encrypt($plaintext, self::$cipher, self::$key, $options=0, $iv, $tag);
//            //store $cipher, $iv, and $tag for decryption later
//            $original_plaintext = openssl_decrypt($ciphertext, self::$cipher, self::$key, $options=0, $iv, $tag);
//            echo $original_plaintext."\n";
//        }
//    }
//
//    public function decrypt($plaintext){
//        if (in_array($cipher, openssl_get_cipher_methods()))
//        {
//            $ivlen = openssl_cipher_iv_length(self::$cipher);
//            $iv = openssl_random_pseudo_bytes($ivlen);
//            $ciphertext = openssl_encrypt($plaintext, self::$cipher, self::$key, $options=0, $iv, $tag);
//            //store $cipher, $iv, and $tag for decryption later
//            $original_plaintext = openssl_decrypt($ciphertext, self::$cipher, self::$key, $options=0, $iv, $tag);
//            echo $original_plaintext."\n";
//        }
//    }
}