<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoicesTableSeeder extends Seeder
{
    /**
     * Remplir la table Choices
     */
    public function run($params = [])
    {
        \App\Models\Choice::create($params['choice']);
    }
}
