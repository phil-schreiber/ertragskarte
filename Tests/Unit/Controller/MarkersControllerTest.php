<?php
namespace Df\Ertragskarte\Tests\Unit\Controller;
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
 * Test case for class Df\Ertragskarte\Controller\MarkersController.
 *
 * @author Philipp Schreiber <philipp.schreiber@denkfabrik-group.com>
 */
class MarkersControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Df\Ertragskarte\Controller\MarkersController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Df\\Ertragskarte\\Controller\\MarkersController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMarkerssFromRepositoryAndAssignsThemToView()
	{

		$allMarkerss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$markersRepository = $this->getMock('Df\\Ertragskarte\\Domain\\Repository\\MarkersRepository', array('findAll'), array(), '', FALSE);
		$markersRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMarkerss));
		$this->inject($this->subject, 'markersRepository', $markersRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('markerss', $allMarkerss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMarkersToView()
	{
		$markers = new \Df\Ertragskarte\Domain\Model\Markers();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('markers', $markers);

		$this->subject->showAction($markers);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenMarkersToMarkersRepository()
	{
		$markers = new \Df\Ertragskarte\Domain\Model\Markers();

		$markersRepository = $this->getMock('Df\\Ertragskarte\\Domain\\Repository\\MarkersRepository', array('add'), array(), '', FALSE);
		$markersRepository->expects($this->once())->method('add')->with($markers);
		$this->inject($this->subject, 'markersRepository', $markersRepository);

		$this->subject->createAction($markers);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenMarkersToView()
	{
		$markers = new \Df\Ertragskarte\Domain\Model\Markers();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('markers', $markers);

		$this->subject->editAction($markers);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenMarkersInMarkersRepository()
	{
		$markers = new \Df\Ertragskarte\Domain\Model\Markers();

		$markersRepository = $this->getMock('Df\\Ertragskarte\\Domain\\Repository\\MarkersRepository', array('update'), array(), '', FALSE);
		$markersRepository->expects($this->once())->method('update')->with($markers);
		$this->inject($this->subject, 'markersRepository', $markersRepository);

		$this->subject->updateAction($markers);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenMarkersFromMarkersRepository()
	{
		$markers = new \Df\Ertragskarte\Domain\Model\Markers();

		$markersRepository = $this->getMock('Df\\Ertragskarte\\Domain\\Repository\\MarkersRepository', array('remove'), array(), '', FALSE);
		$markersRepository->expects($this->once())->method('remove')->with($markers);
		$this->inject($this->subject, 'markersRepository', $markersRepository);

		$this->subject->deleteAction($markers);
	}
}
