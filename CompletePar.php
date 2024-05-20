<?php

class CompletePar
{
    public const VALIDATE = ['(', ')'];
    static function build($str) {
        $state = 0;
        $result = [];
        for ($i = 0; $i < strlen($str); $i++) {
            if (self::VALIDATE[$state] === $str[$i]) {
                $result[] = $str[$i];
                $state= (int)!$state;
            }
        }
        return implode('', $result);
    }
}
$str = "(((())())()()))";
print_r(CompletePar::build($str));
// Salida esperada: ()()
// Salida retornada: ())