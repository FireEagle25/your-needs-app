<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Author\AuthorResource;
use App\Http\Resources\Author\AuthorWithBooksCountResource;
use App\Models\Author;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthorController extends Controller
{
    /**
     * @return AnonymousResourceCollection<AuthorResource>
     */
    public function index(): AnonymousResourceCollection
    {
        $authors = Author::paginate();
        return AuthorResource::collection($authors);
    }

    /**
     * @param StoreAuthorRequest $request
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = Author::create($request->only('name'));

        return app()->make(AuthorResource::class, ['resource' => $author])
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param string $id
     * @return AuthorWithBooksCountResource
     * @throws BindingResolutionException
     */
    public function show(string $id): AuthorWithBooksCountResource
    {
        $author = Author::with('books')->findOrFail($id);
        return app()->make(AuthorWithBooksCountResource::class, ['resource' => $author]);
    }

    /**
     * @param UpdateAuthorRequest $request
     * @param string $id
     * @return AuthorResource
     * @throws BindingResolutionException
     */
    public function update(UpdateAuthorRequest $request, string $id): AuthorResource
    {
        $author = Author::findOrFail($id);
        $author->update($request->only('name'));

        return app()->make(AuthorResource::class, ['resource' => $author]);
    }

    /**
     * @param string $id
     * @return Response
     */
    public function destroy(string $id): Response
    {
        Author::destroy($id);
        return response()->noContent();
    }
}
