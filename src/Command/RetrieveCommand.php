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
        $this->addArgument('moneyAmount', InputArgument::OPTIONAL, 'How much to get?', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $requestedAmount = (int) $input->getArgument('moneyAmount');

        $bankNotes = $this->moneyManager->retrieveAmount($requestedAmount);
        if ($bankNotes) {
            echo '[' . join($bankNotes->getIterator(), ', ') . ']' . PHP_EOL;
        } else {
            echo '[ Empty Set ]' . PHP_EOL;
        }
    }
}
