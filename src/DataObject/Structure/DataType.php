<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Structure;

use Closure;
use DateTime;
use Exception;
use InvalidArgumentException;

/**
 * Data-types.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
final class DataType
{
    public const INTEGER = 'integer';
    public const STRING = 'string';
    public const FLOAT = 'float';
    public const BOOL = 'bool';
    public const INTEGER_ARRAY = 'int[]';
    public const STRING_ARRAY = 'string[]';
    public const DATETIME = 'DATETIME';
    public const ARRAY = 'array';
    public const CLOSURE = 'Closure';

    /**
     * Checks is data-type valid.
     *
     * @param string $type
     *
     * @return bool
     */
    public static function isValid(string $type): bool
    {
        switch ($type) {
            case self::INTEGER:
            case self::STRING:
            case self::FLOAT:
            case self::BOOL:
            case self::INTEGER_ARRAY:
            case self::STRING_ARRAY:
            case self::ARRAY:
            case self::DATETIME:
            case self::CLOSURE:
                return true;
        }

        return false;
    }

    /**
     * Helper method for data type conversion.
     *
     * @param string $target_type
     * @param mixed $value
     *
     * @return bool|float|int|string|array|null|DateTime|Closure
     */
    public static function convert(string $target_type, $value)
    {
        if (null === $value) {
            return null;
        }

        switch ($target_type) {
            case self::INTEGER:
                if (!is_scalar($value)) {
                    return null;
                }

                if (is_integer($value)) {
                    return $value;
                }

                if (is_float($value)) {
                    return (int) $value;
                }

                return filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

            case self::FLOAT:
                if (!is_scalar($value)) {
                    return null;
                }

                return filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);

            case self::STRING:
                if (!is_scalar($value)) {
                    return null;
                }

                return (string) $value;

            case self::BOOL:
                if (!is_scalar($value)) {
                    return null;
                }

                return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

            case self::INTEGER_ARRAY:
                if (!is_array($value)) {
                    return null;
                }

                foreach ($value as &$item) {
                    $item = self::convert(self::INTEGER, $item);

                    if ($item === null) {
                        return null;
                    }
                }

                return $value;

            case self::STRING_ARRAY:
                if (!is_array($value)) {
                    return null;
                }

                foreach ($value as &$item) {
                    $item = self::convert(self::STRING, $item);

                    if ($item === null) {
                        return null;
                    }
                }

                return $value;

            case self::ARRAY:
                if (!is_array($value)) {
                    return null;
                }

                return $value;

            case DataType::DATETIME:
                if ($value instanceof DateTime) {
                    return $value;
                }

                if (!is_scalar($value)) {
                    return null;
                }

                try {
                    return new DateTime($value);
                } catch (Exception $e) {
                    return null;
                }

            case self::CLOSURE:
                if ($value instanceof Closure) {
                    return $value;
                }

                return null;
        }

        throw new InvalidArgumentException('Undefined data type is appeared - \'' . $target_type . '\'!');
    }

    /**
     * Checks is the value applicable for the specified type.
     *
     * @param string $type
     * @param mixed $value
     *
     * @return bool
     */
    public static function isValueApplicable(string $type, $value): bool
    {
        if (!is_scalar($value) && !$value instanceof DateTime && !is_array($value) && !$value instanceof Closure) {
            return false;
        }

        $converted = self::convert($type, $value);

        if ($converted === null) {
            return false;
        }

        switch ($type) {
            case self::INTEGER:
            case self::STRING:
                return (string) $converted === (string) $value;
        }

        return true;
    }

    /**
     *
     * Determines the type of the specified value.
     *
     * @param mixed $item
     *
     * @return string
     */
    public static function getType($item): string
    {
        return is_object($item) ? get_class($item) : gettype($item);
    }
}
