<?php
/**
 * Examples for how to use CFPropertyList
 * Modify a PropertyList
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


// load an existing list
$plist = new CFPropertyList( dirname(__FILE__).'/sample.xml.plist' );


foreach( $plist->getValue(true) as $key => $value )
{
	if( $key == "City Of Birth" )
	{
		$value->setValue( 'Mars' );
	}
	
	if( $value instanceof Iterator )
	{
		// The value is a CFDictionary or CFArray, you may continue down the tree
	}
}


// save data
$plist->save( dirname(__FILE__).'/modified.plist', CFPropertyList::FORMAT_XML );

?>