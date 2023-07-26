<?php
function convertNumberToText($valor){
    $arr = explode(".", $valor);
    $entero = $arr[0];
    if (isset($arr[1])) {
        $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
    }

     $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
    if (is_array($arr)) {
        $num_word = ($arr[0]>=1000000) ? $fmt->format($entero) : $fmt->format($entero);
        if (isset($decimos) && $decimos > 0) {
            $num_word .= " Y $decimos/100 ";
        }
    } 
    return strtoupper($num_word); 

   
}