<?php

declare(strict_types=1);

use Faust\BetterArray\BetterArray;

test('#from', function (): void {
    expect(BetterArray::from([1, 2])->toArray())->toMatchSnapshot();
});

test('#range', function (): void {
    expect(BetterArray::range(1, 2)->toArray())->toMatchSnapshot();
});

test('#changeKeyCase', function (): void {
    expect(BetterArray::from(['KEY' => 'value'])->changeKeyCase()->toArray())->toMatchSnapshot();
});

test('#chunk', function (): void {
    expect(BetterArray::from([1, 2, 3, 4])->chunk(2)->toArray())->toMatchSnapshot();
});

test('#column', function (): void {
    expect(
        BetterArray::from(
            [
                [
                    'id'         => 2135,
                    'first_name' => 'John',
                    'last_name'  => 'Doe',
                ],
                [
                    'id'         => 3245,
                    'first_name' => 'Sally',
                    'last_name'  => 'Smith',
                ],
                [
                    'id'         => 5342,
                    'first_name' => 'Jane',
                    'last_name'  => 'Jones',
                ],
                [
                    'id'         => 5623,
                    'first_name' => 'Peter',
                    'last_name'  => 'Doe',
                ],
            ]
        )->column('first_name'),
    )->toMatchSnapshot();
});

test('#combine', function (): void {
    expect(BetterArray::from(['green', 'red', 'yellow'])->combine(['avocado', 'apple', 'banana'])->toArray())->toMatchSnapshot();
});

test('#countValues', function (): void {
    expect(BetterArray::from([1, 'hello', 1, 'world', 'hello'])->countValues()->toArray())->toMatchSnapshot();
});

