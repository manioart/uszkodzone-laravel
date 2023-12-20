<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Parsers\Rest;

class GetRest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-rest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get Rest Cars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rest = (new Rest())->save();
        $this->output->write('Get Rest Command Complete', true);

    }
}
