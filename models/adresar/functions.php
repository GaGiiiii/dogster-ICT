<?php

function getPodaci()
{
    $open = fopen(ADRESAR, "r");
    $podaci = file(ADRESAR);
    fclose($open);
    return $podaci;
}

function getRed($index)
{
    $open = fopen(ADRESAR, "r");
    $podaci = file(ADRESAR);
    fclose($open);
    $korisnik = "";
    foreach ($podaci as $key => $value) {
        if ($key == $index) {
            $korisnik = $value;
        }
    }
    return explode(SEPARTOR, $korisnik);
}
