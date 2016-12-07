<?php
namespace Df\Ertragskarte\Domain\Model;

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
 * Markers
 */
class Markers extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements \JsonSerializable
{

    /**
     * cruser_id
     * 
     * @var int
     */
    protected $cruser_id = 0;
    
    /**
     * title
     * 
     * @var string
     */
    protected $title = '';
    
    /**
     * lng
     * 
     * @var string
     */
    protected $lng = '';
    
    /**
     * ltd
     * 
     * @var string
     */
    protected $ltd = '';
    
    /**
     * place
     * 
     * @var string
     */
    protected $place = '';
    
    /**
     * zip
     * 
     * @var string
     */
    protected $zip = '';
    
    /**
     * street
     * 
     * @var string
     */
    protected $street = '';
    
    /**
     * nr
     * 
     * @var string
     */
    protected $nr = '';
    
    /**
     * acreage
     * 
     * @var int
     */
    protected $acreage = 0;
    
    /**
     * yield
     * 
     * @var int
     */
    protected $yield = 0;
    
    /**
     * user
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $user = null;
    
    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the lng
     * 
     * @return string $lng
     */
    public function getLng()
    {
        return $this->lng;
    }
    
    /**
     * Sets the lng
     * 
     * @param string $lng
     * @return void
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }
    
    /**
     * Returns the ltd
     * 
     * @return string $ltd
     */
    public function getLtd()
    {
        return $this->ltd;
    }
    
    /**
     * Sets the ltd
     * 
     * @param string $ltd
     * @return void
     */
    public function setLtd($ltd)
    {
        $this->ltd = $ltd;
    }
    
    /**
     * Returns the place
     * 
     * @return string $place
     */
    public function getPlace()
    {
        return $this->place;
    }
    
    /**
     * Sets the place
     * 
     * @param string $place
     * @return void
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }
    
    /**
     * Returns the zip
     * 
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }
    
    /**
     * Sets the zip
     * 
     * @param string $zip
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }
    
    /**
     * Returns the street
     * 
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }
    
    /**
     * Sets the street
     * 
     * @param string $street
     * @return void
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }
    
    /**
     * Returns the nr
     * 
     * @return string $nr
     */
    public function getNr()
    {
        return $this->nr;
    }
    
    /**
     * Sets the nr
     * 
     * @param string $nr
     * @return void
     */
    public function setNr($nr)
    {
        $this->nr = $nr;
    }
    
    /**
     * Returns the acreage
     * 
     * @return int $acreage
     */
    public function getAcreage()
    {
        return $this->acreage;
    }
    
    /**
     * Sets the acreage
     * 
     * @param int $acreage
     * @return void
     */
    public function setAcreage($acreage)
    {
        $this->acreage = $acreage;
    }
    
    /**
     * Returns the yield
     * 
     * @return int $yield
     */
    public function getYield()
    {
        return $this->yield;
    }
    
    /**
     * Sets the yield
     * 
     * @param int $yield
     * @return void
     */
    public function setYield($yield)
    {
        $this->yield = $yield;
    }
    
    /**
     * Sets the cruser_id
     * 
     * @param int $cruser_id
     * @return void
     */
    public function setCruser_id($cruser_id){
        $this->cruser_id = $cruser_id;
    }
    
    /**
     * Get the cruser_id
     * 
     * @retun int
     */
    
    public function getCruser_id(){
        return $this->cruser_id;
    }
    
    /**
     * Returns the user
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Sets the user
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
     * @return void
     */
    public function setUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user)
    {
        $this->user = $user;
    }
    
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public function jsonSerialize() {
        $json = array();
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }
        return $json; 
    }
    
    
}