<?php

namespace Tests\Feature\Api;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use function PHPUnit\Framework\assertEmpty;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testIndex()
    {
        $response = $this->getJson(route('api.authors.index'));

        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->postJson(route('api.authors.store'), [
            'name' => $this->faker->name,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('authors', [
            'id' => $response->json('data.id'),
            'name' => $response->json('data.name'),
        ]);
    }

    public function testShow()
    {
        $author = Author::factory()->create();

        $response = $this->getJson(route('api.authors.show', $author->id));

        $response->assertOk();
    }

    public function testUpdate()
    {
        $author = Author::factory()->create();

        $response = $this->putJson(route('api.authors.update', $author->id), [
            'name' => $this->faker->name,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => $response->json('data.name'),
        ]);
    }

    public function testDestroy()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson(route('api.authors.destroy', $author->id));

        $response->assertNoContent();
        assertEmpty(Author::find($author->id));
    }
}
