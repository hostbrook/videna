<?php
// <Application name>
// File: /App/Models/Tokens.php
// Desc: Model to work with tokens

namespace App\Models;

use PDO;


class Tokens extends \Videna\Core\Database {


	/**
	 * Find User ID by 'private-key' and 'public-key'
 	 *
	 * @return array
	 */
	public static function getUserId($publicKey, $privateKey) {
				
		$db = static::getDB();

		$sql = 'SELECT user_id FROM tokens 
						WHERE public_key = :public_key AND private_key = :private_key
						LIMIT 1';

		$stmt = $db->prepare($sql);

		$stmt->execute([ 
			'public_key' => $publicKey, 
			'private_key' => $privateKey 
		]);
		
		$user_id = $stmt->fetchColumn();

		if ( $user_id ) {
			return $user_id;
		} else return null;

	}


	/**
	 * Update 'public-key' and expires time in DB bby 'private-key' and User ID.
 	 *
	 * @return void
	 */
	public static function updatePublicKey($publicKey, $userId, $privateKey, $expires=0) {
				
		$db = static::getDB();

		// Check if 'private-key' exists

		$sql = 'SELECT id 
						FROM tokens 
						WHERE private_key = :private_key AND user_id = :user_id
						LIMIT 1';

		$stmt = $db->prepare($sql);

		$stmt->execute([ 
			'private_key' => $privateKey, 
			'user_id' => $userId 
		]);

		$id = $stmt->fetchColumn();

		if ( $id ){
			// 'private-key' already exists. Just update 'public-key' value:

			$sql = 'UPDATE tokens  
							SET public_key = :public_key, date=now(), expires = :expires 
				 			WHERE id = :id 
							LIMIT 1';
							 
			$stmt = $db->prepare($sql);

			$stmt->execute([ 
				'id' => $id, 
				'public_key' => $publicKey,
				'expires' => $expires 
			]);

		} 
		else {
			// 'private-key' DOES NOT exist. Add a record with the new 'public-key':

			$sql = 'INSERT INTO tokens (user_id, public_key, private_key, expires) 
							VALUES (:user_id, :public_key, :private_key, :expires)';

			$stmt = $db->prepare($sql);

			$stmt->execute([ 
				'user_id' => $userId, 
				'public_key' => $publicKey, 
				'private_key' => $privateKey, 
				'expires' => $expires
			]);

		}

	}


	/**
	 * Delete token with 'public-key' from DB
 	 *
	 * @return void
	 */
	public static function deleteToken( $publicKey, $privateKey) {
				
		$db = static::getDB();

		// Delete all records with 'public-key'
		$sql = 'DELETE FROM tokens 
						WHERE public_key = :public_key OR private_key = :private_key';
		$stmt = $db->prepare($sql);
		$stmt->execute([ 
			'public_key' => $publicKey, 
			'private_key' => $privateKey
		]);

	}

} // END class Tokens