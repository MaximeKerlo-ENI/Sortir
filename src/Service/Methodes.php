<?php

// src/Service/Meethodes.php

namespace App\Service;

use App\Repository\InscriptionsRepository;

class Methodes
{
    public function participe(?int $sortieId, ?int $participantId, InscriptionsRepository $ir): bool
    {   $var = false;
        $inscriptions = $ir->findAll();
        foreach ($inscriptions as $inscription) {
            $nopa = $inscription->getParticipantsNoParticipant()->getNoParticipant();
            $noso = $inscription->getSortiesNoSortie()->getNoSortie();
            if($nopa == $participantId && $noso == $sortieId) {
             $var = true;  
            }  
        }
        return $var;
       
    }

    public function participants(?int $sortieId, InscriptionsRepository $ir): ?int
    {  
        $inscriptions = $ir->findAll();
        $i=0;
        foreach ($inscriptions as $inscription) {

            if( $inscription->getSortiesNoSortie()->getNoSortie() == $sortieId) {
             $i++;
            }

            
            
        }

        return $i;
       
       
    }

}