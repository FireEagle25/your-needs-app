<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    use WithoutModelEvents;

    protected int $count = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory()->count($this->count)->create();
    }
}
