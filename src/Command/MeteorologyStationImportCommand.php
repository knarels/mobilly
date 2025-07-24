<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\MeteorologyStationImportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import-meteorology-stations',
    description: 'Fetches meteorology station data from data.gov.lv and saves to DB',
)]
class MeteorologyStationImportCommand extends Command
{
    public function __construct(
        private readonly MeteorologyStationImportService $importer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count = $this->importer->import();
        $output->writeln("<info>Import completed. $count stations processed.</info>");

        return Command::SUCCESS;
    }
}
