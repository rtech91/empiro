<?php defined('SYSPATH') or die('No direct access allowed.');
 
class Model_Group extends ORM {
    static $_model_name = 'group';
    public static function getAll(){
        return self::factory(self::$_model_name)->find_all();
    }
}    