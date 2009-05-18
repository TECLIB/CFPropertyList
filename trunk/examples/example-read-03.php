<?php
/**
 * Examples for how to use CFPropertyList
 * Read a PropertyList without knowing the type
 * @package plist
 * @subpackage plist.examples
 */

// just in case...
error_reporting( E_ALL );
ini_set( 'display_errors', 'on' );

/**
 * Require CFPropertyList
 */
require_once(dirname(__FILE__).'/../CFPropertyList.php');


/*
 * create a new CFPropertyList instance which loads the sample.plist on construct.
 * since we know the format, use the automatic format-detection
 */
$plist = new CFPropertyList( dirname(__FILE__).'/sample.binary.plist' );

/*
 * retrieve the array structure of sample.plist and dump to stdout
 */

echo '<pre>';
var_dump( $plist->toArray() );
echo '</pre>';

$plist->saveBinary( dirname(__FILE__).'/sample.binary.plist' );

?>