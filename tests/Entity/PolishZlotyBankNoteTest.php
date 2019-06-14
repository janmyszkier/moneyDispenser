<?php

use App\Entity\PolishZlotyBankNote;
use App\Entity\BankNote\NoteUnavailableException;

class PolishZlotyBankNoteTest extends \PHPUnit\Framework\TestCase
{

    public function testGet10PLNNominal()
    {
        $bankNote = new PolishZlotyBankNote(10);
        $this->assertEquals(10,$bankNote->getNominal());
    }

    public function testGet15PLNNominal()
    {
        $this->expectException(NoteUnavailableException::class);
        new PolishZlotyBankNote(15);
    }

    public function testNegativeNominal()
    {
        $this->expectException(NoteUnavailableException::class);
        $bankNote = new PolishZlotyBankNote(-10);
    }

    public function test__toString()
    {
        $bankNote = new PolishZlotyBankNote(10);
        $this->assertEquals('10 PLN',$bankNote);
    }
}
