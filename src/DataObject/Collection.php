<?php

namespace Dreamscape\ResellerApiSdk\DataObject;

use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use InvalidArgumentException;
use Iterator;
use ArrayAccess;
use Countable;
use ReturnTypeWillChange;

/**
 * Class for storing the collection of data-objects and primitives.
 *
 * @property-read string $type
 * @property-read int $totalItems
 * @property-read int $totalPages
 * @property-read int $currentPage
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
final class Collection implements Iterator, ArrayAccess, Countable
{
    private array $items = [];
    private string $type;
    private bool $is_type_primitive = false;

    private int $total_items = 0;
    private int $total_pages = 1;
    private int $current_page = 1;

    /**
     * Constructor.
     *
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    private function __construct(string $type)
    {
        if (empty($type)) {
            throw new InvalidArgumentException('The argument $type must be not empty string');
        }

        if (DataType::isValid($type)) {
            $this->is_type_primitive = true;
        } elseif (!in_array(AbstractDataObject::class, class_parents($type))) {
            throw new InvalidArgumentException('The class must be heir of \'' . AbstractDataObject::class . '\'');
        }

        $this->type = $type;
    }

    /**
     * Created the instance of collection of the specified type.
     *
     * @param string $type
     * @param int $total_items
     * @param int $total_pages
     * @param int $current_page
     *
     * @return self
     *
     * @throws InvalidArgumentException
     */
    public static function build(
        string $type,
        int $total_items = 0,
        int $total_pages = 1,
        int $current_page = 1
    ): self {
        $object = new self($type);
        $object->total_items = $total_items;
        $object->total_pages = $total_pages;
        $object->current_page = $current_page;

        return $object;
    }

    /**
     * @param string $name
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function __get(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        switch ($name) {
            case 'type':
                return $this->type;

            case 'totalItems':
                return $this->total_items;

            case 'totalPages':
                return $this->total_pages;

            case 'currentPage':
                return $this->current_page;
        }

        throw new InvalidArgumentException('The property \'' . $name . '\' does not exist');
    }

    /**
     * @param array $items
     *
     * @return self
     *
     * @throws InvalidArgumentException
     */
    public function import(array $items): self
    {
        foreach ($items as $item) {
            $this->add($item);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * @param mixed $item
     *
     * @return self
     *
     * @throws InvalidArgumentException
     */
    public function add($item): self
    {
        $this->checkItemApplicable($item);

        $this->items[] = $this->is_type_primitive ? DataType::convert($this->type, $item) : $item;

        return $this;
    }

    /**
     * Checks is the provided item applicable for this collection
     * according to its type.
     *
     * @param mixed $item
     *
     * @throws InvalidArgumentException
     */
    private function checkItemApplicable($item)
    {
        if ($this->is_type_primitive) {
            if (!DataType::isValueApplicable($this->type, $item)) {
                throw new InvalidArgumentException(
                    'Only items of type \'' . $this->type . '\' can be ' .
                    'added, \'' . DataType::getType($item) . '\' provided'
                );
            }
        } elseif (!$item instanceof $this->type) {
            throw new InvalidArgumentException(
                'Only instances of \'' . $this->type . '\' class ' .
                'can be added, \'' . DataType::getType($item) . '\' provided'
            );
        }
    }

    /**
     * @param string|null $keyColumn
     * @return array
     */
    public function toArray(string $keyColumn = null): array
    {
        if ($keyColumn !== null && $this->is_type_primitive) {
            throw new InvalidArgumentException(
                'The use of $keyColumn argument is not applicable for collection with primitive types'
            );
        }

        if ($keyColumn !== null) {
            return array_combine(
                array_map(fn ($item) => $item->$keyColumn, $this->items),
                array_map(fn ($item) => $item->toArray(), $this->items)
            );
        }

        return array_values(array_map(function ($item) {
            /** @var AbstractDataObject $item */
            return $this->is_type_primitive ? $item : $item->toArray();
        }, $this->items));
    }

    /**
     * @return array
     */
    public function toRequestArray(): array
    {
        return array_values(array_map(function ($item) {
            return $this->is_type_primitive ? $item : $item->toRequestArray();
        }, $this->items));
    }

    /**
     * Returns the collection items as an array.
     *
     * @return array
     */
    public function values(): array
    {
        return array_values($this->items);
    }

    /**
     * Returns the collection items as a list of values of the specified column.
     * Can be used only for collections of objects.
     *
     * @param string $column
     * @return array
     */
    public function columnValues(string $column): array
    {
        if ($this->is_type_primitive) {
            throw new InvalidArgumentException('The method is not applicable for primitive types');
        }

        return array_values(array_map(fn ($item) => $item->$column, $this->items));
    }

    /**
     * Combines the collection items into an associative array using the specified columns.
     *
     * @param string $keyColumn
     * @param string $valueColumn
     * @return array
     */
    public function combine(string $keyColumn, string $valueColumn): array
    {
        if ($this->is_type_primitive) {
            throw new InvalidArgumentException('The method is not applicable for primitive types');
        }

        $result = [];

        foreach ($this->items as $item) {
            $result[$item->$keyColumn] = $item->$valueColumn;
        }

        return $result;
    }

    /**
     * Maps the collection items using the specified callback.
     *
     * @param callable $callback
     * @return array
     */
    public function map($callback): array
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('The argument $callback must be callable');
        }

        return array_values(array_map($callback, $this->items));
    }

    /**
     * Reduces the collection to a single value using the callback.
     *
     * @param callable $callback
     * @param $initial
     * @return mixed|null
     */
    public function reduce($callback, $initial = null)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('The argument $callback must be callable');
        }

        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * Filters the collection using the callback.
     *
     * @param callable $callback
     * @return self
     */
    public function filter($callback): self
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('The argument $callback must be callable');
        }

        $items = array_filter($this->items, $callback);
        $newCollection = self::build($this->type, $this->totalItems, $this->totalPages, $this->currentPage);
        $newCollection->import($items);

        return $newCollection;
    }

    /**
     * Finds the first item in the collection using the callback.
     *
     * @param callable $callback
     * @return mixed|null
     */
    public function find($callback)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('The argument $callback must be callable');
        }

        foreach ($this->items as $item) {
            if ($callback($item)) {
                return $item;
            }
        }

        return null;
    }

    #region Interface Iterator

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange]
    public function current()
    {
        return current($this->items);
    }

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange]
    public function next()
    {
        next($this->items);
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return key($this->items);
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return current($this->items) !== false;
    }

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange]
    public function rewind()
    {
        reset($this->items);
    }

    #endregion

    #region Interface ArrayAccess

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @inheritDoc
     *
     * @throws InvalidArgumentException
     */
    #[ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        if (!is_integer($offset)) {
            throw new InvalidArgumentException(
                'Offset must be a integer type, \'' . DataType::getType($offset) . '\' given'
            );
        }

        return $this->items[$offset] ?? null;
    }

    /**
     * @inheritDoc
     *
     * @throws InvalidArgumentException
     */
    #[ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $this->checkItemApplicable($value);

        if (is_null($offset)) {
            $this->items[] = $value;

            return;
        }

        if (!is_integer($offset)) {
            throw new InvalidArgumentException(
                'Offset must be a integer type, \'' . DataType::getType($offset) . '\' given'
            );
        }

        if ($offset >= count($this->items)) {
            throw new InvalidArgumentException('Array offset out of bounds');
        }

        $this->items[$offset] = $value;
    }

    /**
     * @inheritDoc
     *
     * @throws InvalidArgumentException
     */
    #[ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        if (!is_integer($offset)) {
            throw new InvalidArgumentException(
                'Offset must be a integer type, \'' . DataType::getType($offset) . '\' given'
            );
        }

        unset($this->items[$offset]);

        // to order elements of array
        $this->items = array_values($this->items);
    }

    #endregion

    #region Interface Countable

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->items);
    }

    #endregion
}
