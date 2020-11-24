<?php

echo rand(1,999999)."<br>";

// echo substr("Hello world",10)."<br>";
// echo substr("Hello world",1)."<br>";
// echo substr("Hello world",3)."<br>";
// echo substr("Hello world",7)."<br>";

// echo substr("Hello world",-1)."<br>";
// echo substr("Hello world",-10)."<br>";
// echo substr("Hello world",-8)."<br>";
// echo substr("Hello world",-4)."<br>";
// $str = "Hello World!";
// echo $str . "<br>";
// echo trim($str, '');

function word_limiters($str, $limit = 10) {
    $str = strip_tags($str);
    if (stripos($str, " ")) {
        $ex_str = explode(" ", $str);
        if (count($ex_str) > $limit) {
            for ($i = 0; $i < $limit; $i++) {
                $str_s = $ex_str[$i] . " ";
            }
            return $str_s;
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}

$artikel = "Muammar Khadafi ";

$cut = word_limiters($artikel, 2);

echo $cut; //ini ibu budi
