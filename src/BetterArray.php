<?php

declare(strict_types=1);

namespace Faust\BetterArray;

final class BetterArray
{
    public function __construct(private array $data)
    {
        //
    }

    /**
     * Create an array.
     */
    public static function from(array $data): static
    {
        return new static($data);
    }

    /**
     * Create an array containing a range of elements.
     */
    public static function range(float $start, float $end, int|float $step = 1): static
    {
        return new static(range($start, $end, $step));
    }

    /**
     * Changes the case of all keys in an array.
     */
    public function changeKeyCase(int $case = CASE_LOWER): static
    {
        return $this->commit(array_change_key_case($this->data, $case));
    }

    /**
     * Split an array into chunks.
     */
    public function chunk(int $length, bool $preserveKeys = false): static
    {
        return $this->commit(array_chunk($this->data, $length, $preserveKeys));
    }

    /**
     * Return the values from a single column in the input array.
     */
    public function column(string|int|null $columnKey, string|int|null $indexKey = null): array
    {
        return array_column($this->data, $columnKey, $indexKey);
    }

    /**
     * Creates an array by using one array for keys and another for its values.
     */
    public function combine(array $values): static
    {
        return $this->commit(array_combine($this->values(), $values));
    }

    /**
     * Counts all the values of an array.
     */
    public function countValues(): static
    {
        return $this->commit(array_count_values($this->data));
    }

    /**
     * Computes the difference of arrays with additional index check.
     */
    public function diffAssoc(array $array2, array ...$_): static
    {
        return $this->commit(array_diff_assoc($this->data, $array2, ...$_));
    }

    /**
     * Computes the difference of arrays using keys for comparison.
     */
    public function diffKey(array $array2, array ...$_): static
    {
        return $this->commit(array_diff_key($this->data, $array2, ...$_));
    }

    /**
     * Computes the difference of arrays with additional index check which is performed by a user supplied callback function.
     */
    public function diffUassoc(callable $keyCompareFunc, array ...$_): static
    {
        return $this->commit(array_diff_uassoc($this->data, ...$_, ...[$keyCompareFunc]));
    }

    /**
     * Computes the difference of arrays using a callback function on the keys for comparison.
     */
    public function diffUkey(callable $keyCompareFunc, array $array2, array ...$_): static
    {
        return $this->commit(array_diff_ukey($this->data, $array2, ...$_, ...[$keyCompareFunc]));
    }

    /**
     * Computes the difference of arrays.
     */
    public function diff(array ...$excludes): static
    {
        return $this->commit(array_diff($this->data, ...$excludes));
    }

    /**
     * Fill an array with values, specifying keys.
     */
    public function fillKeys(array $keys, mixed $value): static
    {
        return $this->commit(array_fill_keys($keys, $value));
    }

    /**
     * Fill an array with values.
     */
    public function fill(int $startIndex, int $count, mixed $value): static
    {
        return $this->commit(array_fill($startIndex, $count, $value));
    }

    /**
     * Filters elements of an array using a callback function.
     */
    public function filter(?callable $callback, int $mode = 0): static
    {
        return $this->commit(array_filter($this->data, $callback, $mode));
    }

    /**
     * Exchanges all keys with their associated values in an array.
     */
    public function flip(): static
    {
        return $this->commit(array_flip($this->data));
    }

    /**
     * Computes the intersection of arrays with additional index check.
     */
    public function intersectAssoc(array $array2, ?array $_ = null): static
    {
        return $this->commit(array_intersect_assoc($this->data, $array2, $_));
    }

    /**
     * Computes the intersection of arrays using keys for comparison.
     */
    public function intersectKey(array $array2, ?array $_ = null): static
    {
        return $this->commit(array_intersect_key($this->data, $array2, $_));
    }

    /**
     * Computes the intersection of arrays with additional index check, compares indexes by a callback function.
     */
    public function intersectUassoc(array $array2, ?array $_ = null): static
    {
        return $this->commit(array_intersect_uassoc($this->data, $array2, $_));
    }

    /**
     * Computes the intersection of arrays using a callback function on the keys for comparison.
     */
    public function intersectUkey(array $array2, ?array $_ = null): static
    {
        return $this->commit(array_intersect_ukey($this->data, $array2, $_));
    }

    /**
     * Computes the intersection of arrays.
     */
    public function intersect(array $array2, ?array $_ = null): static
    {
        return $this->commit(array_intersect($this->data, $array2, $_));
    }

    /**
     * Checks whether a given array is a list.
     */
    public function isList(): bool
    {
        if (empty($this->data)) {
            return true;
        }

        $current_key = 0;

        foreach ($this->keys() as $key) {
            if ($key !== $current_key) {
                return false;
            }

            $current_key++;
        }

        return true;
    }

    /**
     * Gets the first key of an array.
     */
    public function keyFirst(): mixed
    {
        return array_key_first($this->data);
    }

    /**
     * Gets the last key of an array.
     */
    public function keyLast(): mixed
    {
        return array_key_last($this->data);
    }

