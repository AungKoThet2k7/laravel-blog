<?php

namespace Database\Seeders;

use App\Models\Nation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nations = ["Myanmar", "Korea", "Japan", "Thailand", "Singapore", "china"];
        foreach($nations as $nation) {
            Nation::factory()->create([
                "name" => $nation,
            ]);
        };
    }
}
