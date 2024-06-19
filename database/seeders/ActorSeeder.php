<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $n = 1;
        while($n < 10)
        {
            $url='https://randomuser.me/api/';
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            //print_r($data['results'][0]['email']);


            Actor::create([
                'name' => $data['results'][0]['name']['first'] . $data['results'][0]['name']['last'],
                'age' => rand(16,65),
                'image' => $data['results'][0]['picture']['thumbnail'],
                'gender' => $data['results'][0]['gender'],
            ]  
            );

            $n++;
        }
        
        
    }
}
