<?php

declare(strict_types=1);

final class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function removeDuplicates(&$nums) {
        $prevNumber = null;
        $newLength = 0;
        $arrayLength = count($nums);

        foreach ($nums as $currentNumber) {
            $nums[$newLength] = $currentNumber;
            if ($prevNumber === $currentNumber) {
                continue;
            }
            $prevNumber = $currentNumber;
            $newLength++;
        }

        for($i = $newLength; $i < $arrayLength; $i++) {
            $nums[$i] = '_';
        }
        return $newLength;
    }
}

function test(array $input, $expectedNewLength, $expectedOutput) {
    $inputString = implode(', ', $input);
    echo "Test case $inputString\n";
    $actual = (new Solution())->removeDuplicates($input);
    echo $actual === $expectedNewLength ? "Correct length\n" : "False length: $actual instead of $expectedNewLength\n";
    $manipulatedInputString = implode(', ', $input);
    echo $expectedOutput == $input ? "Correct changed array\n" : "Wrong changed array: $manipulatedInputString\n";
}

//test([1,1,2], 2, [1,2,'_']);
//test([0,0,1,1,1,2,2,3,3,4], 5, [0,1,2,3,4,'_','_','_','_','_']);
test([1,1,2,3], 3, [1,2,3,'_']);