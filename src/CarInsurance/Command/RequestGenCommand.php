<?php

namespace App\CarInsurance\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use App\CarInsurance\Service\GenerateRequestService;

class RequestGenCommand extends Command
{
    protected static $defaultName = 'app:check24-car';
    protected GenerateRequestService $requestService;

    protected function configure(): void
    {
        $this->setDescription('Read Json input & generate foo XML request')
            ->setHelp('some description..')
            ->addArgument('filename', InputArgument::REQUIRED, 'Car insurance file set of input parameters');
    }

    public function __construct(GenerateRequestService $requestService)
    {
        $this->requestService = $requestService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->showBanner($output);
        $output->writeln('filename: ' . $input->getArgument('filename'));

        $param1 = $input->getArgument('filename');

        $this->requestService->setConfiguration($param1);
        $data = $this->requestService->getMappedValues();
        $output = $this->requestService->generateRequest($data);

        print_r($output);

        return Command::SUCCESS;
    }




    public function showBanner(OutputInterface $output)
    {
        $output->writeln(["
      ____ _                _    ____  _  _             
     / ___| |__    ___  ___| | _|___ \| || |   ___  ___ 
     | |   | '_ \ / _ \/ __| |/ / __) | || |_ / _ \/ __|
     | |___| | | |  __/ (__|   < / __/|__   _|  __/\__ \
      \____|_| |_|\___|\___|_|\_\_____|  |_|(_)___||___/"]);
    }
}
