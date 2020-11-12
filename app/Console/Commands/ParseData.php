<?php

namespace App\Console\Commands;

use App\Parser\Imdb;
use Illuminate\Console\Command;

class ParseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse data from links in DB';

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
        $imdb = new Imdb();

        $links = \DB::table('film_links')->select('links')->where('status', 0)->get();

        foreach ($links->collect()->toArray() as $key) {
            try {
                $imdb->getData($key->links);
            } catch (\Exception $e) {
                echo "$key->links :  Movie Exists\n";
            }
        }

    }
}
