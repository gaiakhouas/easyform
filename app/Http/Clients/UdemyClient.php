<?php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

Class UdemyClient{
    /**
     * get udemy courses from api keys found in .env
     */
    public function getUdemyCourses(){
        $client = Http::withBasicAuth(env('UDEMY_CLIENT_ID'), env('UDEMY_CLIENT_SECRET'));
        $response = $client->get('https://www.udemy.com/api-2.0/courses/', [
            'ratings' => 4,
            'page_size' => 4,
            'language' => 'fr'
        ]);
        return json_decode($response, true);
    }
}