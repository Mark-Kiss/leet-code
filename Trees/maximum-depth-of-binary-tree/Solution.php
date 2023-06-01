<?php

declare(strict_types=1);

class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($val = 0, $left = null, $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

class Tree {

    private ?TreeNode $root = null;

    public function __construct(array $input)
    {
        if(empty($input)) {
            return;
        }
        $prev = [];
        $new = $input;
        while (count($prev) !== 1) {
            $prev = $this->buildLeaf($new, $prev);
            $new = array_slice($new, 0, ((count($new) + 1) / 2) - 1);
        }
        $this->root = reset($prev);
    }

    private function buildLeaf(array $all, array $prev): array
    {
        $leafItems = [];
        $leafArray = array_slice($all, -((count($all) + 1) / 2));
        $prevIndex = 0;
        foreach ($leafArray as $index => $leafValue) {
            $leafItems[$index] = is_null($leafValue) ? null : new TreeNode($leafValue);
            if (!is_null($leafValue) && !empty($prev)) {
                $leafItems[$index]->left = $prev[$prevIndex];
                $leafItems[$index]->right = $prev[$prevIndex + 1];
            }
            $prevIndex += 2;
        }
        return $leafItems;
    }

    public function root(): ?TreeNode
    {
        return $this->root;
    }
}

class Solution
{

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function maxDepth($root)
    {
        if (is_null($root)) {
            return 0;
        }
        return 1 + max(self::maxDepth($root->left), self::maxDepth($root->right));
    }
}



function test(array $input, int $expected) {
    echo "Test case " . implode(', ', $input) . ': ';
    $root = (new Tree($input))->root();
    $actual = (new Solution())->maxDepth($root);
    echo ($expected === $actual) ? "Success" : "Failed: $actual";
    echo "\n";
}

test([3,9,20,null,null,15,7], 3);
test([1,null,2], 2);
test([1], 1);
test([], 0);
test([3,9,20,null,null,15,7,1,2,3,4,5,6,7,8], 4);