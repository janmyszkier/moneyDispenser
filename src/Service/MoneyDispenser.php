<?php

namespace App\Service;

use App\Entity\BankNote\Collection;
use App\Entity\PolishZlotyBankNote;

class MoneyDispenser {

    public function retrieveAmount($requestedAmount) : ?Collection
    {
        if(!$requestedAmount){
            return null;
        }

        $bankNoteCollection = new Collection();

        $leftToRetrieve = $requestedAmount;
        while($leftToRetrieve > 0) {

            $selectedBankNote = $this->selectBiggestSupportedNominal($leftToRetrieve);
            $bankNote = new PolishZlotyBankNote($selectedBankNote);
            $bankNoteCollection->addBankNote($bankNote);

            $leftToRetrieve -= $selectedBankNote;
        }

        return $bankNoteCollection;
    }

    private function selectBiggestSupportedNominal($requestedAmount){

        $possibleToPickFrom = array_filter(PolishZlotyBankNote::NOMINALS,function($nominal) use ($requestedAmount){
            return ($nominal <= $requestedAmount) ? true : false;
        });

        /*Make sure the biggest is first */
        rsort($possibleToPickFrom);

        return reset($possibleToPickFrom);
    }
}