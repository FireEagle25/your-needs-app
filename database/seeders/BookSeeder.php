<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    protected int $count = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Book::factory()->count($this->count)->create();
    }
}
