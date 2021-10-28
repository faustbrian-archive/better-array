<?php

declare(strict_types=1);

namespace Faust\BetterArray;

final class BetterArray
{
    public function __construct(private array $data)
    {
        //
    }

    public static function from(array $data): static
    {
        return new static($data);
    }

    public static function range(float $start, float $end, int|float $step = 1): static
    {
        return new static(range($start, $end, $step));
    }

    public function changeKeyCase(int $case = CASE_LOWER): static
    {
        return $this->commit(array_change_key_case($this->data, $case));
    }

    public function chunk(int $length, bool $preserveKeys = false): static
    {
        return $this->commit(array_chunk($this->data, $length, $preserveKeys));
    }

    public function column(string|int|null $columnKey, string|int|null $indexKey = null): array
    {
        return array_column($this->data, $columnKey, $indexKey);
    }

    public function combine(array $values): static
    {
        return $this->commit(array_combine($this->values(), $values));
    }

    public function countValues(): static
    {
        return $this->commit(array_count_values($this->data));
    }

    public function diffAssoc(array $array2, array ...$_): static
    {
        return $this->commit(array_diff_assoc($this->data, $array2, ...$_));
    }

    public function diffKey(array $array2, array ...$_): static
    {
        return $this->commit(array_diff_key($this->data, $array2, ...$_));
    }

    public function diffUassoc(callable $keyCompareFunc, array ...$_): static
    {
        return $this->commit(array_diff_uassoc($this->data, ...$_, ...[$keyCompareFunc]));
    }

    public function diffUkey(callable $keyCompareFunc, array $array2, array ...$_): static
    {
        return $this->commit(array_diff_ukey($this->data, $array2, ...$_, ...[$keyCompareFunc]));
    }

    public function diff(array ...$excludes): static
    {
        return $this->commit(array_diff($this->data, ...$excludes));
    }

    public function fillKeys(array $keys, mixed $value): static
    {
        return $this->commit(array_fill_keys($keys, $value));
    }

    public function fill(int $startIndex, int $count, mixed $value): static
    {
        return $this->commit(array_fill($startIndex, $count, $value));
    }

    public function filter(?callable $callback, int $mode = 0): static
    {
        return $this->commit(array_filter($this->data, $callback, $mode));
    }

    public function flip(): static
    {
        return $this->commit(array_flip($this->data));
    }

    public function intersectAssoc(array $array2, ?array $_ = []): static
    {
        return $this->commit(array_intersect_assoc($this->data, $array2, $_));
    }

    public function intersectKey(array $array2, ?array $_ = []): static
    {
        return $this->commit(array_intersect_key($this->data, $array2, $_));
    }

    public function intersectUassoc(callable $keyCompareFunc, array $array2, ?array $_ = []): static
    {
        return $this->commit(array_intersect_uassoc($this->data, $array2, $_, $keyCompareFunc));
    }

    public function intersectUkey(callable $keyCompareFunc, array $array2, ?array $_ = []): static
    {
        return $this->commit(array_intersect_ukey($this->data, $array2, $_, $keyCompareFunc));
    }

    public function intersect(array $array2, ?array $_ = []): static
    {
        return $this->commit(array_intersect($this->data, $array2, $_));
    }

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

    public function keyFirst(): mixed
    {
        return array_key_first($this->data);
    }

    public function keyLast(): mixed
    {
        return array_key_last($this->data);
    }

    public function keys(): array
    {
        return array_keys($this->data);
    }

    public function map(callable $callback, array ...$arrays): static
    {
        return $this->commit(array_map($callback, $this->data, ...$arrays));
    }

    public function mergeRecursive(array ...$arrays): static
    {
        return $this->commit(array_merge_recursive($this->data, ...$arrays));
    }

    public function merge(array ...$arrays): static
    {
        return $this->commit(array_merge($this->data, ...$arrays));
    }

    public function multisort(array ...$arrays): static
    {
        array_multisort($this->data, ...$arrays);

        return $this;
    }

    public function pad(int $length, mixed $value): static
    {
        return $this->commit(array_pad($this->data, $length, $value));
    }

    public function pop(): mixed
    {
        return array_pop($this->data);
    }

    public function product(): int|float
    {
        return array_product($this->data);
    }

    public function push(...$values): static
    {
        array_push($this->data, ...$values);

        return $this;
    }

