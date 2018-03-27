<?php
 /**
  * CFTypeDetector
  * Interface for converting native PHP data structures to CFPropertyList objects.
  * @author Rodney Rehm <rodney.rehm@medialize.de>
  * @author Christian Kruse <cjk@wwwtech.de>
  * @package plist
  * @subpackage plist.types
  * @example example-create-02.php Using {@link CFTypeDetector}
  * @example example-create-03.php Using {@link CFTypeDetector} with {@link CFDate} and {@link CFData}
  * @example example-create-04.php Using and extended {@link CFTypeDetector}
  */

namespace CFPropertyList;
use \DOMDocument, \Iterator, \ArrayAccess;

/**
 * Data-Types for CFPropertyList as defined by Apple.
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @subpackage plist.types
 * @version $Id$
 */
class CFUid extends CFType {
  public
  function toXML(DOMDocument $doc,$nodeName="") {
    $obj = new CFDictionary(array('CF$UID' => new CFNumber($this->value)));
    return $obj->toXml($doc);
  }

  public
  function toBinary(CFBinaryPropertyList &$bplist) {
    return $bplist->uidToBinary($this->value);
  }
}
