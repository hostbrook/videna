<?php
// Videna Framework
// File: /Videna/Core/App.php
// Desc: Add debugging info to files in the dir \log\

namespace Videna\Core;

abstract class Log {

  //use Singleton;


  // Put errors and debug info in log file
  public static function add($data = array('Break Point' => 'Stop Script'), $die = FALSE) {
    
    $fp = fopen(PATH_APP_LOG, "a");

    $logLine = date("Y-m-d H:i:s")."\r\n";    
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
  
  
  public static function delete() {
    
    $out = '<p>';
    
    if ( is_file(PATH_APP_LOG) ) {
      if (unlink(PATH_APP_LOG)) {
         $out .= '<span style="color: ' . COLOR_SUCCESS . '">|</span> APP debug file has been deleted successfully.<br>';
      }
      else $out .= '<span style="color: ' . COLOR_DANGER . '">|</span> Error occurred during deleting of APP debug file.<br>';
    }
    else $out .= '<span style="color: ' . COLOR_PRIMARY . '">|</span> APP debug file not found.<br>';
    
    if ( is_file(PATH_PHP_LOG) ) {
      if (unlink(PATH_PHP_LOG)) {
        $out .= '<span style="color: ' . COLOR_SUCCESS . '">|</span> PHP Error file has been deleted successfully.<br>';
      } 
      else $out .= '<span style="color: ' . COLOR_DANGER . '">|</span> Error occurred during deleting of PHP Error file.<br>';
    }
    else $out .= '<span style="color: ' . COLOR_PRIMARY . '">|</span> PHP Error file not found.<br>';
    
    if ( is_file(PATH_SRV_LOG) ) {
      if (unlink(PATH_SRV_LOG)) {
        $out .= '<span style="color: ' . COLOR_SUCCESS . '">|</span> Server\'s Error file has been deleted successfully.<br>';
      } 
      else $out .= '<span style="color: ' . COLOR_DANGER . '">|</span> Error occurred during deleting of Server\'s Error file.<br>';
    }
    else $out .= '<span style="color: ' . COLOR_PRIMARY . '">|</span> Server\'s Error file not found.<br>';
    
    return '</p>'.$out;

  }
  
  
  public static function read() {
    
    $out = '<p>';

    if ( is_file(PATH_APP_LOG) ) {

      $handle = fopen(PATH_APP_LOG, 'r');
      
      $er_count = 0;

      $out .= '<span style="color: ' . COLOR_DANGER . '">|</span> APP debug file has been found:</p>
      <table><th>Parameter</th><th>Value</th></tr>';
      
      while (($buffer = fgets($handle, 4096)) !== false) {
        
        if (strlen($buffer) < 3) {
          $out .= "<tr><td colspan=2>&nbsp;</td></tr>";
        } 
        elseif ( !strpos($buffer, "\t") ) {
          $out .= "<tr><td><span style='color: " . COLOR_PRIMARY . "'>Date:</span></td><td><span style='color: " . COLOR_PRIMARY . "'>$buffer</span></td></tr>";
          $er_count++;
        }
        else {
          list($param, $value) = explode("\t", $buffer);
					if ( strpos(strtolower($param), 'warning') !== false ) {
						$out .= "<tr><td><span style='color: " . COLOR_WARNING . "'>$param</span></td><td>$value</td></tr>";
					} 
					elseif ( strpos(strtolower($param), 'danger') !== false or strpos(strtolower($param), 'error') !== false ) {
						$out .= "<tr><td><span style='color: " . COLOR_DANGER . "'>$param</span></td><td>$value</td></tr>";
					}
					elseif ( strpos(strtolower($param), 'success') !== false ) {
						$out .= "<tr><td><span style='color: " . COLOR_SUCCESS . "'>$param</span></td><td>$value</td></tr>";
					}
					else $out .= "<tr><td>$param</td><td>$value</td></tr>";
        }
        
      }
      
      $out .= '</table>';
      
      $out .= "<p><span style='color: " . COLOR_WARNING . "'>|</span> Total records: $er_count</p>";
      
      fclose($handle);
    }
    else $out .= "<span style='color: " . COLOR_PRIMARY . "'>|</span> APP debug file not found.<br>";
    
    
    if ( is_file(PATH_PHP_LOG) ) {
      
      $handle = fopen(PATH_PHP_LOG, 'r');

      $out .= '<span style="color: ' . COLOR_DANGER . '">|</span> PHP Error file has been found:</p><p>';
      
      while (($buffer = fgets($handle, 4096)) !== false) {
        $out .=  $buffer.'</br>';
      }
      
      $out .= '<br>';
      
      fclose($handle);
    }
    else $out .= "<span style='color: " . COLOR_PRIMARY . "'>|</span> PHP Error file not found.<br>";
    
    if ( is_file(PATH_SRV_LOG) ) {
      
      $handle = fopen(PATH_SRV_LOG, 'r');

      $out .= '<span style="color: ' . COLOR_DANGER . '">|</span> Server Error file has been found:</p><p>';
      
      while (($buffer = fgets($handle, 4096)) !== false) {
        if ($buffer[0]!='#') $out .=  $buffer.'</br>';
      }
      
      $out .= '</p>';
      
      fclose($handle);
    }
    else $out .= "<span style='color: " . COLOR_PRIMARY . "'>|</span> Server Error file not found.</p>";
    

    return $out;

  }


} // END Class Log