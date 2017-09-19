<?php
/**
 * Examples for how to use CFPropertyList with xmlStream
 * Read from a PropertyList with array
 * 
 * @package plist
 * @subpackage plist.examples
 */
namespace CFPropertyList;
use \XMLReader;

// just in case...
error_reporting( E_ALL );
ini_set( 'display_errors', 'on' );

/**
 * Require CFPropertyList
 */
require_once(__DIR__.'/../classes/CFPropertyList/CFPropertyList.php');


/*
 * create a new CFPropertyList instance which loads the sample.plist on construct.
 * We don't know that it is a binary plist, so we simply call ->parse()
 */

$reader=new XMLReader();
$reader->open(__DIR__.'/sample.xml.array.plist');

while($reader->read()){
	if($reader->depth==3 && $reader->nodeType==XMLReader::TEXT && $reader->value=='large_array'){
        // array found!
		break;
	}
}

while($reader->read()){
    if($reader->depth==3 && $reader->nodeType==XMLReader::ELEMENT && $reader->name=='dict'){
        $stream = fopen('php://memory','r+');
        // wrap it to mimic to be a plist xml doc
        $foo='<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.'<plist version="1.0">'.PHP_EOL.$reader->readOuterXml().PHP_EOL.'</plist>';
        fwrite($stream,$foo );
        rewind($stream);
        $plist=new CFPropertyList();
        $plist->loadXMLStream($stream);
        fclose($stream);
        echo '<pre>';
        var_dump( $plist->toArray() );
        echo '</pre>';        
        // first dict found! exit!
        break;
    }
}


//read remaining <dict> node until the end
while($reader->next('dict')){
    if($reader->depth==3 && $reader->nodeType==XMLReader::ELEMENT && $reader->name=='dict'){
        $stream = fopen('php://memory','r+');
        // wrap it to mimic to be a plist xml doc
        $foo='<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.'<plist version="1.0">'.PHP_EOL.$reader->readOuterXml().PHP_EOL.'</plist>';
        fwrite($stream,$foo );
        rewind($stream);
        $plist=new CFPropertyList();
        $plist->loadXMLStream($stream);
        fclose($stream);
        echo '<pre>';
        var_dump( $plist->toArray() );
        echo '</pre>';        
    }
    
}


?>