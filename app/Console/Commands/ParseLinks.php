<?php

namespace App\Console\Commands;

use App\Parser\Imdb;
use Illuminate\Console\Command;

class ParseLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:links {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add imdb category url to parse';

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
     * @return int
     */
    public function handle()
    {
        $url = $this->argument('url');

        $imdb = new Imdb();
        $imdb->getLinks($url);

        $this->info('All Movies Are Parsed');
        return true;
    }
}
