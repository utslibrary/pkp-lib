<?php

/**
 * @file tests/classes/validation/ValidatorORCIDTest.inc.php
 *
 * Copyright (c) 2013-2019 Simon Fraser University
 * Copyright (c) 2000-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ValidatorORCIDTest
 * @ingroup tests_classes_validation
 * @see ValidatorORCID
 *
 * @brief Test class for ValidatorORCID.
 */

import('lib.pkp.tests.PKPTestCase');
import('lib.pkp.classes.validation.ValidatorORCID');

class ValidatorORCIDTest extends PKPTestCase {
	/**
	 * @covers ValidatorORCID
	 * @covers ValidatorRegExp
	 * @covers Validator
	 */
	public function testValidatorORCID() {
		$validator = new ValidatorORCID();
		self::assertTrue($validator->isValid('http://orcid.org/0000-0002-1825-0097')); // Valid (http)
		self::assertTrue($validator->isValid('https://orcid.org/0000-0002-1825-0097')); // Valid (https)
		self::assertFalse($validator->isValid('ftp://orcid.org/0000-0002-1825-0097')); // Invalid (FTP scheme)
		self::assertTrue($validator->isValid('http://orcid.org/0000-0002-1694-233X')); // Valid, with an X in the last digit
		self::assertFalse($validator->isValid('0000-0002-1694-233X')); // Missing URI component
		self::assertFalse($validator->isValid('000000021694233X')); // Missing dashes, URI component
	}
}

?>
