<?php
namespace CFPropertyList;
use \DOMDocument, \Iterator, \ArrayAccess;

/**
 * Boolean Type of CFPropertyList
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @subpackage plist.types
 */
class CFBoolean extends CFType {
   /**
    * Get XML-Node.
    * Returns &lt;true&gt; if $value is a true, &lt;false&gt; if $value is false.
    * @param DOMDocument $doc DOMDocument to create DOMNode in
    * @param string $nodeName For compatibility reasons; just ignore it
    * @return DOMNode &lt;true&gt; or &lt;false&gt;-Element
    */
   public function toXML(DOMDocument $doc,$nodeName="") {
     return $doc->createElement($this->value ? 'true' : 'false');
   }

   /**
    * convert value to binary representation
    * @param CFBinaryPropertyList The binary property list object
    * @return The offset in the object table
    */
   public function toBinary(CFBinaryPropertyList &$bplist) {
     return $bplist->boolToBinary($this->value);
   }
 }
