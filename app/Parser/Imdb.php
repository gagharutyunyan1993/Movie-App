<?php


namespace App\Parser;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;


class Imdb extends Model
{
    public $timestamps = false;

    public function getLinks($url)
    {
        //Get page
        $html = file_get_html($url);
        $next_page = $html->find('a.lister-page-next', 0);

        foreach ($html->find('h3.lister-item-header a') as $link_to_article) {
            $filter = strstr($link_to_article->href, "?", true);
            DB::table('film_links')->insertOrIgnore([
                'links' => "https://www.imdb.com" . $filter,
                'status' => 0
            ]);
            echo "https://www.imdb.com" . $filter . "\n";
        }

        if (isset($next_page)) {
            $this->getLinks('https://www.imdb.com/' . $next_page->href);
        }

        return true;
    }

    public function getData($url)
    {
        // Array for names
        $directors = [];
        $actors = [];
        $genres = [];
        // Array for Ids
        $directorsId = [];
        $actorsId = [];
        $genresId = [];

        //Get
        $mainPageData = file_get_html($url);
        //Title
        $title = strstr($mainPageData->find('h1', 0)->innertext, '&nbsp', true);
        //Description
        $desc = trim(strip_tags($mainPageData->find('div.summary_text', 0)->innertext));
        //Image
        $img = $mainPageData->find('img[title]', 0)->src;
        //Runtime
        $runtime = trim($mainPageData->find('div.subtext time', 0)->innertext);
        //ReleaseDate
        for ($i = 0; $i < count($mainPageData->find('div.subtext a')); $i++) {
            if ((preg_match('~[0-9]+~', $mainPageData->find('div.subtext a', $i)->innertext))) {
                $releaseDate = trim(strstr($mainPageData->find('div.subtext a', $i)->innertext, '(', true));

            }
        }
        //Genre
        foreach ($mainPageData->find('div.subtext a') as $k) {
            if (!preg_match('~[0-9]+~', $k->innertext)) {
                $genres[] = $k->innertext;
            }
        }

        //Get
        $actorsAndDirectorsData = file_get_html($url . 'fullcredits');
        //Directors
        foreach ($actorsAndDirectorsData->find('table.simpleTable tbody tr td') as $k) {
            if (strripos($k->innertext, 'ttfc_fc_dr')) {
                $directors[] = trim(strip_tags($k->innertext));
            }
        }
        //Actors
        foreach ($actorsAndDirectorsData->find('table.cast_list tr') as $actor) {
            //$actor = trim(strip_tags(strstr($actor,'...',true)));
            $act = trim(strip_tags($actor->innertext));
            if ($act != '') {
                if (strpos($act, '...') != false) {
                    $act = trim(strstr($act, '...', true));
                }
                if ($act != 'Rest of cast listed alphabetically:') {
                    $actors[] = $act;
                }
            }
        }

        // Insert to (Actors,Directors,Genres) tables
        foreach ($directors as $director) {
            \DB::table('directors')->insertOrIgnore([
                'name' => $director
            ]);
        }
        foreach ($actors as $actor) {
            \DB::table('actors')->insertOrIgnore([
                'name' => $actor
            ]);

        }
        foreach ($genres as $genre) {
            \DB::table('genres')->insertOrIgnore([
                'name' => $genre
            ]);
        }

        // Get (Actors,Directors,Genres) Ids

        foreach ($directors as $director) {
            $directorsId['directors'][] = $this->getId('directors', $director);
        }
        foreach ($actors as $actor) {
            $actorsId['actors'][] = $this->getId('actors', $actor);
        }
        foreach ($genres as $genre) {
            $genresId['genres'][] = $this->getId('genres', $genre);
        }

        $movie = Movie::create([
            'title' => $title,
            'picture' => $img,
            'description' => $desc,
            'runtime' => $runtime,
            'releaseDate' => $releaseDate
        ]);

        $movie->directors()->sync($directorsId['directors']);
        $movie->actors()->sync($actorsId['actors']);
        $movie->genres()->sync($genresId['genres']);

        echo $url . " : DONE!\n" ;
    }

    public function getId($table, $name)
    {
        $row = \DB::table($table)->where('name', '=', $name)->first();

        return $row->id;
    }
}
