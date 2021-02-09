<?php
// <Application name>
// File: /App/Models/User.php
// Desc: Model to work with users

namespace App\Models;

use PDO;


class Users extends \Videna\Core\Database {

	/**
	 * Get all the users as an associative array
	 * @return array with all users data
	 */
	public static function getAll() {
				
		$db = static::getDB();

		$stmt = $db->query('SELECT id, name, email FROM users ORDER BY id');

		return $stmt->fetchAll();

	}


	/**
	 * Find user by one or more criterias
	 * @param $arguments is array, for example: [ 'email' => 'john@email.com' ]
	 * @return array with user data if user exists
	 * @return false if user DOES NOT exist
	 */
	public static function getUser($arguments) {
				
		$db = static::getDB();

		// Prepare SQL query:
    $first = true;
    foreach ($arguments as $key => $value) {
      if ($first) {
        $first = false;
        $query = '';
      } else {
        $query .= ', ';
      }
      $query .=  "$key = :$key";
		}

		$sql = "SELECT * FROM users WHERE $query LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->execute($arguments);
		
		return $stmt->fetch();

	}

	
	/**
	 * Add new user in DB
	 * @param $arguments is array of user data
	 * @return int User ID (`user_id`)
	 */
  public static function addUser($arguments) {
    
    if ( !isset($arguments['name']) ) return false;
    if ( !isset($arguments['email']) ) return false;
    if ( !isset($arguments['account']) ) $arguments['account'] = USR_REG;
		
		$db = static::getDB();

		// Prepare SQL query:
    $first = true;
    foreach ($arguments as $key => $value) {
      if ($first) {
        $first = false;
        $sql_keys = '';
        $sql_values = '';
      } else {
        $sql_keys .= ', ';
        $sql_values .= ', ';
      }
      $sql_keys .=  $key;
      $sql_values .=  ":$key";
		}

		$sql = "INSERT INTO users ($sql_keys) VALUES ($sql_values)";
		$stmt = $db->prepare($sql);
		$stmt->execute($arguments);
    
    return $db->lastInsertId();
    
  }


} // END class User