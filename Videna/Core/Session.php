<?php
// Videna Framework
// File: /Videna/Core/Session.php
// Desc: PHP Sessions class

/**
 * Source: https://habr.com/ru/post/182352/
 * Source: https://habr.com/ru/post/437972/
 */

namespace Videna\Core;

abstract class Session {

  public static function start($isUserActivity=true) {

    // If session already started - stop executing and return TRUE
    if ( session_id() ) return true;
    
    // Creating session name.
    // Needs to be called before session_start() 
    session_name('VIDENA');
    
    // In case of session start error - return FALSE
    if ( !session_start() ) return false;
    
	  $hua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	
    if ( isset($_SESSION['USER_AGENT']) and $_SESSION['USER_AGENT'] != sha1($hua . $_SERVER['REMOTE_ADDR']) ) {
      self::destroy();
      return false;
    }

    $current_time = time();
    
    if (defined('SESSION_LIFE_TIME')) {
      $session_life_time = SESSION_LIFE_TIME;
    } else $session_life_time = 300; // 5 min (default)

    if (defined('SESSION_ID_LIFE_TIME')) {
      $session_id_life_time = SESSION_ID_LIFE_TIME;
    } else $session_id_life_time = 60; // 1 min (default)

    
    if ( $session_life_time ) {
      if ( isset($_SESSION['SESSION_START_TIME']) && $current_time-$_SESSION['SESSION_START_TIME'] >= $session_life_time ) {
        self::destroy();
        return false;
      }
      else {
        if ( $isUserActivity ) $_SESSION['SESSION_START_TIME'] = $current_time;
        $_SESSION['USER_AGENT'] = sha1($hua . $_SERVER['REMOTE_ADDR']);
      }
    }

    if ( $session_id_life_time ) {
      if ( isset($_SESSION['SESSION_ID_START_TIME']) ) {
        if ( $current_time-$_SESSION['SESSION_ID_START_TIME'] >= $session_id_life_time ) {
          self::regenerate_id(true);
          $_SESSION['SESSION_ID_START_TIME'] = $current_time;
        }
      }
      else {
        $_SESSION['SESSION_ID_START_TIME'] = $current_time;
      }
    }

    return true;

  } // END start()
  

  public static function destroy() {

    // Destroy session if the active session exists only
    if ( session_id() ) {
      // Delete session cookies
      setcookie(session_name(), session_id(), time()-60*60*24);
      // destroy session:
      session_unset();      
      session_destroy();
    }
    
  } // END destroy()
  
  
  private function regenerate_id($flag=false) {
    
    // $flag - Определяет, удалять ли старый связанный файл с сессией или нет.

    // Идентификатор сессии должен генерироваться заново при:
    //  - Входе пользователя в систему
    //  - Выходе пользователя из системы
    //  - По прошествии определённого периода времени
    
    session_regenerate_id($flag);
    
  } // END regenerate_id()
  
  
  public static function get($name) {
    if (isset($_SESSION[$name])) return $_SESSION[$name];
    return null;
  }
  
  
  public static function set($fields) {
    foreach ($fields as $key => $value) $_SESSION[$key] = $value;
  }
  
  
} // END class Session