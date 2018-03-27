<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors','on');

require_once(__DIR__ . '/../vendor/autoload.php');

define('TEST_UID_XML_PLIST', __DIR__ . '/uid-list.xml');
define('TEST_BINARY_DATA_FILE',__DIR__.'/binary-data.plist');
define('TEST_UID_BPLIST', __DIR__ . '/uid-list.plist');
define('TEST_XML_DATA_FILE',__DIR__.'/xml-data.plist');
define('WRITE_XML_DATA_FILE',__DIR__.'/binary.plist');
define('WRITE_BINARY_DATA_FILE',__DIR__.'/binary.plist');
