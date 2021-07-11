#!/usr/bin/php
<?php
/*

*/

class Task {
    public $n = 3;

    function gen($str='', $open=0, $close=0) {
        if (strlen($str) == 2 * $this->n) {
            print $str . "\n";
        }
        else {
            if ($open < $this->n) // Открываем только если их меньше половины
                $this->gen($str.'(', $open+1, $close);

            if ($close < $open ) // Закрывающих меньше открывающих
                $this->gen($str.')', $open, $close+1);
        }
    }

}

class Task2 {
    public $n = 3;
    public $str = '';

    function gen($open=0, $close=0) {
        if (strlen($this->str) == 2 * $this->n) {
            $this->process();
        }
        else {
            // Открываем только если их меньше половины
            if ($open < $this->n) {
                $this->push('(');
                $this->gen($open + 1, $close);
                $this->pop();
            }

            // Закрывающих меньше открывающих
            if ($close < $open ) {
                $this->push(')');
                $this->gen($open, $close + 1);
                $this->pop();
            }
        }
    }

    private function push($braket) {
        $this->str .= $braket;
    }

    private function pop() {
        $this->str = substr($this->str, 0, -1);
    }

    private function process() {
        print $this->str . "\n";
    }
}

$n = 4;

$t1 = new Task();
$t1->n = $n;
$t1->gen();

print "---------\n";

$t2 = new Task2();
$t2->n = $n;
$t2->gen();
