<?php

/**
 * common methods & properties
 * instantiated by gateway class
 * 
 * skeleton contains some sample data
 *
 * @package     System
 * @author      Vallo Reima
 * @copyright   2013
 * @license     BSD
 */
class Common {

  protected $prop;        /* common properties */
  protected $temp;        /* common temporary data */

  /**
   * set up properties and temporary structures
   * @param void $tmp -- gateway workarea
   */
  public function __construct(&$tmp) {
    $this->prop = new stdClass();   /* create a properties structure */
    $this->temp = new stdClass();   /* init temporary data */
    $tmp = $this->temp;             /* point workarea to temporary data */
  }

  /**
   * get common property value
   * @param array $pth -- property path
   * @return mixed property value
   */ 
  public function _get($pth) {
    $ptr = & $this->prop; /* point to the properties */
    for ($i = 0; $i < count($pth) - 1; $i++) {/* loop to terminal parent */
      if (is_array($ptr) && isset($ptr[$pth[$i]])) {
        $ptr = & $ptr[$pth[$i]];  /* next array element */
      } else if (is_object($ptr) && isset($ptr->$pth[$i])) {
        $ptr = & $ptr->$pth[$i];  /* next object element */
      } else {
        break;
      }
    }
    if (is_array($ptr) && isset($ptr[$pth[$i]])) {
      $val = $ptr[$pth[$i]];     /* get array element value */
    } else if (is_object($ptr) && isset($ptr->$pth[$i])) {
      $val = $ptr->$pth[$i];    /* get object element value */
    } else {
      $val = null;  /* no value */
    }
    return $val;
  }

  /**
   * set common property value
   * @param array $pth -- property path
   * @param mixed $val -- value to set
   * @return mixed property value
   */ 
  public function _set($pth, $val){
    $ptr = & $this->prop;    /* point to the properties */
    for ($i = 0; $i < count($pth) - 1; $i++) {/* loop to terminal parent */
      if (is_array($ptr)) {
        if (!isset($ptr[$pth[$i]])) {
          $ptr[$pth[$i]] = array();  /* set array if node does not exist */
        }
        $ptr = & $ptr[$pth[$i]];
      } else {
        if (!isset($ptr->$pth[$i])) {
          $ptr->$pth[$i] = new stdClass();  /* set object if node does not exist */
        }
        $ptr = & $ptr->$pth[$i];
      }
    }
    if (is_array($ptr)) {
      $ptr[$pth[$i]] = $val;    /* set array element value */
    } else if (is_object($ptr)){
      $ptr->$pth[$i] = $val;    /* set object element value */
    }else {
      $val = null;
    }
    return $val;
  }

  /* sample method */

  public function Startup() {
    $this->prop->msg = new Msg();
  }

}

/* sample class */

class Msg {

  private $txts = array(
      'titl' => 'A gateway approach to organize common data',
      'thnk' => 'Thanks for attention!');

  public function __get($txt) {
    return $this->txts[$txt]; /* value for common method's call */
  }

}

