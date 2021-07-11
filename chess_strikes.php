#!/usr/bin/php
<?php
/*

*/
class Task {
    public $size = 4;
    public $board = [];
    public $count = 0;

    public function __construct()
    {
        for ($r=0; $r<$this->size; $r++) {
            for ($c=0; $c<$this->size; $c++) {
                $this->board[$r][$c] = '.';
            }
        }
    }

    public function search($d=0) {
        if ($d === 6) { // Глубина X (пытаемся уснановить 6 фигур)
            $this->printBoard();
            $this->count++;
        }
        else {
            for ($r=0; $r<$this->size; $r++) {
                for ($c=0; $c<$this->size; $c++) {
                    foreach ([/*'R',*/ 'B'] as $f) {
                        if ($this->isLegal($r, $c, $f)) {
                            $this->board[$r][$c] = $f;
                            $this->search($d+1);
                            $this->board[$r][$c] = '.';
                        }
                    }
                }
            }
        }
    }

    // НЕ ПРАВИЛЬНО!!! РАБОТАЕТ ТОЛЬКО С ОДНИМ ВИДОМ ФИГУР
    private function isLegal($fr, $fc, $f) {
        if ($f === 'R') {
            for ($c=0; $c<$this->size; $c++) {
                if ($this->board[$fr][$c] !== '.') return false;
            }
            for ($r=0; $r<$this->size; $r++) {
                if ($this->board[$r][$fc] !== '.') return false;
            }
            return true;
        }
        elseif ($f === 'B') {
            for ($i=-$this->size; $i<$this->size; $i++) {
                if (isset($this->board[$fr+$i][$fc+$i])) {
                      if ($this->board[$fr+$i][$fc+$i] !== '.') return false;
                }
                if (isset($this->board[$fr-$i][$fc+$i])) {
                      if ($this->board[$fr-$i][$fc+$i] !== '.') return false;
                }
            }
            return true;
        }
        return false;
    }

    public function printBoard() {
        for ($r=0; $r<$this->size; $r++) {
            for ($c=0; $c<$this->size; $c++) {
                print ' ' . $this->board[$r][$c];
            }
            print "\n";
        }
        print "\n";
    }
}

$t = new Task();
$t->search();
print "Found: {$t->count} \n";
