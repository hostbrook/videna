<?php
// Videna Framework
// File: /Videna/Core/App.php
// Desc: Application core class

namespace Videna\Core;

/**
 * Error and exception handler
 */
class Error {

    /**
     * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param int $level  Error level
     * @param string $message  Error message
     * @param string $file  Filename the error was raised in
     * @param int $line  Line number in the file
     *
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line) {
        if (error_reporting() !== 0) {  // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler.
     *
     * @param Exception $exception  The exception
     *
     * @return void
     */
    public static function exceptionHandler($exception) {

        $file = str_replace(PATH_ROOT, "", $exception->getFile());

        Log::add([
            'Uncaught exception:' => $exception->getCode(),
            'Description:' => trim($exception->getMessage()), 
            'Thrown in File:' => $file .', Line:'. $exception->getLine(),
            "Stack trace:" => $exception->getTraceAsString()
        ], 'FATAL Error: '. $exception->getMessage());
  
    }

} // END class Error