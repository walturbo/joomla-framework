<?php
/**
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\Registry\Format;

/**
 * Test class for Xml.
 *
 * @since  1.0
 */
class JRegistryFormatXMLTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test the Cml::objectToString method.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function testObjectToString()
	{
		$class = Format::getInstance('XML');
		$options = null;
		$object = new stdClass;
		$object->foo = 'bar';
		$object->quoted = '"stringwithquotes"';
		$object->booleantrue = true;
		$object->booleanfalse = false;
		$object->numericint = 42;
		$object->numericfloat = 3.1415;
		$object->section = new stdClass;
		$object->section->key = 'value';
		$object->array = array('nestedarray' => array('test1' => 'value1'));

		$string = "<?xml version=\"1.0\"?>\n<registry>" .
			"<node name=\"foo\" type=\"string\">bar</node>" .
			"<node name=\"quoted\" type=\"string\">\"stringwithquotes\"</node>" .
			"<node name=\"booleantrue\" type=\"boolean\">1</node>" .
			"<node name=\"booleanfalse\" type=\"boolean\"></node>" .
			"<node name=\"numericint\" type=\"integer\">42</node>" .
			"<node name=\"numericfloat\" type=\"double\">3.1415</node>" .
			"<node name=\"section\" type=\"object\">" .
			"<node name=\"key\" type=\"string\">value</node>" .
			"</node>" .
			"<node name=\"array\" type=\"array\">" .
			"<node name=\"nestedarray\" type=\"array\">" .
			"<node name=\"test1\" type=\"string\">value1</node>" .
			"</node>" .
			"</node>" .
			"</registry>\n";

		// Test basic object to string.
		$this->assertThat(
			$class->objectToString($object, $options),
			$this->equalTo($string)
		);
	}

	/**
	 * Test the Xml::stringToObject method.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function testStringToObject()
	{
		$class = Format::getInstance('XML');
		$object = new stdClass;
		$object->foo = 'bar';
		$object->booleantrue = true;
		$object->booleanfalse = false;
		$object->numericint = 42;
		$object->numericfloat = 3.1415;
		$object->section = new stdClass;
		$object->section->key = 'value';
		$object->array = array('test1' => 'value1');

		$string = "<?xml version=\"1.0\"?>\n<registry>" .
			"<node name=\"foo\" type=\"string\">bar</node>" .
			"<node name=\"booleantrue\" type=\"boolean\">1</node>" .
			"<node name=\"booleanfalse\" type=\"boolean\"></node>" .
			"<node name=\"numericint\" type=\"integer\">42</node>" .
			"<node name=\"numericfloat\" type=\"double\">3.1415</node>" .
			"<node name=\"section\" type=\"object\">" .
			"<node name=\"key\" type=\"string\">value</node>" .
			"</node>" .
			"<node name=\"array\" type=\"array\">" .
			"<node name=\"test1\" type=\"string\">value1</node>" .
			"</node>" .
			"</registry>\n";

		// Test basic object to string.
		$this->assertThat(
			$class->stringToObject($string),
			$this->equalTo($object)
		);
	}
}
