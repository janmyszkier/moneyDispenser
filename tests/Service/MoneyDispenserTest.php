<?php


use App\Service\MoneyDispenser;
use App\Entity\BankNote\Collection;

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
}