test('#diffAssoc', function (): void {
    expect(BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])->diffAssoc(['a' => 'green', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#diffKey', function (): void {
    expect(BetterArray::from([
        'blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4,
    ])->diffKey([
        'green' => 5, 'yellow' => 7, 'cyan' => 8,
    ])->toArray())->toMatchSnapshot();
});

test('#diffUassoc', function (): void {
    function diffUassoc($a, $b)
    {
        if ($a === $b) {
            return 0;
        }

        return ($a > $b) ? 1 : -1;
    }

    expect(BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])->diffUassoc('diffUassoc', ['a' => 'green', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#diffUkey', function (): void {
    function diffUkey($key1, $key2)
    {
        if ($key1 === $key2) {
            return 0;
        } elseif ($key1 > $key2) {
            return 1;
        }

        return -1;
    }

    expect(BetterArray::from(['blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4])->diffUkey('diffUkey', ['green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8])->toArray())->toMatchSnapshot();
});

test('#diff', function (): void {
    expect(BetterArray::from(['a' => 'green', 'red', 'blue', 'red'])->diff(['b' => 'green', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#fillKeys', function (): void {
    expect(BetterArray::from([])->fillKeys(['foo', 5, 10, 'bar'], 'banana')->toArray())->toMatchSnapshot();
});

test('#fill', function (): void {
    expect(BetterArray::from([])->fill(5, 6, 'banana')->toArray())->toMatchSnapshot();
});

test('#filter', function (): void {
    function odd($var)
    {
        return $var & 1;
    }

    expect(BetterArray::from(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5])->filter('odd')->toArray())->toMatchSnapshot();
});

test('#flip', function (): void {
    expect(BetterArray::from(['oranges', 'apples', 'pears'])->flip()->toArray())->toMatchSnapshot();
});

test('#intersectAssoc', function (): void {
    expect(BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])->intersectAssoc(['a' => 'GREEN', 'B' => 'brown', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#intersectKey', function (): void {
    expect(BetterArray::from(['blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4])->intersectKey(['green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8])->toArray())->toMatchSnapshot();
});

test('#intersectUassoc', function (): void {
    expect(BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])->intersectUassoc('strcasecmp', ['a' => 'GREEN', 'B' => 'brown', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#intersectUkey', function (): void {
    function intersectUkey($key1, $key2)
    {
        if ($key1 === $key2) {
            return 0;
        } elseif ($key1 > $key2) {
            return 1;
        }

        return -1;
    }

    expect(BetterArray::from(['blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4])->intersectUkey('intersectUkey', ['green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8])->toArray())->toMatchSnapshot();
});

test('#intersect', function (): void {
    expect(BetterArray::from(['a' => 'green', 'red', 'blue'])->intersect(['b' => 'green', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#isList', function (): void {
    expect(BetterArray::from([0, 1, 2])->isList())->toBeTrue();
    expect(BetterArray::from(['first' => 1, 'second' => 4])->isList())->toBeFalse();
});

test('#keyFirst', function (): void {
    expect(BetterArray::from(['first' => 1, 'second' => 4])->keyFirst('first'))->toMatchSnapshot();
});

test('#keyLast', function (): void {
    expect(BetterArray::from(['first' => 1, 'second' => 4])->keyLast('first'))->toMatchSnapshot();
});

test('#keys', function (): void {
    expect(BetterArray::from(['key' => 'value'])->keys())->toMatchSnapshot();
});

test('#map', function (): void {
    expect(BetterArray::from([1, 2, 3, 4, 5])->map(function ($n) {
        return $n * $n * $n;
    })->toArray())->toMatchSnapshot();
});

test('#mergeRecursive', function (): void {
    expect(BetterArray::from(['color' => ['favorite' => 'red'], 5])->mergeRecursive([10, 'color' => ['favorite' => 'green', 'blue']])->toArray())->toMatchSnapshot();
});

test('#merge', function (): void {
    expect(BetterArray::from(['color' => 'red', 2, 4])->merge(['a', 'b', 'color' => 'green', 'shape' => 'trapezoid', 4])->toArray())->toMatchSnapshot();
});

test('#multisort', function (): void {
    expect(BetterArray::from([10, 100, 100, 0])->multisort([1, 3, 2, 4])->toArray())->toMatchSnapshot();
});

test('#pad', function (): void {
    expect(BetterArray::from([12, 10, 9])->pad(5, 0)->toArray())->toMatchSnapshot();
});

test('#pop', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->pop())->toMatchSnapshot();
});

test('#product', function (): void {
    expect(BetterArray::from([5, 10, 20, 50])->product())->toMatchSnapshot();
});

test('#push', function (): void {
    expect(BetterArray::from(['orange', 'banana'])->push('apple', 'raspberry')->toArray())->toMatchSnapshot();
});

test('#rand', function (): void {
    $subject = BetterArray::from(['orange', 'banana']);

    expect($subject->inArray($subject->rand()))->toBeTrue();
});

test('#reduce', function (): void {
    expect(BetterArray::from([1, 2, 3, 4, 5])->reduce(function ($carry, $item) {
        $carry += $item;

        return $carry;
    }))->toMatchSnapshot();

    expect(BetterArray::from([1, 2, 3, 4, 5])->reduce(function ($carry, $item) {
        $carry *= $item;

        return $carry;
    }))->toMatchSnapshot();
});

test('#replaceRecursive', function (): void {
    expect(BetterArray::from([
        'citrus' => ['orange'], 'berries' => ['blackberry', 'raspberry'],
    ])->replaceRecursive([
        'citrus' => ['pineapple'], 'berries' => ['blueberry'],
    ])->toArray())->toMatchSnapshot();
});

test('#replace', function (): void {
    expect(BetterArray::from(['orange', 'banana', 'apple', 'raspberry'])->replace(
        [0 => 'pineapple', 4 => 'cherry'],
        [0 => 'grape'],
    )->toArray())->toMatchSnapshot();
});

test('#reverse', function (): void {
    expect(BetterArray::from([0, 1, 2, 3])->reverse()->toArray())->toMatchSnapshot();
});

test('#search', function (): void {
    expect(BetterArray::from([0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red'])->search('green'))->toMatchSnapshot();
});

test('#shift', function (): void {
    expect(BetterArray::from([0, 1, 2, 3])->shift()->toArray())->toMatchSnapshot();
});

test('#slice', function (): void {
    expect(BetterArray::from([0, 1, 2, 3])->slice(1)->toArray())->toMatchSnapshot();
});

test('#splice', function (): void {
    expect(BetterArray::from([0, 1, 2, 3])->splice(1)->toArray())->toMatchSnapshot();
});

test('#sum', function (): void {
    expect(BetterArray::from([5, 10, 20, 50])->sum())->toMatchSnapshot();
});

test('#udiffAssoc', function (): void {
    expect(
        BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])
            ->udiffAssoc(function ($a, $b) {
                if ($a === $b) {
                    return 0;
                }

                return ($a > $b) ? 1 : -1;
            }, ['a' => 'green', 'yellow', 'red'])
            ->toArray(),
    )->toMatchSnapshot();
});

test('#udiffUassoc', function (): void {
    /**
     * @coversNothing
     */
    class BetterArrayTest
    {
        private $priv_member;

        public function cr($val)
        {
            $this->priv_member = $val;
        }

        public static function comp_func_cr($a, $b)
        {
            if ($a->priv_member === $b->priv_member) {
                return 0;
            }

            return ($a->priv_member > $b->priv_member) ? 1 : -1;
        }

        public static function comp_func_key($a, $b)
        {
            if ($a === $b) {
                return 0;
            }

            return ($a > $b) ? 1 : -1;
        }
    }

    expect(
        BetterArray::from(['0.1' => new BetterArrayTest(9), '0.5' => new BetterArrayTest(12), 0 => new BetterArrayTest(23), 1=> new BetterArrayTest(4), 2 => new BetterArrayTest(-15)])
            ->udiffUassoc(['BetterArrayTest', 'comp_func_cr'], ['BetterArrayTest', 'comp_func_key'], ['0.2' => new BetterArrayTest(9), '0.5' => new BetterArrayTest(22), 0 => new BetterArrayTest(3), 1=> new BetterArrayTest(4), 2 => new BetterArrayTest(-15)])
            ->toArray(),
    )->toMatchSnapshot();
});

test('#udiff', function (): void {
    expect(
        BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])
            ->udiff('strcasecmp', ['a' => 'GREEN', 'B' => 'brown', 'yellow', 'red'])
            ->toArray(),
    )->toMatchSnapshot();
});

test('#uintersectAssoc', function (): void {
    expect(BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])->uintersectAssoc('strcasecmp', ['a' => 'GREEN', 'B' => 'brown', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#uintersectUassoc', function (): void {
    expect(BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])->uintersectUassoc('strcasecmp', 'strcasecmp', ['a' => 'GREEN', 'B' => 'brown', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#uintersect', function (): void {
    expect(BetterArray::from(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'])->uintersect('strcasecmp', ['a' => 'GREEN', 'B' => 'brown', 'yellow', 'red'])->toArray())->toMatchSnapshot();
});

test('#unique', function (): void {
    expect(BetterArray::from([1, 1, 2, 2])->unique()->values())->toMatchSnapshot();
});

test('#unshift', function (): void {
    expect(BetterArray::from([1, 2, 3])->unshift(0)->values())->toMatchSnapshot();
});

test('#values', function (): void {
    expect(BetterArray::from(['key' => 'value'])->values())->toMatchSnapshot();
});

test('#walkRecursive', function (): void {
    expect(BetterArray::from(['sweet' => ['a' => 'apple', 'b' => 'banana'], 'sour' => 'lemon'])->walkRecursive(function (&$item1, $_, $prefix) {
        $item1 = "$prefix: $item1";
    })->toArray())->toMatchSnapshot();
});

test('#walk', function (): void {
    expect(BetterArray::from(['d' => 'lemon', 'a' => 'orange', 'b' => 'banana', 'c' => 'apple'])->walk(function (&$item1, $_, $prefix) {
        $item1 = "$prefix: $item1";
    })->toArray())->toMatchSnapshot();
});

test('#arsort', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->arsort())->toMatchSnapshot();
});

test('#asort', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->asort())->toMatchSnapshot();
});

test('#count', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->count())->toMatchSnapshot();
});

test('#current', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->current())->toMatchSnapshot();
});

test('#end', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->end())->toMatchSnapshot();
});

