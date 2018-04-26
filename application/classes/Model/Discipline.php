<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model specified to manage with table for disciplines.
 */
class Model_Discipline extends ORM
{
    /**
     * @var $model_name Name of model.
     */
    private static $model_name = 'discipline';

    /**
     * Get all disciplines.
     *
     * @return Object Result set with all disciplines.
     */
    public static function getAll()
    {
        $disciplines = self::factory(self::$model_name);
        return $disciplines;
    }
} // End Model_Discipline
