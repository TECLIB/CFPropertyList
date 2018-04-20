<?php
/**
 * LICENSE
 *
 * This file is part of CFPropertyList.
 *
 * Copyright (c) 2018 Teclib'
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * ------------------------------------------------------------------------------
 * @author    Christian Kruse <cjk@wwwtech.de>
 * @copyright Copyright © 2018 Teclib
 * @package   plist
 * @license   MIT
 * @link      https://github.com/TECLIB/CFPropertyList/
 * ------------------------------------------------------------------------------
 */

 /**
 * Examples for how to use CFPropertyList
 * Modify a PropertyList
 * @package plist
 * @subpackage plist.examples
 */
namespace CFPropertyList;

// just in case...
error_reporting(E_ALL);
ini_set('display_errors', 'on');

/**
 * Require CFPropertyList
 */
require_once(__DIR__.'/../vendor/autoload.php');


// load an existing list
$plist = new CFPropertyList(__DIR__.'/sample.xml.plist');


foreach ($plist->getValue(true) as $key => $value) {
    if ($key == "City Of Birth") {
        $value->setValue('Mars');
    }

    if ($value instanceof \Iterator) {
        // The value is a CFDictionary or CFArray, you may continue down the tree
    }
}


// save data
$plist->save(__DIR__.'/modified.plist', CFPropertyList::FORMAT_XML);
