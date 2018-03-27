<?php
/**
 * Data Type of CFPropertyList
 * Note: Binary data is base64-encoded.
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @subpackage plist.types
 * @version $Id$
 */

namespace CFPropertyList;
use \DOMDocument, \Iterator, \ArrayAccess;

class CFData extends CFType {
   /**
    * Create new Data CFType
    * @param string $value data to be contained by new object
    * @param boolean $already_coded if true $value will not be base64-encoded, defaults to false
    */
   public function __construct($value=null,$already_coded=false) {
     if($already_coded) $this->value = $value;
     else $this->setValue($value);
   }

   /**
    * Set the CFType's value and base64-encode it.
    * <b>Note:</b> looks like base64_encode has troubles with UTF-8 encoded strings
    * @return void
    */
   public function setValue($value) {
     //if(function_exists('mb_check_encoding') && mb_check_encoding($value, 'UTF-8')) $value = utf8_decode($value);
     $this->value = base64_encode($value);
   }

   /**
    * Get base64 encoded data
    * @return string The base64 encoded data value
    */
   public function getCodedValue() {
     return $this->value;
   }

   /**
    * Get the base64-decoded CFType's value.
    * @return mixed CFType's value
    */
   public function getValue() {
     return base64_decode($this->value);
   }

   /**
    * Get XML-Node.
    * @param DOMDocument $doc DOMDocument to create DOMNode in
    * @param string $nodeName For compatibility reasons; just ignore it
    * @return DOMNode &lt;data&gt;-Element
    */
   public function toXML(DOMDocument $doc,$nodeName="") {
     return parent::toXML($doc, 'data');
   }

   /**
    * convert value to binary representation
    * @param CFBinaryPropertyList The binary property list object
    * @return The offset in the object table
    */
   public function toBinary(CFBinaryPropertyList &$bplist) {
     return $bplist->dataToBinary($this->getValue());
   }
 }
