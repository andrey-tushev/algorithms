#!/usr/bin/php
<?php
/*


*/

class Subsets {
    public $set = ['A', 'B', 'C', 'D'];
    public $subset = [];

    // Идея в том что все рекурсии проходят на однинаковую максимальную глубину
    public function search($k = 0) {
        if ($k === count($this->set)) {
            // Самый нижний уровень рекурсии
            // Их будет 2^n
            $this->process();
        }
        else {
            // С k-тым элементом
            array_push($this->subset, $this->set[$k]);
            $this->search($k+1);

            // Без k-того элемента
            array_pop($this->subset);
            $this->search($k+1);
        }
    }

    public function process() {
        print "{" . implode('', $this->subset) . "}\n";
    }
}

class Subsets2 {
    public $set = ['A', 'B', 'C', 'D'];
    public $subset = ['.', '.', '.', '.'];

    public function search($k = 0) {
        if ($k === count($this->set)) {
            $this->process();
        }
        else {
            $this->subset[$k] = $this->set[$k];
            $this->search($k+1);

            $this->subset[$k] = '.';
            $this->search($k+1);
        }
    }

    public function process() {
        print "{" . implode('', $this->subset) . "}\n";
    }
}

$subsets = new Subsets();
$subsets->search();
print "------\n";
$subsets = new Subsets2();
$subsets->search();