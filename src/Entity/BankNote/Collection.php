<?php

namespace App\Entity\BankNote;

use App\Entity\BankNoteInterface;

class Collection implements \IteratorAggregate
{
    protected $set = [];

    public function addBankNote(BankNoteInterface $bankNote)
    {
        $this->set[] = $bankNote;
    }

    public function getIterator()
    {
        return $this->set;
    }
}
