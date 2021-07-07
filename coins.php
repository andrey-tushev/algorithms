#!/usr/bin/php
<?php
/*
Найти минимальное число монет для формирования суммы

solve(x) = min(
    solve(x-1) +1
    solve(x-3) +1
    solve(x-4) +1
)
*/
$coins = [1, 4];

function solveRecursive($x) {
    global $coins;

    if ($x===0) { return 0;           } // Четко набрали нужную сумму. Монетки не нужны.
    if ($x < 0) { return PHP_INT_MAX; } // Перебор

    // Для улучшение O() стоит добавить меморизацию

    $best = PHP_INT_MAX;
    foreach ($coins as $coin) {
        // Пробуем потратить каждый тип монетки, смотрим что вышло оптимальнее
        $best = min($best,
            solveRecursive($x - $coin) +1 // А сколько монеток надо для вот такой суммы?
            // +1 потому что потратили какую то одну из монеток
        );
    }
    return $best;
}

// Из книжки. O(S*C)
function solveDP($sum) {
    global $coins;

    // Массив лучших значений, для каждой из сумм
    $dp = [
        0 => 0  // Для нулевой суммы надо 0 монеток
    ];

    for ($x=1; $x<=$sum; $x++) {
        $dp[$x] = PHP_INT_MAX;
        foreach ($coins as $coin) {
            if ($x - $coin >= 0) { // Перелеты не рассматриваем
                $dp[$x] = min($dp[$x],
                    $dp[$x - $coin] +1  // Очень похоже на: solveRecursive($x - $coin) +1
                );
            }
        }
    }

    return $dp[$sum];
}

// Мое решение.
// Аналог версии solveRecursive(), но без ракурсии и с DP
function solveDP2($sum) {
    global $coins;

    // Массив лучших значений, для каждой из сумм
    $dp = [
        0 => 0  // Для нулевой суммы надо 0 монеток
    ];

    // Переберем все суммы
    for ($x=1; $x<=$sum; $x++) {
        $best = PHP_INT_MAX;
        foreach ($coins as $coin) {
            // Четко уложились в сумму, использовав одну монетку
            if      ($x - $coin === 0)  { $num = 1; }
            // Перелет. Плохой вариант.
            elseif  ($x - $coin  <  0)  { $num = PHP_INT_MAX; }
            // Сколько стоила такая сумма за вычетом монетки, не забудем добавить одну монетку к результату
            elseif  ($x - $coin  >  0)  { $num = $dp[$x - $coin] + 1; }

            $best = min($best, $num); // Ищем что было самое лучшее
        }

        // Запомним на будущее, чего там у нас вышло для такой суммы (лучший вариант)
        $dp[$x] = $best;
    }

    return $dp[$sum];
}


for ($x=0; $x<=20; $x++) {
    print "x=$x \t => \t " .
        solveRecursive($x) . "\t" .
        solveDP($x) . "\t"  .
        solveDP2($x) . "\n";
}
