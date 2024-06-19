<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $start_id = 1270001;
        $key = "f40f2cb3";
        $url="http://www.omdbapi.com/?apikey=$key&i=tt$start_id";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        print_r($response);
        curl_close($ch);
    }
}
