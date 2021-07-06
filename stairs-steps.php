#!/usr/bin/php
<?php
/*
Лестница длинной N.
Можно делать 1 или 2 шага.
Сколько вариантов достич ее конца.

0   x
1   1
2   11      2
3   111     12      21
4   1111    112     211     121     22
5   11111   2111    1211    1121    1112    212     221     122
*/

// Recursion, O(LogN)?
function solveRecursive($n) {
    if($n<=0) {return 0;} // Вариантов на такой длинне - 0
    if($n==1) {return 1;} // Можно только 1
    if($n==2) {return 2;} // Можно только 11 или 2

    return
        solveRecursive($n-1) + // Сколько вариантов если сократили длинну на 1 шаг
        solveRecursive($n-2);  // Сколько вариантов если сократили длинну на 2 шаг
}

// Recursion with cache
$dp = [0, 1, 2];
function solveRecursiveOpt($n) {
    global $dp;
    if (isset($dp[$n])) { return $dp[$n]; }

    $variants =
        solveRecursiveOpt($n-1) + // Сколько вариантов если сократили длинну на 1 шаг
        solveRecursiveOpt($n-2);  // Сколько вариантов если сократили длинну на 2 шаг

    $dp[$n] = $variants;
    return $variants;
}

// DP, O(N)
function solveDP($n) {
    $d = [0=>0, 1=>1, 2=>2]; // x | 1 | 11 2

    for($i=3; $i<=$n; $i++) {
        $d[$i] = $d[$i-1] + $d[$i-2];
    }

    return $d[$n];
}

// TEST
for ($n=0; $n<=20; $n++) {
    print
        $n                      . "\t=>\t" .
        solveRecursive($n)      . "\t" .
        solveDP($n)             . "\t" .
        solveRecursiveOpt($n)   . "\n";
}

