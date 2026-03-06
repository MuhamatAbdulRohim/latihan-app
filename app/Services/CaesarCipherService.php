<?php

namespace App\Services;

class CaesarCipherService
{
    private $upper;
    private $lower;

    public function __construct()
    {
        // Saya definisikan dua domain alfabet
        $this->upper = range('A', 'Z');
        $this->lower = range('a', 'z');
    }

    public function encrypt($text, $shift)
    {
        $result = '';
        foreach (str_split($text) as $char) {
            // Jika huruf besar
            if (in_array($char, $this->upper)) {
                $index = array_search($char, $this->upper);
                // Operasi dalam Z26
                $newIndex = ($index + $shift) % 26;
                $result .= $this->upper[$newIndex];
            }
            // Jika huruf kecil
            elseif (in_array($char, $this->lower)) {
                $index = array_search($char, $this->lower);
                $newIndex = ($index + $shift) % 26;
                $result .= $this->lower[$newIndex];
            }
            else {
                // Spasi & simbol tidak berubah
                $result .= $char;
            }
        }
        return $result;
    }

    public function decrypt($text, $shift)
    {
        $result = '';
        // Normalisasi shift
        $shift = $shift % 26;
        foreach (str_split($text) as $char) {
            // ========================
            // Huruf besar
            // ========================
            if (in_array($char, $this->upper)) {
                $index = array_search($char, $this->upper);
                // Rumus dekripsi langsung:
                // (x - k) mod 26
                $newIndex = ($index - $shift) % 26;
                // Karena PHP bisa menghasilkan nilai negatif,
                // saya tambahkan 26 jika hasilnya negatif
                if ($newIndex < 0) {
                    $newIndex += 26;
                }
                $result .= $this->upper[$newIndex];
            }
            // ========================
            // Huruf kecil
            // ========================
            elseif (in_array($char, $this->lower)) {
                $index = array_search($char, $this->lower);
                $newIndex = ($index - $shift) % 26;
                if ($newIndex < 0) {
                    $newIndex += 26;
                }
                $result .= $this->lower[$newIndex];
            }
            else {
                $result .= $char;
            }
        }
        return $result;
    }
}
