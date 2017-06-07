<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model specified to handle with system statistics.
 */
class Model_Statistic extends ORM {
	
	static $_model_name = 'statistic';
	
	/**
	 * Get all records from table.
	 * @return Object Result set with records.
	 */
	public static function getAll() {
		$all_stats = self::factory(self::$_model_name);
		return $all_stats;
	}
	
	/**
	 * Save or update statistics record.
	 * @param $id int NULL Id for record to update.
	 */
	public static function saveOrUpdate($id = null) {
		//TODO: add code to save new
		// or update a record that already exist
	}
	
	/**
	 * Remove statistics record if exists.
	 * @param int $id Id of record to remove.
	 */
	public static function removeStat($id) {
		$item = self::factory(self::$_model_name, $id);
		if($item) {
			$item->delete();
		}
	}
	
} // End Model_Statictic