<?php
namespace Df\Ertragskarte\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Philipp Schreiber <philipp.schreiber@denkfabrik-group.com>, denkfabrik
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * MarkersController
 */
class MarkersController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * User Repository
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $userRepository = NULL;
    
    /**
     * markersRepository
     * 
     * @var \Df\Ertragskarte\Domain\Repository\MarkersRepository
     * @inject
     */
    protected $markersRepository = NULL;
    
   
    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        if($GLOBALS['TSFE']->loginUser){             
           setcookie("checkVal", true);
        }else{
           setcookie("checkVal", false);
        }
        
    }
    
    /**
     * action show
     * 
     * @param \Df\Ertragskarte\Domain\Model\Markers $markers
     * @return void
     */
    public function showAction(\Df\Ertragskarte\Domain\Model\Markers $markers)
    {
        $this->view->assign('markers', $markers);
    }
    
    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        
        
        
    }
    
    /**
     * action create
     * 
     * @param \Df\Ertragskarte\Domain\Model\Markers $newMarkers
     * @return void
     */
    public function createAction(\Df\Ertragskarte\Domain\Model\Markers $newMarkers)
    {
        
        //if(!$GLOBALS['TSFE']->loginUser){
          //  echo(0);
          //  return;
        //}
        //
        //$userObject = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);        
        //$newMarkers->setUser($userObject);
        
        $this->markersRepository->add($newMarkers);
        $this->sendMail($newMarkers);
        $this->addFlashMessage('Der Marker wurde erzeugt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);        
        
        //$this->redirect('list');
        echo(1);
        
    }
    
    /**
     * action edit
     * 
     * @param \Df\Ertragskarte\Domain\Model\Markers $markers
     * @ignorevalidation $markers
     * @return void
     */
    public function editAction(\Df\Ertragskarte\Domain\Model\Markers $markers)
    {
        if(!$GLOBALS['TSFE']->loginUser){
            return;
        }
        $this->view->assign('markers', $markers);
    }
    
    /**
     * action update
     * 
     * @param \Df\Ertragskarte\Domain\Model\Markers $markers
     * @return void
     */
    public function updateAction(\Df\Ertragskarte\Domain\Model\Markers $markers)
    {
        if(!$GLOBALS['TSFE']->loginUser){
            return;
        }
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        
        $this->markersRepository->update($markers);
        $this->redirect('list');
    }
    
    /**
     * action delete
     * 
     * @param \Df\Ertragskarte\Domain\Model\Markers $markers
     * @return void
     */
    public function deleteAction(\Df\Ertragskarte\Domain\Model\Markers $markers)
    {
        if(!$GLOBALS['TSFE']->loginUser){
            return;
        }
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->markersRepository->remove($markers);
        $this->redirect('list');
    }

    private function sendMail(\Df\Ertragskarte\Domain\Model\Markers $newMarkers){
        $anrede = $newMarkers->getGender() == 'Frau' ? 'Sehr geehrte Frau' : 'Sehr geehrter Herr';
        $message = (new \TYPO3\CMS\Core\Mail\MailMessage())
        ->setSubject('Ihre Teilnahme am Braugersten-Ertragsmesser von ProBiervielfalt.de')
        ->setFrom(array('info@probiervielfalt.de' => 'info@probiervielfalt.de'))
        ->setTo(array($newMarkers->getEmail() => $newMarkers->getFirstname().' '.$newMarkers->getLastname()))
        ->setBody($anrede.' '.$newMarkers->getLastname().',

vielen Dank für Ihre Teilnahme am Braugersten-Ertragsmesser von ProBiervielfalt.de.

Sofern Sie zu den ersten 800 Teilnehmern gehören, werden wir zeitnah Verbindung mit Ihnen aufnehmen und Ihnen die Auswahl der Siegerbiere zukommen lassen.

Mit freundlichen Grüßen
Ihre BayWa AG
');
        $message->send();
        
    }
}