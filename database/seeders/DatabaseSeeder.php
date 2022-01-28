<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comentario;
use App\Models\Favorito;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
        ->count(1)
        ->hascomentario()
        ->hasfavorito()
        ->create();
        Comentario::factory()
        ->count(10)
        ->create();
        Favorito::factory()
        ->count(10)
        ->create();
    }
}