    /**
     * Return all the keys or a subset of the keys of an array.
     */
    public function keys(): array
    {
        return array_keys($this->data);
    }

    /**
     * Applies the callback to the elements of the given arrays.
     */
    public function map(callable $callback, array ...$arrays): static
    {
        return $this->commit(array_map($callback, $this->data, ...$arrays));
    }

    /**
     * Merge one or more arrays recursively.
     */
    public function mergeRecursive(array ...$arrays): static
    {
        return $this->commit(array_merge_recursive($this->data, ...$arrays));
    }

    /**
     * Merge one or more arrays.
     */
    public function merge(array ...$arrays): static
    {
        return $this->commit(array_merge($this->data, ...$arrays));
    }

    /**
     * Sort multiple or multi-dimensional arrays.
     */
    public function multisort(array ...$arrays): static
    {
        array_multisort($this->data, ...$arrays);

        return $this;
    }

    /**
     * Pad array to the specified length with a value.
     */
    public function pad(int $length, mixed $value): static
    {
        return $this->commit(array_pad($this->data, $length, $value));
    }

    /**
     * Pop the element off the end of array.
     */
    public function pop(): mixed
    {
        return array_pop($this->data);
    }

    /**
     * Calculate the product of values in an array.
     */
    public function product(): int|float
    {
        return array_product($this->data);
    }

    /**
     * Push one or more elements onto the end of array.
     */
    public function push(array ...$values): static
    {
        array_push($this->data, ...$values);

        return $this;
    }

    /**
     * Pick one or more random keys out of an array.
     */
    public function rand(int $num = 1): mixed
    {
        return array_rand($this->data, $num);
    }

    /**
     * Iteratively reduce the array to a single value using a callback function.
     */
    public function reduce(callable $callback, mixed $initial): static
    {
        return $this->commit(array_reduce($this->data, $callback, $initial));
    }

    /**
     * Replaces elements from passed arrays into the first array recursively.
     */
    public function replaceRecursive(array ...$replacements): static
    {
        return $this->commit(array_replace_recursive($this->data, ...$replacements));
    }

    /**
     * Replaces elements from passed arrays into the first array.
     */
    public function replace(array ...$replacements): static
    {
        return $this->commit(array_replace($this->data, ...$replacements));
    }

    /**
     * Return an array with elements in reverse order.
     */
    public function reverse(bool $preserveKeys = false): static
    {
        array_reverse($this->data, $preserveKeys);

        return $this;
    }

    /**
     * Searches the array for a given value and returns the first corresponding key if successful.
     */
    public function search(mixed $needle, bool $strict = false): mixed
    {
        return array_search($needle, $this->data, $strict);
    }

    /**
     * Shift an element off the beginning of array.
     */
    public function array_shift(): static
    {
        array_shift($this->data);

        return $this;
    }

    /**
     * Extract a slice of the array.
     */
    public function slice(int $offset, ?int $length, bool $preserveKeys = false): static
    {
        return $this->commit(array_slice($this->data, $offset, $length, $preserveKeys));
    }

    /**
     * Remove a portion of the array and replace it with something else.
     */
    public function splice(int $offset, ?int $length, mixed $replacement): static
    {
        return $this->commit(array_splice($this->data, $offset, $length, $replacement));
    }

    /**
     * Calculate the sum of values in an array.
     */
    public function sum(): int|float
    {
        return array_sum($this->data);
    }

    /**
     * Computes the difference of arrays with additional index check, compares data by a callback function.
     */
    public function udiffAssoc(callable $dataCompareFunc, array $array2, ?array $_ = null): static
    {
        return $this->commit(array_udiff_assoc($this->data, $array2, $_, $dataCompareFunc));
    }

    /**
     * Computes the difference of arrays with additional index check, compares data and indexes by a callback function.
     */
    public function udiffUassoc(
        callable $dataCompareFunc,
        callable $keyCompareFunc,
        array $array2,
        ?array $_ = null,
    ): static {
        return $this->commit(array_udiff_uassoc($this->data, $array2, $_, $dataCompareFunc, $keyCompareFunc));
    }

    /**
     * Computes the difference of arrays by using a callback function for data comparison.
     */
    public function udiff(
        callable $dataCompareFunc,
        array $array2,
        ?array $_ = null,
    ): static {
        return $this->commit(array_udiff($this->data, $array2, $_, $dataCompareFunc));
    }

    /**
     * Computes the intersection of arrays with additional index check, compares data by a callback function.
     */
    public function uintersectAssoc(
        callable $dataCompareFunc,
        array $array2,
        ?array $_ = null,
    ): static {
        return $this->commit(array_uintersect_assoc($this->data, $array2, $_, $dataCompareFunc));
    }

    /**
     * Computes the intersection of arrays with additional index check, compares data and indexes by separate callback functions.
     */
    public function uintersectUassoc(
        callable $dataCompareFunc,
        callable $keyCompareFunc,
        array $array2,
        ?array $_ = null,
    ): static {
        return $this->commit(array_uintersect_uassoc($this->data, $array2, $_, $dataCompareFunc, $keyCompareFunc));
    }

