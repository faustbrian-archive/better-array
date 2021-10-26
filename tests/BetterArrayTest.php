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
    //
});

test('#diffUassoc', function (): void {
    //
});

test('#diffUkey', function (): void {
    //
});

test('#diff', function (): void {
    //
});

test('#fillKeys', function (): void {
    //
});

test('#fill', function (): void {
    //
});

test('#filter', function (): void {
    //
});

test('#flip', function (): void {
    expect(BetterArray::from(["oranges", "apples", "pears"])->flip()->toArray())->toMatchSnapshot();
});

test('#intersectAssoc', function (): void {
    //
});

test('#intersectKey', function (): void {
    //
});

test('#intersectUassoc', function (): void {
    //
});

test('#intersectUkey', function (): void {
    //
});

test('#intersect', function (): void {
    //
});

test('#array_is_list', function (): void {
    //
});

test('#keyFirst', function (): void {
    //
});

test('#keyLast', function (): void {
    //
});

test('#keys', function (): void {
    expect(BetterArray::from(['key' => 'value'])->keys())->toMatchSnapshot();
});

test('#map', function (): void {
    //
});

test('#mergeRecursive', function (): void {
    //
});

test('#merge', function (): void {
    //
});

test('#multisort', function (): void {
    //
});

test('#pad', function (): void {
    //
});

test('#pop', function (): void {
    //
});

test('#product', function (): void {
    //
});

test('#push', function (): void {
    //
});

test('#rand', function (): void {
    //
});

test('#reduce', function (): void {
    //
});

test('#replaceRecursive', function (): void {
    //
});

test('#replace', function (): void {
    //
});

test('#reverse', function (): void {
    //
});

test('#search', function (): void {
    //
});

test('#array_shift', function (): void {
    //
});

test('#slice', function (): void {
    //
});

test('#splice', function (): void {
    //
});

test('#sum', function (): void {
    //
});

test('#udiffAssoc', function (): void {
    //
});

test('#udiffUassoc', function (): void {
    //
});

test('#udiff', function (): void {
    //
});

test('#uintersectAssoc', function (): void {
    //
});

test('#uintersectUassoc', function (): void {
    //
});

test('#uintersect', function (): void {
    //
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
    //
});

test('#walk', function (): void {
    //
});

test('#arsort', function (): void {
    //
});

test('#asort', function (): void {
    //
});

test('#count', function (): void {
    //
});

test('#current', function (): void {
    //
});

test('#each', function (): void {
    //
});

test('#end', function (): void {
    //
});

test('#extract', function (): void {
    //
});

test('#inArray', function (): void {
    //
});

test('#keyExists', function (): void {
    //
});

test('#key', function (): void {
    //
});

test('#krsort', function (): void {
    //
});

test('#ksort', function (): void {
    //
});

test('#natcasesort', function (): void {
    //
});

test('#natsort', function (): void {
    //
});

test('#next', function (): void {
    //
});

test('#pos', function (): void {
    //
});

test('#prev', function (): void {
    //
});

test('#reset', function (): void {
    //
});

test('#rsort', function (): void {
    expect(BetterArray::from(['lemon', 'orange', 'banana', 'apple'])->rsort()->values())->toMatchSnapshot();
});

test('#shuffle', function (): void {
    //
});

test('#sizeof', function (): void {
    //
});

test('#sort', function (): void {
    //
});

test('#uasort', function (): void {
    //
});

test('#uksort', function (): void {
    //
});

test('#usort', function (): void {
    //
});

test('#toArray', function (): void {
    expect(BetterArray::from(['key' => 'value'])->toArray())->toMatchSnapshot();
});
