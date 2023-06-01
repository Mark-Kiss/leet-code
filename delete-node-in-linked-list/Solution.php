<?php

declare(strict_types=1);

class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val)
    {
        $this->val = $val;
    }
}

class Head {

    private ListNode $head;

    public function __construct(array $array)
    {
        /** @var ListNode|null $prev */
        $prev = null;
        foreach ($array as $node) {
            $current = new ListNode($node);
            is_null($prev) ? $this->head = $current : $prev->next = $current;
            $prev = $current;
        }
    }

    public function nodeByVal(int $val): ListNode
    {
        $current = $this->head;
        while ($current) {
            if ($current->val === $val) {
                return $current;
            }
            $current = $current->next;
        }
        throw new Exception("$val does not exist in HEAD");
    }

    public function toArray(): array
    {
        $current = $this->head;
        $result = [];
        while ($current) {
            $result[] = $current->val;
            $current = $current->next;
        }
        return $result;
    }
}

final class Solution
{
    /**
     * @param ListNode $node
     * @return
     */
    function deleteNode($node)
    {
        $node->val = $node->next->val;
        $node->next =  $node->next->next;
    }
}

function test(array $headArray, int $nodeVal, array $expected): void {
    $head = new Head($headArray);
    $deletionCandidate = $head->nodeByVal($nodeVal);
    (new Solution())->deleteNode($deletionCandidate);
    echo 'Test case ' . implode(', ', $headArray) . ': ';
    echo $head->toArray() == $expected ? 'Success' : 'Failed: ' . implode(', ', $expected);
    echo "\n";
}

test([4,5], 4, [5]);
test([4,5,1,9], 5, [4,1,9]);
test([4,5,1,9,7,8], 5, [4,1,9,7,8]);