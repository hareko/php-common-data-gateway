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

  public function __construct(&$tmp)
  /*
   * set up properties and temporary structures
   * in:  tmp -- gateway workarea
   */ {
    $this->prop = new stdClass();   /* create a properties structure */
    $this->temp = new stdClass();   /* init temporary data */
    $tmp = $this->temp;             /* point workarea to temporary data */
  }

  public function GetProperty($pth)
  /*
   * get common property value
   * in:  pth -- property path array
   * out: property's value
   */ {
    $ptr = & $this->prop;
    for ($i = 0; $i < count($pth) - 1; $i++) {/* move to terminal's parent */
      if (isset($ptr->$pth[$i])) {
        $ptr = & $ptr->$pth[$i];  /* get next node */
      } else {
        return null; /* undefined node */
      }
    }
// return isset($ptr->$pth[$i]) ? $ptr->$pth[$i] : null;     /* get a value - needs __isset() */
   return $ptr->$pth[$i];     /* get a value */
  }

  public function SetProperty($pth, $val)
  /*
   * set common property value
   * in:  pth -- property path array
   *      val -- value to set
   */ {
    $ptr = & $this->prop;    /* point to properties structure */
    for ($i = 0; $i < count($pth) - 1; $i++) {/* move to terminal's parent */
      if (!isset($ptr->$pth[$i])) {
        $ptr->$pth[$i] = new stdClass();  /* set default if node does not exist */
      }
      $ptr = & $ptr->$pth[$i]; /* get next node */
    }
    $ptr->$pth[$i] = $val;     /* set a value */
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

?>
