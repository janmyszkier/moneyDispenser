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
        
        $bankNote = new PolishZlotyBankNote($requestedAmount);

        $bankNoteCollection->addBankNote($bankNote);

        return $bankNoteCollection;
    }
}