<?php
/**
 * Removes white space from a string and escapes it
based on the special characters of the currently active database connection.
 * @param mysqli $db Takes the current database connection.
 * @param string $str The string to have its whitespace removed and escaped.
 * @return string
 *  */
 function safe($db, $str) {
    $str = trim($str);
    $str = mysqli_real_escape_string($db, $str);
    return $str;
 }

 
 /**
 * Escapes special GET characters, allowing for safe usage in a URL.
 * @param string $str The string to be escaped. It will be returned with GET special characters escaped.
 * @return string
 *  */
 function escape_url($str) {
   $str = str_replace('=', '$1', $str);
   $str = str_replace('?', '$2', $str);
   $str = str_replace('&', '$3', $str);
   return $str;
 }


/**
 * Restores special GET characters that are escaped using escape_url()
 * @param string $str The string to be restored
 * @return string
 *  */
 function unescape_url($str) {
   $str = str_replace('$1', '=', $str);
   $str = str_replace('$2', '?', $str);
   $str = str_replace('$3', '&', $str);
   return $str;
 }
?>