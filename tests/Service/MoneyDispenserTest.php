<?php


use App\Service\MoneyDispenser;
use App\Entity\BankNote\Collection;
use App\Entity\PolishZlotyBankNote;
use App\Entity\BankNote\NoteUnavailableException;
use App\Service\MoneyDispenser\InvalidArgumentException;

class MoneyDispenserTest extends \PHPUnit\Framework\TestCase
{

    public function testRetrieveAmount()
    {
        $moneyDispenser = new MoneyDispenser();
        $bankNotes = $moneyDispenser->retrieveAmount(10);
        /* @FIXME: for some reason we get
         * Failed asserting that 'App\Entity\BankNote\Collection' is an instance of class "App\Entity\BankNote\Collection".
         */
        //$this->assertInstanceOf(Collection::class,get_class($bankNotes));
        $this->assertEquals(Collection::class,get_class($bankNotes));
    }

    public function test30Amount()
    {
        $moneyDispenser = new MoneyDispenser();
        $bankNotes = $moneyDispenser->retrieveAmount(30);

        $expectedCollection = new Collection();
        $expectedCollection->addBankNote(new PolishZlotyBankNote(20));
        $expectedCollection->addBankNote(new PolishZlotyBankNote(10));

        $this->assertEquals($expectedCollection, $bankNotes);
    }

    public function test80Amount()
    {
        $moneyDispenser = new MoneyDispenser();
        $bankNotes = $moneyDispenser->retrieveAmount(80);

        $expectedCollection = new Collection();
        $expectedCollection->addBankNote(new PolishZlotyBankNote(50));
        $expectedCollection->addBankNote(new PolishZlotyBankNote(20));
        $expectedCollection->addBankNote(new PolishZlotyBankNote(10));

        $this->assertEquals($expectedCollection, $bankNotes);
    }

    public function test125Amount()
    {
        $this->expectException(NoteUnavailableException::class);

        $moneyDispenser = new MoneyDispenser();
        $bankNotes = $moneyDispenser->retrieveAmount(125);
    }

    public function testMinus130Amount()
    {
        $this->expectException(InvalidArgumentException::class);

        $moneyDispenser = new MoneyDispenser();
        $bankNotes = $moneyDispenser->retrieveAmount(-130);
    }

    public function testStringAmount()
    {
        $this->expectException(InvalidArgumentException::class);

        $moneyDispenser = new MoneyDispenser();
        $bankNotes = $moneyDispenser->retrieveAmount('test');
    }

    public function testNullAmount()
    {
        $moneyDispenser = new MoneyDispenser();
        $bankNotes = $moneyDispenser->retrieveAmount(null);

        $expectedCollection = null;
        $this->assertEquals($expectedCollection,$bankNotes);
    }
}
