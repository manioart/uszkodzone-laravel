<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Parsers\Allianz;

class GetAllianz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-allianz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get Allianz Cars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $allianz = (new Allianz())->save();
        $this->output->write('Get Allianz Command Complete', true);

    }
}
