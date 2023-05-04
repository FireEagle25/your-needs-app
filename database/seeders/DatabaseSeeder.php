<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seeders to run.
     *
     * @var array<string>
     */
    private array $seeders = [
        BookSeeder::class,
        AuthorSeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
