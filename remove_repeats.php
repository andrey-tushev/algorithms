#!/usr/bin/php
<?php
/*

*/

function solution1($s) {
    $res = '';
    $prev = null;
    for ($i=0; $i<strlen($s); $i++) {
        $curr = $s[$i];

        $res .= $curr;

        if ($prev === $curr) {
            $res = substr($res, 0, -1);
        }

        print "$res \n";

        $prev = $curr;
    }
    return $res;
}

function solution2($s) {
    $res = '';
    $count = 1;
    for ($i=0; $i<strlen($s); $i++) {
        if ($s[$i] === $s[$i+1]) {
            continue;
        }
        $res .= $s[$i];

    }
    return $res;
}

$s = 'AABBBBBACADABBAAAAA CCCDDDCCC';
$r = solution2($s);
print "Input:  $s \n";
print "Result: $r \n";
