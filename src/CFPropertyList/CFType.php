<?php
/**
 * String Type for CFPropertyList as defined by Apple.
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
 *Base-Class of all CFTypes used by CFPropertyList.
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @subpackage plist.types
 * @version $Id$
 * @example example-create-01.php Using the CFPropertyList API
 * @example example-create-02.php Using CFPropertyList::guess()
 * @example example-create-03.php Using CFPropertyList::guess() with {@link CFDate} and {@link CFData}
 */
abstract class CFType {
  /**
   * CFType nodes
   * @var array
   */
  protected $value = null;

  /**
   * Create new CFType.
   * @param mixed $value Value of CFType
   */
  public function __construct($value=null) {
    $this->setValue($value);
  }

  /************************************************************************************************
   *    M A G I C   P R O P E R T I E S
   ************************************************************************************************/

  /**
   * Get the CFType's value
   * @return mixed CFType's value
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Set the CFType's value
   * @return void
   */
  public function setValue($value) {
    $this->value = $value;
  }

  /************************************************************************************************
   *    S E R I A L I Z I N G
   ************************************************************************************************/

  /**
   * Get XML-Node.
   * @param DOMDocument $doc DOMDocument to create DOMNode in
   * @param string $nodeName Name of element to create
   * @return DOMNode Node created based on CType
   * @uses $value as nodeValue
   */
  public function toXML(DOMDocument $doc, $nodeName="") {
    $node = $doc->createElement($nodeName);
    $text = $doc->createTextNode($this->value);
    $node->appendChild($text);
    return $node;
  }

  /**
   * convert value to binary representation
   * @param CFBinaryPropertyList The binary property list object
   * @return The offset in the object table
   */
  public abstract function toBinary(CFBinaryPropertyList &$bplist);

  /**
   * Get CFType's value.
   * @return mixed primitive value
   * @uses $value for retrieving primitive of CFType
   */
  public function toArray() {
    return $this->getValue();
  }

}

# eof
