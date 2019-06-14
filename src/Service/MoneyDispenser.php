<?php

namespace App\Service;

use App\Entity\BankNote\Collection;
use App\Entity\PolishZlotyBankNote;

class MoneyDispenser {

    public function retrieveAmount($amount){

        $bankNoteCollection = new Collection();

        $bankNote = new PolishZlotyBankNote($amount);

        $bankNoteCollection->addBankNote($bankNote);

        return $bankNoteCollection;
    }
}