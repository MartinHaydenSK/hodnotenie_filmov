<?php 
//ochrana pred útokom a oprava formátu mena
function Nprotect($input){       
    $input = trim($input);
    $input = stripslashes($input);
    $input = strip_tags($input);
    $input = ucfirst($input);
    return $input;    }

    //ochrana pred útokom a oprava formátu emailu
    function Eprotect($input){       
    $input = trim($input);
    $input = stripslashes($input);
    $input = strip_tags($input);
    $input = strtolower($input);
    return $input;    }

   //ochrana pred útokom a oprava formátu ľubovolneho textu
    function Tprotect($input){       
    $input = trim($input);
    $input = stripslashes($input);
    $input = strip_tags($input);
    return $input;    } 
?>