    public function rand(int $num = 1): mixed
    {
        return $this->data[array_rand($this->data, $num)];
    }

    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        return array_reduce($this->data, $callback, $initial);
    }

    public function replaceRecursive(array ...$replacements): static
    {
        return $this->commit(array_replace_recursive($this->data, ...$replacements));
    }

    public function replace(array ...$replacements): static
    {
        return $this->commit(array_replace($this->data, ...$replacements));
    }

    public function reverse(bool $preserveKeys = false): static
    {
        array_reverse($this->data, $preserveKeys);

        return $this;
    }

    public function search(mixed $needle, bool $strict = false): mixed
    {
        return array_search($needle, $this->data, $strict);
    }

    public function shift(): static
    {
        array_shift($this->data);

        return $this;
    }

    public function slice(int $offset, ?int $length = null, bool $preserveKeys = false): static
    {
        return $this->commit(array_slice($this->data, $offset, $length, $preserveKeys));
    }

    public function splice(int $offset, ?int $length = null, mixed $replacement = []): static
    {
        return $this->commit(array_splice($this->data, $offset, $length, $replacement));
    }

    public function sum(): int|float
    {
        return array_sum($this->data);
    }

    public function udiffAssoc(callable $dataCompareFunc, array $array2): static
    {
        return $this->commit(array_udiff_assoc($this->data, $array2, $dataCompareFunc));
    }

    public function udiffUassoc(
        array|callable $dataCompareFunc,
        array|callable $keyCompareFunc,
        array $array2,
    ): static {
        return $this->commit(array_udiff_uassoc($this->data, $array2, $dataCompareFunc, $keyCompareFunc));
    }

    public function udiff(
        callable $dataCompareFunc,
        array $array2,
    ): static {
        return $this->commit(array_udiff($this->data, $array2, $dataCompareFunc));
    }

    public function uintersectAssoc(
        callable $dataCompareFunc,
        array $array2,
    ): static {
        return $this->commit(array_uintersect_assoc($this->data, $array2, $dataCompareFunc));
    }

    public function uintersectUassoc(
        callable $dataCompareFunc,
        callable $keyCompareFunc,
        array $array2,
    ): static {
        return $this->commit(array_uintersect_uassoc($this->data, $array2, $dataCompareFunc, $keyCompareFunc));
    }

    public function uintersect(
        callable|string $dataCompareFunc,
        array $array2,
    ): static {
        return $this->commit(array_uintersect($this->data, $array2, $dataCompareFunc));
    }

    public function unique(int $flags = SORT_STRING): static
    {
        return $this->commit(array_unique($this->data, $flags));
    }

    public function unshift(...$values): static
    {
        array_unshift($this->data, ...$values);

        return $this;
    }

    public function values(): array
    {
        return array_values($this->data);
    }

    public function walkRecursive(callable $callback, mixed $arg = null): static
    {
        array_walk_recursive($this->data, $callback, $arg);

        return $this;
    }

    public function walk(callable $callback, mixed $arg = null): static
    {
        array_walk($this->data, $callback, $arg);

        return $this;
    }

    public function arsort(int $flags = SORT_REGULAR): static
    {
        arsort($this->data, $flags);

        return $this;
    }

    public function asort(int $flags = SORT_REGULAR): static
    {
        asort($this->data, $flags);

        return $this;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function current(): mixed
    {
        return current($this->data);
    }

    public function end(): mixed
    {
        return end($this->data);
    }

    public function inArray(mixed $needle, bool $strict = false): bool
    {
        return in_array($needle, $this->data, $strict);
    }

    public function keyExists(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function key(): mixed
    {
        return key($this->data);
    }

    public function krsort(int $flags = SORT_REGULAR): static
    {
        krsort($this->data, $flags);

        return $this;
    }

    public function ksort(int $flags = SORT_REGULAR): static
    {
        ksort($this->data, $flags);

        return $this;
    }

    public function natcasesort(): static
    {
        natcasesort($this->data);

        return $this;
    }

    public function natsort(): static
    {
        natsort($this->data);

        return $this;
    }

    public function next(): static
    {
        next($this->data);

        return $this;
    }

    public function pos(): mixed
    {
        return current($this->data);
    }

    public function prev(): static
    {
        prev($this->data);

        return $this;
    }

    public function reset(): mixed
    {
        return reset($this->data);
    }

    public function rsort(int $flags = SORT_REGULAR): static
    {
        rsort($this->data, $flags);

        return $this;
    }

    public function shuffle(): static
    {
        shuffle($this->data);

        return $this;
    }

    public function sizeof(int $mode = COUNT_NORMAL): int
    {
        return count($this->data, $mode);
    }

    public function sort(int $flags = SORT_REGULAR): static
    {
        sort($this->data, $flags);

        return $this;
    }

    public function uasort(callable $callback): static
    {
        uasort($this->data, $callback);

        return $this;
    }

    public function uksort(callable $callback): static
    {
        uksort($this->data, $callback);

        return $this;
    }

    public function usort(callable $callback): static
    {
        usort($this->data, $callback);

        return $this;
    }

    public function pluck(string $key): static
    {
        return $this->commit(array_map(fn ($value) => $value[$key], $this->data));
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
