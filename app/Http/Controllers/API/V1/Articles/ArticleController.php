<?php

namespace App\Http\Controllers\API\V1\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Services\Articles\ArticleService;
use App\Models\Article;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    public function __construct(private ArticleService $articleService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = $this->articleService->getArticles();
        return response()->json(ArticleResource::collection($articles), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $articleSaved = $this->articleService->saveArticle($request);
        if($articleSaved) {
            return \response()->json(['message' => 'Article ajouté avec succès.'], Response::HTTP_CREATED);
        }
        return \response()->json(['message' => 'un problème est survenue à l\'ajout de l\'article.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = $this->articleService->getOneArticle($id);
        if($article) {
            return response()->json(new ArticleResource($article), Response::HTTP_OK);
        }
        return \response()->json(['message' => 'cet article n\'existe.'], Response::HTTP_NOT_FOUND);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = $this->articleService->getOneArticle($id);
        if(!$article) {
            return \response()->json(['message' => 'cet article n\'existe.'], Response::HTTP_NOT_FOUND);
        }
        $datas = $request->all();

        $articleUpdated = $this->articleService->updateArticle($article, $datas);

       if($article->wasChanged()) {
           return \response()->json(['message' => 'article mis à jour.'], Response::HTTP_OK);
       }

        return \response()->json(['message' => 'aucune mise à jour faites.'], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = $this->articleService->getOneArticle($id);
        if(!$article) {
            return \response()->json(['message' => 'impossible de trouver l\'article.'], Response::HTTP_NOT_FOUND);

        }

       if (Article::destroy($id)) {
           return \response()->json(['message' => 'article supprimé.'], Response::HTTP_OK);

       }
        return \response()->json(['message' => 'impossible de supprimer une erreur est survenue.'], Response::HTTP_INTERNAL_SERVER_ERROR);

    }
}
