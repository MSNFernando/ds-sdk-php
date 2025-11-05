<?php

namespace Dreamscape\ResellerApiSdk\DataObject;

use InvalidArgumentException;

/**
 * Helpers for data-objects.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
final class Helper
{
    /**
     * Converts the response to the collection of data-objects with pagination details (if exists).
     *
     * @template T
     *
     * @param array $response
     * [
     *      'data' => array,
     *      'pagination' => [ // optional
     *          'total_items' => int,
     *          'total_pages' => int,
     *          'current_page' => int,
     *      ],
     * ]
     * @param T|string|AbstractDataObject $data_object_class
     *
     * @return T[]|AbstractDataObject[]|Collection
     */
    public static function convertResponseToDataObjectCollection(array $response, string $data_object_class): Collection
    {
        if (empty($response)) {
            throw new InvalidArgumentException('The argument $response must be not empty array');
        }

        if (empty($data_object_class)) {
            throw new InvalidArgumentException('The argument $data_object_class must be not empty string');
        }

        if (!isset($response['data'])) {
            throw new InvalidArgumentException('The array $response does not contain the \'data\' entry');
        }

        if (!is_array($response['data'])) {
            throw new InvalidArgumentException('The $response[\'data\'] entry must be an array');
        }

        if (isset($response['pagination'])) {
            if (!is_array($response['pagination'])) {
                throw new InvalidArgumentException('The $response[\'pagination\'] entry must be an array');
            }

            if (!isset($response['pagination']['total_items'])) {
                throw new InvalidArgumentException(
                    'The array $response[\'pagination\'] does not contain the \'total_items\' entry'
                );
            }

            if (!isset($response['pagination']['total_pages'])) {
                throw new InvalidArgumentException(
                    'The array $response[\'pagination\'] does not contain the \'total_pages\' entry'
                );
            }

            if (!isset($response['pagination']['current_page'])) {
                throw new InvalidArgumentException(
                    'The array $response[\'pagination\'] does not contain the \'current_page\' entry'
                );
            }
        }

        $collection = isset($response['pagination']) ? Collection::build(
            $data_object_class,
            $response['pagination']['total_items'],
            $response['pagination']['total_pages'],
            $response['pagination']['current_page']
        ) : Collection::build($data_object_class, count($response['data']));

        return $collection->import(
            array_map(
                fn ($item) => self::convertArrayToDataObject($item, $data_object_class),
                $response['data']
            )
        );
    }

    /**
     * Converts the array to the collection of data-objects.
     *
     * @template T
     *
     * @param array $items
     * @param T|string|AbstractDataObject $data_object_class
     *
     * @return T[]|AbstractDataObject[]|Collection
     */
    private static function convertArrayToDataObjectCollection(array $items, string $data_object_class): Collection
    {
        if (empty($data_object_class)) {
            throw new InvalidArgumentException('The argument $data_object_class must be not empty string');
        }

        return Collection::build($data_object_class)
            ->import(
                array_map(
                    fn ($item) => self::convertArrayToDataObject($item, $data_object_class),
                    $items
                )
            );
    }

    /**
     * Converts the response to the data-object.
     *
     * @template T
     *
     * @param array $response
     * [
     *      'data' => array,
     * ]
     * @param T|string|AbstractDataObject $data_object_class
     *
     * @return T|AbstractDataObject
     */
    public static function convertResponseToDataObject(array $response, string $data_object_class): AbstractDataObject
    {
        if (empty($response)) {
            throw new InvalidArgumentException('The argument $response must be not empty array');
        }

        if (empty($data_object_class)) {
            throw new InvalidArgumentException('The argument $data_object_class must be not empty string');
        }

        if (!isset($response['data'])) {
            throw new InvalidArgumentException('The array $response does not contain the \'data\' entry');
        }

        if (!is_array($response['data'])) {
            throw new InvalidArgumentException('The $response[\'data\'] entry must be an array');
        }

        return self::convertArrayToDataObject($response['data'], $data_object_class);
    }

    /**
     * Converts the array to the data-object.
     *
     * @template T
     *
     * @param array $item
     * @param T|string|AbstractDataObject $data_object_class
     *
     * @return T|AbstractDataObject
     */
    private static function convertArrayToDataObject(array $item, string $data_object_class): AbstractDataObject
    {
        if (empty($data_object_class)) {
            throw new InvalidArgumentException('The argument $data_object_class must be not empty string');
        }

        $properties = $data_object_class::getStructure()->getProperties();
        $values = [];

        foreach ($properties as $property_name => $property) {
            if (!isset($item[$property->field])) {
                continue;
            }

            if ($property->dataObjectType) {
                $item[$property->field] = self::convertArrayToDataObject(
                    $item[$property->field],
                    $property->dataObjectType
                );
            } elseif ($property->collectionType) {
                $item[$property->field] = self::convertArrayToDataObjectCollection(
                    $item[$property->field],
                    $property->collectionType
                );
            }

            $values[$property_name] = $item[$property->field];
        }

        return $data_object_class::build($values);
    }
}
