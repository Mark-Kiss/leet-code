<?php

declare(strict_types=1);

final class Solution
{
    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString(&$s) {
        $arrayLength = count($s);
        for ($leftI = 0, $rightI = $arrayLength - 1; $leftI < $rightI; $leftI++, $rightI--) {
            $tmp = $s[$leftI];
            $s[$leftI] = $s[$rightI];
            $s[$rightI] = $tmp;
        }
    }
}

function test(array $input, array $expected): void {
    $inputString = 'Test case ' . implode(', ', $input) . ': ';
    echo $inputString;
    (new Solution())->reverseString($input);
    echo $expected == $input ? 'Success' : 'Failed: ' . implode(', ', $input);
    echo "\n";
}

test(["h","e","l","l","o"], ["o","l","l","e","h"]);
test(["H","a","n","n","a","h"], ["h","a","n","n","a","H"]);
test(["h"], ["h"]);
test(["h", "A"], ["A", "h"]);