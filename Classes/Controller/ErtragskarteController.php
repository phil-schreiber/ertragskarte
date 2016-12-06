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
 * ErtragskarteController
 */
class ErtragskarteController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * markersRepository
     * 
     * @var \Df\Ertragskarte\Domain\Repository\MarkersRepository
     * @inject
     */
    protected $markersRepository = NULL;
    
    
    /**
     * action aggregate
     * 
     * @return void
     */
    public function aggregateAction(){         
        $markers = $this->markersRepository->findAll();
        $aggregateMarkers = $this->markersRepository->aggregateMarkers();
        $this->view->assign('markerss', $markers);
        $markerArray=array();
        foreach($markers as $marker){            
            $marker->curUser=0;
            if(!$marker->getUser()){
                $marker->curUser=-1;                
                $markerArray[]= json_encode($marker);                
            }                        
        }    
        
        foreach($aggregateMarkers as $aggregateMarker){
            if($aggregateMarker["ltd"] != ""){
                $aggregateMarker->curUser=0;
                $markerArray[]= json_encode($aggregateMarker);                
            }
        }
                
        if(count($this->request->getArguments()) > 0){
            echo('['.implode(',',$markerArray).']');
            die();
        }      
    }
    
    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {                
        $markers = $this->markersRepository->findAll();
                
        $this->view->assign('markerss', $markers);
        $markerArray=array();
        foreach($markers as $marker){            
            $marker->curUser=0;
            if($marker->getUser() && count($GLOBALS['TSFE']->fe_user->user) >0){
                
                if($marker->getUser()->getUid()===$GLOBALS['TSFE']->fe_user->user["uid"]){
                    $marker->curUser=1;
                }
            }else {                                
                $marker->curUser=-1;                
            }            
            $markerArray[]= json_encode($marker);
        }                
                
        if(count($this->request->getArguments()) > 0){
            echo('['.implode(',',$markerArray).']');
            die();
        }                
    }
    
    

}