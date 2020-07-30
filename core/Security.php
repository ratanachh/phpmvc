<?php
declare(strict_types=1);

namespace Core;

class Security
{
    protected $cipher = "aes-128-gcm";
    protected $key = "";

    public function __construct()
    {
        switch (PHP_OS) {
            case 'WINNT':
                $this->key = trim(explode("\n", shell_exec('wmic bios get serialnumber 2>&1'))[1], "\t\n\r\0\x0B ");
                break;
        }
    }

    public function encrypt($plaintext){
        if (in_array($this->cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($this->cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            return openssl_encrypt($plaintext, $this->cipher, $this->key, $options=0, $iv, $tag);
        }
        return $plaintext;
    }

    public function decrypt($ciphertext){
        if (in_array($this->cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($this->cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            return openssl_decrypt($ciphertext, $this->cipher, $this->key, $options=0, $iv);
        }
    }
}