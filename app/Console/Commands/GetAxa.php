<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Parsers\Axa;

class GetAxa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-axa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get Axa Cars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $axa = (new Axa())->save();
        $this->output->write('Get Axa Command Complete', true);

    }
}
