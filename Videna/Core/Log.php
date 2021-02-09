<?php
// Videna Framework
// File: /Videna/Core/Log.php
// Desc: Add log to file

namespace Videna\Core;

abstract class Log {


  // Put errors and debug info in log file
  public static function add($data = array('Break Point' => 'Stop Script'), $die = FALSE) {

    $fp = fopen(PATH_APP_LOG, "a");

    $logLine = "Date/Time:\t".date("Y-m-d H:i:s")."\r\n";    
    foreach ( $data as $error_name => $error_descr ) $logLine .= $error_name."\t".$error_descr."\r\n";    
    $logLine .= "\r\n";

    $result = fwrite($fp, $logLine);
    fclose($fp);

    if ($die) {

      if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) {
        die( json_encode([ 
          'response' => 500, 
          'status' => $die 
        ]) );
      }
     
      http_response_code(500);
      die( $die );
      
    }
  }


  public static function read($file = PATH_APP_LOG) {

    if ( !is_file($file) ) return false;

    $lines = file($file);

    foreach ($lines as $line_num => $line) {

      if ( !strpos($line, "\t") ) {
        $log[$line_num] = ['&nbsp;',  $line];
      }
      else {
        list($param, $value) = explode("\t", $line);
        $log[$line_num] = [$param, $value];
      }
      
    }

    return $log;

  }


  public static function delete($file = PATH_APP_LOG) {
    
    if ( is_file($file) ) {
      if (unlink($file)) {
        return 'Deleted successfully.';
      }
      else return 'Error occurred during deleting.';
    }

    return 'File not found.';

  }

} // END Class Log