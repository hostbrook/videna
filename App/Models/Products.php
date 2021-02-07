<?php
// <Application name>
// File: /App/Models/Products.php
// Desc: Model to work with users

namespace App\Models;

use PDO;
use \Videna\Core\Log;


class Products extends \Videna\Core\Database {

	/**
	 * Get all the users as an associative array
	 *
	 * @return array
	 */
	public static function getAll() {
	
		try {
				
			$db = static::getDB();

			$stmt = $db->query('SELECT id, title FROM hbproducts ORDER BY id');
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $results;
				
		} catch (PDOException $e) {
			Log::add( ["DB Error" => $e->getMessage()], "FATAL ERROR: DB Error.");
		}

	}

} // END class Products