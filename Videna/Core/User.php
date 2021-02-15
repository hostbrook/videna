<?php
// Videna Framework
// File: /Videna/Core/User.php
// Desc: Class to work with users

namespace Videna\Core;

use \Videna\Models\Users;
use \Videna\Models\Tokens;

abstract class User {

	private static $PublicKey = null;
	private static $PrivateKey = null;


	/**
	 * Detect user account type and pull user's data if user is registered
	 * @return array with user data
	 */
  public static function detect() {

		// If Database not used - no any users can be registered
		if ( !USE_DB ) return ['account' => USR_UNREG];
		
		// if session ID was received via cookie, user was registered. 
		// In this case - start session:
		if ( isset($_REQUEST[session_name()]) ) {

			session_start();

			if ( isset($_SESSION['user_id']) ) {
				// user has been already  logged-in. return user info array:
				$user = Users::getUser([ 'id' => $_SESSION['user_id'] ]);
				session_write_close();
				return $user;
			}

			session_write_close();
			
		}
		
		// At this point session expired or user wasn't registered
		
		// Try to recovery user login via cookies
		if ( !isset($_COOKIE['public-key']) ) {
			// user wasn't registered yet
			return ['account' => USR_UNREG];
		}

		// At this point 'public-key' exists, that means user was registered
		// but session was expired. We need to check if there is a recod about the user in DB
		// So, first we get 'private-key' - footprint of client:
		
		$userId = Tokens::getUserId($_COOKIE['public-key'], self::getPrivateKey());

		if ( $userId == null ) {
			// no records with token in DB
			return ['account' => USR_UNREG];
		}

		// Token exists, so just pull user info from DB:
		$user = Users::getUser([ 'id' => $userId ]);
		if ( $user == false ) return ['account' => USR_UNREG];

		// Add user info in session
		session_start();
		$_SESSION['user_id'] = $user['id'];
		session_write_close();

		// Return array with user's data
		return $user;

	}


	/**
	 * Log in user into a application
	 * NOTE: Before call this function, user needs to be authenticated and User ID known 
	 * @param $userId is `user_id` in DB table `users`
	 * @return void
	 */
  public static function login($userId) {

		// Add user ID info in session:
		session_start();
		$_SESSION['user_id'] = $userId;
		$_REQUEST[session_name()] = session_id();
		session_write_close();

		// Update public key in DB:
		$expires = 0; // Valid until browser closed
		Tokens::updatePublicKey( self::getPublicKey(true), $userId, self::getPrivateKey(), $expires );

		// Update public key in cookies:
		setcookie('public-key', self::getPublicKey(), $expires, '/', HOST_NAME, (HTP_PROTOCOL == 'https' ? true : false) );

		return self::detect();

	}


	/**
	 * Log-out user from the application
	 * @return void
	 */
  public static function logout() {

		session_start();

		// Delete session cookies
		setcookie(session_name(), '', time() - 3600);
		
		// Destroy session:
		session_unset();      
		session_destroy();
	
		// Delete cookie 'public-key'
		setcookie('public-key', '', time() - 3600);

		if ( isset($_COOKIE['public-key']) ) {
			// Delete token record from DB:
  		Tokens::deleteToken( $_COOKIE['public-key'], self::getPrivateKey() );
	
  		unset($_COOKIE['public-key']);
		}

		return ['account' => USR_UNREG];

	}


	/**
	 * Generates 'private-key': browser footprint
	 * @return string sha1
	 */
	private static function getPrivateKey() {
    if (self::$PrivateKey == null)
      self::$PrivateKey = sha1( $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'] );
    return self::$PrivateKey;
	}
	

	/**
	 * Generates 'public-key' random string
	 * @return string sha1
	 */
	private static function getPublicKey( $generateNew = false ) {
    if ( self::$PublicKey == null or $generateNew )
      self::$PublicKey = sha1( rand().time() );
    return self::$PublicKey;
	}


	/**
	 * Generates 'token' - random string
	 * @return string
	 */
	public static function getToken() {
    return substr( md5(time().rand()), 0, TOKEN_LENGTH);
  }

} // END class User