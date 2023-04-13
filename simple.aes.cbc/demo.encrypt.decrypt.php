<?php

echo "<title>PHP AES Encryption</title>";

$randomSTRING32 = "1234567890123456";
$hexKEY32 = bin2hex($randomSTRING32);

$randomSTR16 = "12345678";
$hexIV16 = bin2hex($randomSTR16);

$message_string = "ENCRYPT ME NOW BB !!!!";

$encrypted_bin = openssl_encrypt($message_string, 'aes-256-cbc', $hexKEY32, OPENSSL_RAW_DATA, $hexIV16);
$encrypted_hex = bin2hex($encrypted_bin);

$decripted_string = openssl_decrypt($encrypted_bin, 'aes-256-cbc', $hexKEY32, OPENSSL_RAW_DATA, $hexIV16);

echo "str key 32: " . $randomSTRING32; echo "<br>"; echo "<br>";
echo "hex key 32: " . $hexKEY32; echo "<br>"; echo "<br>";

echo "str iv 16: " . $randomSTR16; echo "<br>"; echo "<br>";
echo "hex iv 16: " . $hexIV16; echo "<br>"; echo "<br>";

echo "Encrypted bin: " . $encrypted_bin; echo "<br>"; echo "<br>";
echo "Encrypted hex: " . $encrypted_hex; echo "<br>"; echo "<br>";
echo "Decrypted str: " . $decripted_string; echo "<br>"; echo "<br>";