#!/usr/bin/php
<?php
/*
Если в режиме перестановок  (onlyOnce==true)     N!
Без уникальности            (onlyOnce==false)    N^N
*/
class Permutations {
    public $size = 6;
    public $onlyOnce = true;

    public $items = [];
    public $used = [];

    public $result = [];

    function search() {
        if (count($this->items) === $this->size) {
            $this->process();
        }
        else {
            for ($i=0; $i<$this->size; $i++) {
                // Каждую цифру можно использовать только по одному разу
                if ($this->onlyOnce) {
                    if (($this->used[$i] ?? false) === true) {
                        continue;
                    }
                }

                array_push($this->items, $i);       $this->used[$i] = true;
                $this->search();
                array_pop($this->items);            $this->used[$i] = false;
            }
        }
    }

    function process() {
        print implode(' ', $this->items) . "\n";
        $this->result[] = $this->items;
    }
}

class Permutations2 {
    public $size = 4;
    private $items = [];
    public $result = [];

    public function search($level = 0) {
        if ($level === $this->size) {
            $this->process();
        }
        else {
            for ($i=0; $i<$this->size; $i++) {
                if (!$this->isItemUsed($i)) {
                    $this->pushItem($i);
                    $this->search($level + 1);
                    $this->popItem();
                }
            }
        }
    }

    private function pushItem($i) {
        array_push($this->items, $i);
    }

    private function popItem() {
        array_pop($this->items);
    }

    private function isItemUsed($i) {
        return in_array($i, $this->items);
    }

    private function process() {
        print implode(' ', $this->items) . "\n";
        $this->result[] = $this->items;
    }
}

$p = new Permutations2();
$p->search();
print "Variants number: " . count($p->result) . "\n";