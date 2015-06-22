<?php

/**
 * gateway to common methods and properties
 * requirements:  PHP 5.3+
 *                common class including:
 *                  common properties setup
 *                  _get/_set methods
 *                  custom methods/properties
 *
 * @package     System
 * @author      Vallo Reima
 * @copyright   2013
 * @license     BSD
 */
class ¤ {

  private static $cmi;                  /* common instance */
  private static $sep;                  /* path separator */
  public static $_;                     /* workarea */

  /**
   * link to common data
   * @param string $cln common class name
   * @param string $sep path separator
   */
  public static function _Init($cln = 'Common', $sep = '.') {
    self::$cmi = new $cln(self::$_);    /* instantiate the common class */
    self::$sep = $sep;                  /* save property path separator */
  }

  /**
   * access a method
   * @param object $func method name
   * @param array $args arguments list
   * @return mixed
   */
  public static function __callStatic($func, $args) {
    return call_user_func_array(array(self::$cmi, $func), $args);
  }

  /**
   * get/set a property value 
   * @param arguments -- 1st - path string
   *                     2nd - value (set only)
   * @return mixed get/set value
   */
  public static function _() {
    $path = trim(func_get_arg(0), self::$sep);  /* remove leading/trailing separators */
    $pth = explode(self::$sep, $path);          /* split the path */
    if (func_num_args() > 1) {
      $value = func_get_arg(1);                 /* value to set */
      self::$cmi->_set($pth, $value);    /* set a value */
    } else {
      $value = self::$cmi->_get($pth);   /* get a value */
    }
    return $value;
  }

}
