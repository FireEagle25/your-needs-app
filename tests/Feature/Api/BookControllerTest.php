<?php

namespace Tests\Feature\Api;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testIndex()
    {
        $response = $this->getJson(route('api.books.index'));
        $response->assertOk();
    }

    public function testIndexWithAuthorFilter()
    {
        $newBook = Book::factory()->create();
        $response = $this->getJson(route('api.books.index', [
            'author' => [$newBook->author_id],
        ]));

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
    }

    public function testIndexWithAuthorFilterAndInvalidAuthorId()
    {
        $maxAuthorId = Author::orderBy('id', 'desc')->first()?->id ?? 0;

        $response = $this->getJson(route('api.books.index', [
            'author' => [$maxAuthorId + 1],
        ]));

        $response->assertOk();
        $response->assertJsonCount(0, 'data');
    }

    public function testStore()
    {
        $author = Author::factory()->create();
        $response = $this->postJson(route('api.books.store'), [
            'title' => $this->faker->title,
            'author_id' => $author->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('books', [
            'id' => $response->json('data.id'),
            'title' => $response->json('data.title'),
            'author_id' => $response->json('data.author_id'),
        ]);
    }

    public function testShow()
    {
        $book = Book::factory()->create();

        $response = $this->getJson(route('api.books.show', $book->id));

        $response->assertOk();
    }

    public function testUpdate()
    {
        $book = Book::factory()->create();

        $response = $this->putJson(route('api.books.update', $book->id), [
            'title' => $this->faker->title,
            'author_id' => Author::factory()->create()->id,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $response->json('data.title'),
            'author_id' => $response->json('data.author_id'),
        ]);
    }

    public function testDestroy()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson(route('api.books.destroy', $book->id));

        $response->assertNoContent();
        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }
}
