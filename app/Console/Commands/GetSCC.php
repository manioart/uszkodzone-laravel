<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Parsers\SCC;

class GetSCC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-scc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get SCC Cars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scc = (new SCC())->save();
        $this->output->write('Get SCC Command Complete', true);

    }
}
