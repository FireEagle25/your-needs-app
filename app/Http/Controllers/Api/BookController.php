<?php

namespace App\Http\Controllers\Api;

use App\Filters\ModelFilters\BookFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookController extends Controller
{

    /**
     * @return AnonymousResourceCollection<BookResource>
     */
    public function index(): AnonymousResourceCollection
    {
        $filter = app()->call([BookFilter::class, 'createWithRequest'], ['request' => request()]);

        $books = $filter->filter(Book::query())->paginate();

        return BookResource::collection($books);
    }

    /**
     * @param StoreBookRequest $request
     * @return BookResource
     * @throws BindingResolutionException
     */
    public function store(StoreBookRequest $request): BookResource
    {
        $book = Book::create($request->validated());
        return app()->make(BookResource::class, ['resource' => $book]);
    }

    /**
     * @param string $id
     * @return BookResource
     * @throws BindingResolutionException
     */
    public function show(string $id): BookResource
    {
        $book = Book::findOrFail($id);
        return app()->make(BookResource::class, ['resource' => $book]);
    }

    /**
     * @param UpdateBookRequest $request
     * @param string $id
     * @return BookResource
     * @throws BindingResolutionException
     */
    public function update(UpdateBookRequest $request, string $id): BookResource
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());

        return app()->make(BookResource::class, ['resource' => $book]);
    }

    /**
     * @param string $id
     * @return Response
     */
    public function destroy(string $id): Response
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->noContent();
    }
}
