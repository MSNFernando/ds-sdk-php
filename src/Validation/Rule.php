<?php

namespace Dreamscape\ResellerApiSdk\Validation;

use Closure;
use InvalidArgumentException;

/**
 * The class that creates the instances of the corresponding of rule.
 *
 * @method static Rule\Required required()
 * @method static Rule\NotEmpty notEmpty()
 * @method static Rule\NotEmptyArray notEmptyArray()
 * @method static Rule\AllowedValues allowedValues(array $allowed_values)
 * @method static Rule\NumberPositive numberPositive()
 * @method static Rule\NumberGreaterEqual numberGreaterEqual(int $number)
 * @method static Rule\Custom custom(Closure $callback)
 * @method static Rule\LengthBetween lengthBetween(int $min, int $max)
 * @method static Rule\PhoneNumber phoneNumber()
 * @method static Rule\IpAddress ipAddress(string $type)
 * @method static Rule\NumberLessEqual numberLessEqual(int $number)
 * @method static Rule\Email email()
 * @method static Rule\Regex regex(string $regex)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Rule
{
    /**
     * Mapping between the rule name and the corresponding rule class.
     *
     * @var string[]
     */
    private static array $rule_to_class_mapping = [
        'required' => Rule\Required::class,
        'notEmpty' => Rule\NotEmpty::class,
        'notEmptyArray' => Rule\NotEmptyArray::class,
        'allowedValues' => Rule\AllowedValues::class,
        'numberPositive' => Rule\NumberPositive::class,
        'numberGreaterEqual' => Rule\NumberGreaterEqual::class,
        'custom' => Rule\Custom::class,
        'lengthBetween' => Rule\LengthBetween::class,
        'phoneNumber' => Rule\PhoneNumber::class,
        'ipAddress' => Rule\IpAddress::class,
        'numberLessEqual' => Rule\NumberLessEqual::class,
        'email' => Rule\Email::class,
        'regex' => Rule\Regex::class,
    ];

    /**
     * Creates the instance of the corresponding rule.
     *
     * @param string $name
     * @param array $parameters
     *
     * @return Rule\AbstractRule
     */
    public static function __callStatic(string $name, array $parameters = []): Rule\AbstractRule
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        if (!isset(self::$rule_to_class_mapping[$name])) {
            throw new InvalidArgumentException('The rule \'' . $name . '\' does not exist');
        }

        /** @var Rule\AbstractRule $rule_class */
        $rule_class = self::$rule_to_class_mapping[$name];

        return $rule_class::build($parameters);
    }
}
