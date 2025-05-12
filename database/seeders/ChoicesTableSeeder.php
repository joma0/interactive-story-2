<?php

namespace Database\Seeders;

use App\Models\Choice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoicesTableSeeder extends Seeder
{
    /**
     * Remplir la table Choices
     */
    public function run() {}

    public function seedFromData(array $choiceData)
    {
        return Choice::create($choiceData);
    }
}