    /**
     * Computes the intersection of arrays, compares data by a callback function.
     */
    public function uintersect(
        callable $dataCompareFunc,
        array $array2,
        ?array $_ = null,
    ): static {
        return $this->commit(array_uintersect($this->data, $array2, $_, $dataCompareFunc));
    }

    /**
     * Removes duplicate values from an array.
     */
    public function unique(int $flags = SORT_STRING): static
    {
        return $this->commit(array_unique($this->data, $flags));
    }

    /**
     * Prepend one or more elements to the beginning of an array.
     */
    public function unshift(...$values): static
    {
        array_unshift($this->data, ...$values);

        return $this;
    }

    /**
     * Return all the values of an array.
     */
    public function values(): array
    {
        return array_values($this->data);
    }

    /**
     * Apply a user function recursively to every member of an array.
     */
    public function walkRecursive(callable $callback, mixed $arg): static
    {
        array_walk_recursive($this->data, $callback, $arg);

        return $this;
    }

    /**
     * Apply a user supplied function to every member of an array.
     */
    public function walk(callable $callback, mixed $arg): static
    {
        array_walk($this->data, $callback, $arg);

        return $this;
    }

    /**
     * Sort an array in descending order and maintain index association.
     */
    public function arsort(int $flags = SORT_REGULAR): static
    {
        arsort($this->data, $flags);

        return $this;
    }

    /**
     * Sort an array in ascending order and maintain index association.
     */
    public function asort(int $flags = SORT_REGULAR): static
    {
        asort($this->data, $flags);

        return $this;
    }

    /**
     * Counts all elements in an array or in a Countable object.
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * Return the current element in an array.
     */
    public function current(): mixed
    {
        return current($this->data);
    }

    /**
     * Return the current key and value pair from an array and advance the array cursor.
     */
    public function each(): static
    {
        return $this;
    }

    /**
     * Set the internal pointer of an array to its last element.
     */
    public function end(): static
    {
        end($this->data);

        return $this;
    }

    /**
     * Import variables into the current symbol table from an array.
     */
    public function extract(int $flags, string $prefix): static
    {
        extract($this->data, $flags, $prefix);

        return $this;
    }

    /**
     * Checks if a value exists in an array.
     */
    public function inArray(mixed $needle, bool $strict = false): static
    {
        return in_array($needle, $this->data, $strict);
    }

    /**
     * Alias of array_key_exists.
     */
    public function keyExists(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Fetch a key from an array.
     */
    public function key(): mixed
    {
        return key($this->data);
    }

    /**
     * Sort an array by key in descending order.
     */
    public function krsort(int $flags = SORT_REGULAR): static
    {
        krsort($this->data, $flags);

        return $this;
    }

    /**
     * Sort an array by key in ascending order.
     */
    public function ksort(int $flags = SORT_REGULAR): static
    {
        ksort($this->data, $flags);

        return $this;
    }

    /**
     * Sort an array using a case insensitive "natural order" algorithm.
     */
    public function natcasesort(): static
    {
        natcasesort($this->data);

        return $this;
    }

    /**
     * Sort an array using a "natural order" algorithm.
     */
    public function natsort(): static
    {
        natsort($this->data);

        return $this;
    }

    /**
     * Advance the internal pointer of an array.
     */
    public function next(): static
    {
        next($this->data);

        return $this;
    }

    /**
     * Alias of current.
     */
    public function pos(): static
    {
        return $this->commit(current($this->data));
    }

    /**
     * Rewind the internal array pointer.
     */
    public function prev(): static
    {
        prev($this->data);

        return $this;
    }

    /**
     * Set the internal pointer of an array to its first element.
     */
    public function reset(): static
    {
        return $this->commit(reset($this->data));
    }

    /**
     * Sort an array in descending order.
     */
    public function rsort(int $flags = SORT_REGULAR): static
    {
        rsort($this->data, $flags);

        return $this;
    }

    /**
     * Shuffle an array.
     */
    public function shuffle(): static
    {
        shuffle($this->data);

        return $this;
    }

    /**
     * Alias of count.
     */
    public function sizeof(int $mode = COUNT_NORMAL): int
    {
        return count($this->data, $mode);
    }

    /**
     * Sort an array in ascending order.
     */
    public function sort(int $flags = SORT_REGULAR): static
    {
        sort($this->data, $flags);

        return $this;
    }

    /**
     * Sort an array with a user-defined comparison function and maintain index association.
     */
    public function uasort(callable $callback): static
    {
        uasort($this->data, $callback);

        return $this;
    }

    /**
     * Sort an array by keys using a user-defined comparison function.
     */
    public function uksort(callable $callback): static
    {
        uksort($this->data, $callback);

        return $this;
    }

    /**
     * Sort an array by values using a user-defined comparison function.
     */
    public function usort(callable $callback): static
    {
        usort($this->data, $callback);

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    private function commit(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
