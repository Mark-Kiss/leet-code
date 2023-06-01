<?php

declare(strict_types=1);

class Solution {

    /**
     * @param String $word1
     * @param String $word2
     * @return String
     */
    function mergeAlternately(string $word1, string $word2): string {
        $maxLength = max(strlen($word1), strlen($word2));
        $result = '';
        for ($i = 0; $i < $maxLength; $i++) {
            $result .= $word1[$i] ?? '';
            $result .= $word2[$i] ?? '';
        }
        return $result;
    }
}

function test(string $word1, string $word2, string $expectedOutput) {
    echo "Test case $word1 - $word2";
    $actual = (new Solution())->mergeAlternately($word1, $word2);
    echo $actual === $expectedOutput ? " ✅\n" : "❌: $actual instead of $expectedOutput\n";
}

test('abc', 'pqr', 'apbqcr');
test('ab', 'pqrs', 'apbqrs');
test('abcd', 'pq', 'apbqcd');