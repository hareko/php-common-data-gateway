<?php

/* demonstrating of common gateway */

include 'gateway.php';
include 'common.php';

define('BR', '<br />');

/* test data */
$ctt = (object) array('phn' => '444555666', 'eml' => 'info@mail.com',
            'adr' => (object) array('str' => 'Elm', 'twn' => 'Sunshine'));

¤::_Init();       /* instantiate common */
¤::Startup();     /* call a common method */

¤::_('ctt', $ctt); /* set a structured value */
¤::_('ctt.chd', array('Sally', 'Billy'));  /* set an array value */
¤::$_->bye = 'thnk'; /* save a value in workarea */

echo ¤::_('msg')->titl . BR; /* get a common object's property value */
echo 'Phone: ' . ¤::_('ctt.phn') . BR;  /* get a value */
¤::_('ctt.adr.str', 'Oak'); /* replace a value */
echo 'Street: ' . ¤::_('ctt.adr.str') . BR;  /* get a value */
echo 'Town: ' . ¤::_('ctt.adr.twn') . BR;  /* get a value */
if (version_compare(PHP_VERSION, '5.4', '<')) {
  $a = ¤::_('ctt.chd'); /* get a value */
  echo 'Child1: ' . $a[0] . BR;
} else {
  echo 'Child1: ' . ¤::_('ctt.chd')[0] . BR;  /* array dereferencing */
}

Bye();

function Bye() { /* access common data from local scope */
  $c = ¤::$_->bye;    /* retrieve a value from workarea */
  $m = ¤::_('msg')->$c; /* get a value of common object's property */
  exit($m);
}

?>
