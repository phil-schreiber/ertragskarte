<?php

namespace Df\Ertragskarte\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Philipp Schreiber <philipp.schreiber@denkfabrik-group.com>, denkfabrik
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \Df\Ertragskarte\Domain\Model\Markers.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Philipp Schreiber <philipp.schreiber@denkfabrik-group.com>
 */
class MarkersTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Df\Ertragskarte\Domain\Model\Markers
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Df\Ertragskarte\Domain\Model\Markers();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLngReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getLng()
		);
	}

	/**
	 * @test
	 */
	public function setLngForStringSetsLng()
	{
		$this->subject->setLng('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lng',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLtdReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getLtd()
		);
	}

	/**
	 * @test
	 */
	public function setLtdForStringSetsLtd()
	{
		$this->subject->setLtd('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ltd',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPlaceReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPlace()
		);
	}

	/**
	 * @test
	 */
	public function setPlaceForStringSetsPlace()
	{
		$this->subject->setPlace('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'place',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getZip()
		);
	}

	/**
	 * @test
	 */
	public function setZipForStringSetsZip()
	{
		$this->subject->setZip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStreetReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getStreet()
		);
	}

	/**
	 * @test
	 */
	public function setStreetForStringSetsStreet()
	{
		$this->subject->setStreet('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'street',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNrReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getNr()
		);
	}

	/**
	 * @test
	 */
	public function setNrForStringSetsNr()
	{
		$this->subject->setNr('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'nr',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAcreageReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setAcreageForIntSetsAcreage()
	{	}

	/**
	 * @test
	 */
	public function getYieldReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setYieldForIntSetsYield()
	{	}

	/**
	 * @test
	 */
	public function getUserReturnsInitialValueForFrontendUser()
	{	}

	/**
	 * @test
	 */
	public function setUserForFrontendUserSetsUser()
	{	}
}
