<?php
/**
 * CFPropertyList
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @version $Id$
 */
namespace CFPropertyList;
use \DOMDocument, \Iterator, \ArrayAccess;

/**
 * Date Type of CFPropertyList
 * Note: CFDate uses Unix timestamp (epoch) to store dates internally
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @subpackage plist.types
 * @version $Id$
 */
class CFDate extends CFType {
   const TIMESTAMP_APPLE = 0;
   const TIMESTAMP_UNIX  = 1;
   const DATE_DIFF_APPLE_UNIX = 978307200;

   /**
    * Create new Date CFType.
    * @param integer $value timestamp to set
    * @param integer $format format the timestamp is specified in, use {@link TIMESTAMP_APPLE} or {@link TIMESTAMP_UNIX}, defaults to {@link TIMESTAMP_APPLE}
    * @uses setValue() to convert the timestamp
    */
   function __construct($value,$format=CFDate::TIMESTAMP_UNIX) {
     $this->setValue($value,$format);
   }

   /**
    * Set the Date CFType's value.
    * @param integer $value timestamp to set
    * @param integer $format format the timestamp is specified in, use {@link TIMESTAMP_APPLE} or {@link TIMESTAMP_UNIX}, defaults to {@link TIMESTAMP_UNIX}
    * @return void
    * @uses TIMESTAMP_APPLE to determine timestamp type
    * @uses TIMESTAMP_UNIX to determine timestamp type
    * @uses DATE_DIFF_APPLE_UNIX to convert Apple-timestamp to Unix-timestamp
    */
   function setValue($value,$format=CFDate::TIMESTAMP_UNIX) {
     if($format == CFDate::TIMESTAMP_UNIX) $this->value = $value;
     else $this->value = $value + CFDate::DATE_DIFF_APPLE_UNIX;
   }

  /**
   * Get the Date CFType's value.
   * @param integer $format format the timestamp is specified in, use {@link TIMESTAMP_APPLE} or {@link TIMESTAMP_UNIX}, defaults to {@link TIMESTAMP_UNIX}
   * @return integer Unix timestamp
   * @uses TIMESTAMP_APPLE to determine timestamp type
   * @uses TIMESTAMP_UNIX to determine timestamp type
   * @uses DATE_DIFF_APPLE_UNIX to convert Unix-timestamp to Apple-timestamp
   */
  function getValue($format=CFDate::TIMESTAMP_UNIX) {
   if($format == CFDate::TIMESTAMP_UNIX) return $this->value;
   else return $this->value - CFDate::DATE_DIFF_APPLE_UNIX;
 }

 /**
  * Get XML-Node.
  * @param DOMDocument $doc DOMDocument to create DOMNode in
  * @param string $nodeName For compatibility reasons; just ignore it
  * @return DOMNode &lt;date&gt;-Element
  */
 public function toXML(DOMDocument $doc,$nodeName="") {
   $text = $doc->createTextNode(gmdate("Y-m-d\TH:i:s\Z",$this->getValue()));
   $node = $doc->createElement("date");
   $node->appendChild($text);
   return $node;
 }

 /**
  * convert value to binary representation
  * @param CFBinaryPropertyList The binary property list object
  * @return The offset in the object table
  */
 public function toBinary(CFBinaryPropertyList &$bplist) {
   return $bplist->dateToBinary($this->value);
 }

 /**
  * Create a UNIX timestamp from a PList date string
  * @param string $val The date string (e.g. "2009-05-13T20:23:43Z")
  * @return integer The UNIX timestamp
  * @throws PListException when encountering an unknown date string format
  */
 public static function dateValue($val) {
   //2009-05-13T20:23:43Z
   if(!preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})Z/',$val,$matches)) throw new PListException("Unknown date format: $val");
   return gmmktime($matches[4],$matches[5],$matches[6],$matches[2],$matches[3],$matches[1]);
 }
}
