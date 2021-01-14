<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{
    private $results = array();

    public function scraper()
    {
        $client = new Client();
        //url yang akan discrape
        $url = 'https://www.worldometers.info/coronavirus/';
        $page = $client->request('GET', $url);

        // echo "<pre>";
        // print_r($page);

        // echo $page->filter('.maincounter-number')->text();

        // filter yg akan discrape
        $page->filter('#maincounter-wrap')->each(function ($item) {
            $this->results[$item->filter('h1')->text()] = $item->filter('.maincounter-number')->text();
        });

        $data = $this->results;

        return view('scraper', compact('data'));
    }
}
