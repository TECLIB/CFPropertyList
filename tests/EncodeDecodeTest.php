<?php

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors','on');

if(!defined('LIBDIR')) {
  define('LIBDIR',dirname(__FILE__).'/../');
}

require_once(LIBDIR.'/CFPropertyList.php');

class EncodeDecodeTest extends PHPUnit_Framework_TestCase {
	public static function binaryDecode($data)
	{
		$plist = new \CFPropertyList();
		$plist->parseBinary($data);
		return $plist->toArray();
	}

	public static function binaryEncode($data)
	{
		$plist = new \CFPropertyList();
		$td = new \CFTypeDetector();
		$plist->add($td->toCFType($data));
		return $plist->toBinary();
	}

	public function testsNumericString() {
		$id = 123;
		$name = '123';
		$obj = array('id' => $id, 'name' => $name);

		$plist = self::binaryEncode($obj);
		$decoded = self::binaryDecode($plist);

		$this->assertInternalType('integer', $decoded['id']);
		$this->assertInternalType('string', $decoded['name']);
	}
}