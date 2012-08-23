<?php

namespace CFPropertyList;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'on');

if (!defined('LIBDIR')) {
    define('LIBDIR', __DIR__ . '/../classes/CFPropertyList');
}

require_once(LIBDIR . '/CFPropertyList.php');

class EmptyElementsTest extends \PHPUnit_Framework_TestCase {
    public function testWriteFile() {
        $expected = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple Computer//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0"><dict><key>string</key><string/><key>number</key><integer>0</integer><key>double</key><real>0</real></dict></plist>
';

        $plist = new CFPropertyList();
        $dict = new CFDictionary();

        $dict->add('string', new CFString(''));
        $dict->add('number', new CFNumber(0));
        $dict->add('double', new CFNumber(0.0));

        $plist->add($dict);
        $this->assertEquals($expected, $plist->toXML());
    }
}
