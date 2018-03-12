<?php

namespace App\Console\Commands;

use App\Checker;
use App\Jobs\ChecksumWebsite;
use Illuminate\Console\Command;

class CheckerBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checker:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs all checkers.';

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
     * @return mixed
     */
    public function handle()
    {
        $checkers = Checker::all();

        $bar = $this->output->createProgressBar(count($checkers));

        foreach ($checkers as $checker) {
            (new ChecksumWebsite($checker))->handle();

            $bar->advance();
        }

        $bar->finish();
    }
}
