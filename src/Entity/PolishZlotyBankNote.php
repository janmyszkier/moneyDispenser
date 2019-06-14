<?php

namespace App\Entity;

class PolishZlotyBankNote implements BankNoteInterface
{
    public const NOMINALS = [10,20,50,100,200,500];

    protected $currency = 'PLN';
    private $nominal=null;

    public function __construct(int $nominal)
    {
        $this->nominal = $nominal;
        return $this;
    }

    public function getNominal(){
        return $this->nominal;
    }

    public function __toString()
    {
        return $this->nominal.' '.$this->currency;
    }
}