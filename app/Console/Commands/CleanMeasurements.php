<?php

namespace App\Console\Commands;

use Delta\DeltaService\Measurements\MeasurementRepositoryInterface;
use DateTime;
use Illuminate\Console\Command;

class CleanMeasurements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean-measurements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove measurements that are more than half a year old';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param $measurementRepository
     *
     * @return void
     */
    public function handle(MeasurementRepositoryInterface $measurementRepository)
    {
        $date = new DateTime();
        $date->modify('-6 month');
        $measurementRepository->removeOlderThan($date);
    }
}
