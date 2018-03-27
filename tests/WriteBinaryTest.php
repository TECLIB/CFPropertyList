<?php

namespace CFPropertyList;

class WriteBinaryTest extends \PHPUnit\Framework\TestCase {
  public function testWriteFile() {
    $plist = new CFPropertyList();
    $dict = new CFDictionary();

    $names = new CFDictionary();
    $names->add('given-name',new CFString('John'));
    $names->add('surname',new CFString('Dow'));

    $dict->add('names',$names);

    $pets = new CFArray();
    $pets->add(new CFString('Jonny'));
    $pets->add(new CFString('Bello'));
    $dict->add('pets',$pets);

    $dict->add('age',new CFNumber(28));
    $dict->add('birth-date',new CFDate(412035803));

    $plist->add($dict);
    $plist->saveBinary(WRITE_BINARY_DATA_FILE);

    $this->assertTrue(is_file(WRITE_BINARY_DATA_FILE));
    $this->assertTrue(filesize(WRITE_BINARY_DATA_FILE) > 32);

    $plist->load(WRITE_BINARY_DATA_FILE);

    unlink(WRITE_BINARY_DATA_FILE);
  }

  public function testWriteString() {
    $plist = new CFPropertyList();
    $dict = new CFDictionary();

    $names = new CFDictionary();
    $names->add('given-name',new CFString('John'));
    $names->add('surname',new CFString('Dow'));

    $dict->add('names',$names);

    $pets = new CFArray();
    $pets->add(new CFString('Jonny'));
    $pets->add(new CFString('Bello'));
    $dict->add('pets',$pets);

    $dict->add('age',new CFNumber(28));
    $dict->add('birth-date',new CFDate(412035803));

    $plist->add($dict);
    $content = $plist->toBinary();

    $this->assertTrue(strlen($content) > 32);

    $plist->parse($content);
  }

  public function testWriteUid() {
    $plist = new CFPropertyList();
    $dict = new CFDictionary();
    $dict->add('test', new CFUid(1));
    $plist->add($dict);

    $plist1 = new CFPropertyList(TEST_UID_BPLIST);
    $this->assertEquals($plist1->toBinary(), $plist->toBinary());
  }
}


# eof
