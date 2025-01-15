<?php

namespace App\Http\Services\Articles;

use App\Http\Repositories\Articles\ArticleRepository;
use App\Http\Requests\Articles\ArticleRequest;
use App\Models\Article;

class ArticleService
{
    public function __construct(private readonly ArticleRepository $articleRepository) {}

    public function getArticles()
    {
        return $this->articleRepository->allArticles();

    }

    public function saveArticle(ArticleRequest $request): bool
    {
        $datas = $request->all();

        return $this->articleRepository->addArticle($datas);
    }

    public function getOneArticle(int $articleId): ?Article
    {
        return $this->articleRepository->getArticle($articleId);
    }

    /**
     * @return bool
     */
    public function updateArticle(Article $article, $newDatas)
    {
        $datas = ['title' => $newDatas['title'], 'text' => $newDatas['text']];

        return $this->articleRepository->update($article, $datas);

    }
}
