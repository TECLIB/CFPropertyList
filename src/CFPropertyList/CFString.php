<?php
/**
 * Number Type  of CFPropertyList
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @subpackage plist.types
 * @version $Id$
 */

namespace CFPropertyList;
use \DOMDocument, \Iterator, \ArrayAccess;

/**
 * String Type for CFPropertyList as defined by Apple.
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @subpackage plist.types
 * @version $Id$
 */
class CFString extends CFType {
  /**
   * Get XML-Node.
   * @param DOMDocument $doc DOMDocument to create DOMNode in
   * @param string $nodeName For compatibility reasons; just ignore it
   * @return DOMNode &lt;string&gt;-Element
   */
  public function toXML(DOMDocument $doc,$nodeName="") {
    return parent::toXML($doc, 'string');
  }

  /**
   * convert value to binary representation
   * @param CFBinaryPropertyList The binary property list object
   * @return The offset in the object table
   */
  public function toBinary(CFBinaryPropertyList &$bplist) {
    return $bplist->stringToBinary($this->value);
  }
}
