<?php

namespace App\Command;

use App\Service\MoneyDispenser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RetrieveCommand extends Command
{

    protected static $defaultName = 'money:retrieve';

    private $moneyManager;

    public function __construct(MoneyDispenser $moneyManager)
    {
        $this->moneyManager = $moneyManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('moneyAmount', InputArgument::REQUIRED, 'How much to get?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo 'Here is your '.$input->getArgument('moneyAmount').PHP_EOL;
        $bankNotes = $this->moneyManager->retrieveAmount($input->getArgument('moneyAmount'));
        echo join($bankNotes->getIterator(),PHP_EOL);

    }
}