test('#inArray', function (): void {
    expect(BetterArray::from(['a', 'b', 'c'])->inArray('a'))->toBeTrue();
    expect(BetterArray::from(['a', 'b', 'c'])->inArray('b'))->toBeTrue();
    expect(BetterArray::from(['a', 'b', 'c'])->inArray('c'))->toBeTrue();
    expect(BetterArray::from(['a', 'b', 'c'])->inArray('d'))->toBeFalse();
});

test('#keyExists', function (): void {
    expect(BetterArray::from(['first' => 1, 'second' => 4])->keyExists('first'))->toBeTrue();
    expect(BetterArray::from(['first' => 1, 'second' => 4])->keyExists('second'))->toBeTrue();
    expect(BetterArray::from(['first' => 1, 'second' => 4])->keyExists('third'))->toBeFalse();
});

test('#key', function (): void {
    expect(BetterArray::from(['d' => 'lemon', 'a' => 'orange', 'b' => 'banana', 'c' => 'apple'])->key())->toMatchSnapshot();
});

test('#krsort', function (): void {
    expect(BetterArray::from(['d' => 'lemon', 'a' => 'orange', 'b' => 'banana', 'c' => 'apple'])->krsort()->toArray())->toMatchSnapshot();
});

test('#ksort', function (): void {
    expect(BetterArray::from(['d' => 'lemon', 'a' => 'orange', 'b' => 'banana', 'c' => 'apple'])->ksort()->toArray())->toMatchSnapshot();
});

