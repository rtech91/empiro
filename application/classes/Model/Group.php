<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Group extends ORM
{
    private static $model_name = 'group';
    public static function getAll()
    {
        return self::factory(self::$model_name)->find_all();
    }
}
