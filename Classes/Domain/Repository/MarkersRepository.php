<?php
namespace Df\Ertragskarte\Domain\Repository;

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
 * The repository for Markers
 */
class MarkersRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function aggregateMarkers(){
        
        $query = $this->createQuery();
        
        $storagePids = $query->getQuerySettings()->getStoragePageIds();
        
        $sql = 'SELECT markers.yield AS yield,markers.acreage AS acreage, markers.title AS markertitle, regions.title, markers.ltd, markers.lng '
                . 'FROM tx_ertragskarte_domain_model_markers AS markers '
                . 'LEFT JOIN tx_ertragskarte_domain_model_regions_zipcodes_mm AS lookup ON markers.zip = lookup.uid_foreign '
                . 'LEFT JOIN tx_ertragskarte_domain_model_regions AS regions on regions.uid=lookup.uid_local '
                . 'WHERE markers.pid IN ('.implode(',',$storagePids).') AND markers.deleted = 0 AND markers.zip <> 0';
        $query->statement($sql);

        $result = $query->execute(true);
        
        return $result;
    }
    
}