test('#natcasesort', function (): void {
    expect(BetterArray::from(['IMG0.png', 'img12.png', 'img10.png', 'img2.png', 'img1.png', 'IMG3.png'])->natcasesort()->toArray())->toMatchSnapshot();
});

test('#natsort', function (): void {
    expect(BetterArray::from(['img12.png', 'img10.png', 'img2.png', 'img1.png'])->natsort()->toArray())->toMatchSnapshot();
});

test('#next', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->next()->toArray())->toMatchSnapshot();
});

test('#pos', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->pos())->toMatchSnapshot();
});

test('#prev', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->prev()->toArray())->toMatchSnapshot();
});

test('#reset', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->reset())->toMatchSnapshot();
});

test('#rsort', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->rsort()->values())->toMatchSnapshot();
});

test('#shuffle', function (): void {
    $a = BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->toArray();
    $b = BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->toArray();

    expect($a)->toBe($b);

    $a = BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->shuffle()->toArray();
    $b = BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->shuffle()->toArray();

    expect($a)->not()->toBe($b);
});

test('#sizeof', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->sizeof())->toMatchSnapshot();
});

test('#sort', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->sort()->toArray())->toMatchSnapshot();
});

test('#uasort', function (): void {
    expect(BetterArray::from(['a' => 4, 'b' => 8, 'c' => -1, 'd' => -9, 'e' => 2, 'f' => 5, 'g' => 3, 'h' => -4])->uasort(function ($a, $b) {
        if ($a === $b) {
            return 0;
        }

        return ($a < $b) ? -1 : 1;
    })->toArray())->toMatchSnapshot();
});

test('#uksort', function (): void {
    expect(BetterArray::from(['John' => 1, 'the Earth' => 2, 'an apple' => 3, 'a banana' => 4])->uksort(function ($a, $b) {
        $a = preg_replace('@^(a|an|the) @', '', $a);
        $b = preg_replace('@^(a|an|the) @', '', $b);

        return strcasecmp($a, $b);
    })->toArray())->toMatchSnapshot();
});

test('#usort', function (): void {
    expect(BetterArray::from([3, 2, 5, 6, 1])->usort(function ($a, $b) {
        if ($a === $b) {
            return 0;
        }

        return ($a < $b) ? -1 : 1;
    })->toArray())->toMatchSnapshot();
});

test('#toArray', function (): void {
    expect(BetterArray::from(['key' => 'value'])->toArray())->toMatchSnapshot();
});
