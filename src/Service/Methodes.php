<?php

// src/Service/Meethodes.php

namespace App\Service;

use App\Repository\InscriptionsRepository;

class Methodes
{
    public function participe(?int $sortieId, ?int $participantId, InscriptionsRepository $ir): bool
    {  
        $inscriptions = $ir->findAll();
        foreach ($inscriptions as $inscription) {
            if( $inscription->getParticipantsNoParticipant()->getNoParticipant() == $participantId && $inscription->getSortiesNoSortie() == $sortieId) {
                return true;
            } else {
                return false;
            }
            
        }

        return false;
       
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