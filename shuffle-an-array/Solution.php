<?php

declare(strict_types=1);

class Solution {

    private array $original;

    /**
     * @param Integer[] $nums
     */
    function __construct($nums) {
        $this->original = $nums;
    }

    /**
     * @return Integer[]
     */
    function reset() {
        return $this->original;
    }

    /**
     * @return Integer[]
     */
    function shuffle() {
        $current = $this->original;
        $length = count($current);
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int($i, $length - 1);
            $temp = $current[$i];
            $current[$i] = $current[$randomIndex];
            $current[$randomIndex] = $temp;
        }
        return $current;
    }
}

/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($nums);
 * $ret_1 = $obj->reset();
 * $ret_2 = $obj->shuffle();
 */

function testShuffling(int $iterationCount, float $tolerancePercentage) {
    $solution = new Solution(range(1, 5));
    $original = $solution->reset();
    $counts = [];
    $shuffled = $solution->shuffle();

    assert(arraysHaveSameValues($original, $shuffled));

    for ($i = 0; $i < $iterationCount; $i++) {
        $shuffled = $solution->shuffle();
        $key = implode('', $shuffled);
        $counts[$key] = !isset($counts[$key]) ?  0 : ++$counts[$key];
    }

    $avgCount = array_sum($counts) / count($counts);
    $tolerance = $avgCount * $tolerancePercentage;
    foreach ($counts as $count) {
        assert(abs($count - $avgCount) < $tolerance);
    }

    echo "Test passed";
}

function arraysHaveSameValues(array $array1, array $array2) {
    sort($array1);
    sort($array2);
    return $array1 == $array2;
}

testShuffling(1000000, 0.1);

