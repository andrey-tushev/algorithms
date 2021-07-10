#!/usr/bin/php
<?php
/*

*/
class Task {
    public $size = 8;
    public $board = [];
    public $count = 0;

    private $strikeCol = [];
    private $strikeDiag1 = [];
    private $strikeDiag2 = [];

    public function __construct()
    {
        for ($r=0; $r<$this->size; $r++) {
            for ($c=0; $c<$this->size; $c++) {
                $this->board[$r][$c] = false;
            }
        }

        for ($i=0; $i<$this->size; $i++) {
            $this->strikeCol[$i] = false;
        }

        for ($i=0; $i<($this->size * 2 - 1); $i++) {
            $this->strikeDiag1[$i] = false;
            $this->strikeDiag2[$i] = false;
        }
    }

    public function search($r=0) {
        if ($r === $this->size) {
            // Уже ничего не пробуем. Просто показываем результатю
            $this->printBoard();
            $this->count++;
        }
        else {
            for ($c=0; $c<$this->size; $c++) {
                if ($this->isValid($r, $c)) {
                    $this->put($r, $c);
                    $this->search($r + 1);
                    $this->remove($r, $c);
                }
            }
        }
    }

    private function diag1Num($r, $c) {
        return
            $r + $c;
    }

    private function diag2Num($r, $c) {
        return ($this->size - $r - 1) + $c;
    }

    private function isValid($r, $c) {
        return
            !$this->strikeCol[$c] &&
            !$this->strikeDiag1[$this->diag1Num($r, $c)] &&
            !$this->strikeDiag2[$this->diag2Num($r, $c)];
    }

    private function put($r, $c) {
        $this->board[$r][$c] = true;

        $this->strikeCol[$c] = true;
        $this->strikeDiag1[$this->diag1Num($r, $c)] = true;
        $this->strikeDiag2[$this->diag2Num($r, $c)] = true;
    }

    private function remove($r, $c) {
        $this->board[$r][$c] = false;

        $this->strikeCol[$c] = false;
        $this->strikeDiag1[$this->diag1Num($r, $c)] = false;
        $this->strikeDiag2[$this->diag2Num($r, $c)] = false;
    }

    public function printBoard() {
        for ($r=0; $r<$this->size; $r++) {
            for ($c=0; $c<$this->size; $c++) {
                print $this->board[$r][$c] ? ' Q' : ' .';
            }
            print "\n";
        }
        print "\n";
    }
}

$p = new Task();
$p->search();
print "Found: {$p->count} \n";
