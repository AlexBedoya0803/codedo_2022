<?php

/**
 * The encryption/decryption utilities.
 *
 * @package     udearroba/lib/util
 * @copyright   Copyright (c) 2017, Universidad de Antioquia - Facultad de Ingeniería - DRAI - Ude@
 * @author      Diego Rendón [diego3d3@gmail.com]
 */


require_once(dirname(__FILE__) . '/math/BigInteger.php');

/**
 * The encryption/decryption util class.
 */
class encryption {

    /**
     * Encrypts a user password.
     *
     * @param string $password The user password in plain text.
     * @param string $initialization_vector The 16 bytes initialization vector used to encrypt the data.
     * @param string $secret_key The 128-bits secret key used to encrypt the data.
     *
     * @return string The encrypted password using AES128 encoded with MIME base64.
     */
    function encrypt_password($password, $initialization_vector, $secret_key) {
        return base64_encode(
                mcrypt_encrypt(
                        MCRYPT_RIJNDAEL_128, $secret_key, $password, MCRYPT_MODE_CFB, $initialization_vector
                )
        );
    }

    /**
     * Encrypts the text in the format accepted by the UdeA Portal's web services.
     *
     * @param string $plain_text The plain text to be encrypted.
     * @param string $public_key The public key used to perform the encryption/decryption.
     * @param string $module The module needed for the math of the encryption method.
     *
     * @return string The encrypted text.
     */
    function encrypt($plain_text, $public_key, $module) {
        $e = "$518293881492214041749761";
        $n = $module;
        $s = 3;
        $encrypted_text = '';
        for ($i = 0; $i < strlen($plain_text); $i += $s) {
            $code = '0';
            for ($j = 0; $j < $s; $j++) {
                $m = strlen($plain_text) > $i + $j ? $plain_text[$i + $j] : ' ';
                $code = bcadd($code, bcmul(ord($m), bcpow('256', $j)));
            }
            $encrypted_text .= bcpowmod($code, $e, $n) . ' ';
        }
        return $encrypted_text;
    }

    /**
     * Decrypts the text from the format accepted by the UdeA Portal's web services.
     *
     * @param string $encrypted_text The encrypted text to be decrypted.
     * @param string $public_key The public key used to perform the encryption/decryption.
     * @param string $module The module needed for the math of the encryption method.
     *
     * @return string The plain text decrypted.
     */
    function decrypt($encrypted_text, $public_key, $module) {
        $n = new Math_BigInteger($module);
        $plain_text = '';
        $bridge = explode(" ", trim($encrypted_text));
        $d = new Math_BigInteger($public_key);
        $encrypted = array(count($bridge));
        $decrypted = array(count($bridge));
        for ($j = 0; $j < count($bridge); $j++) {
            $encrypted[$j] = new Math_BigInteger($bridge[$j]);
        }
        for ($k = 0; $k < count($bridge); $k++) {
            $decrypted[$k] = new Math_BigInteger($module);
            $decrypted[$k] = bcpowmod($encrypted[$k], $d, $n);
            $fragment = $decrypted[$k];
            $string_fragment = '';
            for ($i = 3; $i > 0; $i--) {
                $b2 = 0.0;
                $b2 = bcpow('256', $i - 1);
                $b1 = 0.0;
                $b1 = bcmod($fragment, $b2);
                $divisor = 0.0;
                $divisor = ($fragment - $b1) / ($b2);
                $fragment = $b1;
                $letter = chr($divisor);
                if ($letter != '') {
                    $string_fragment = $letter . $string_fragment;
                }
            }
            $plain_text = $plain_text . $string_fragment;
        }
        return ($plain_text);
    }

}
