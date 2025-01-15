<?php

namespace App\Http\Repositories\Articles;

use App\Models\Article;

class ArticleRepository
{
    public function allArticles()
    {
        return Article::all();
    }

    public function getArticle(int $articleId): ?Article
    {
        return Article::find($articleId);
    }

    /**
     * ajoute un article à la base de données
     */
    public function addArticle(array $data): bool
    {
        return (bool) Article::create([
            'text' => $data['text'],
            'title' => $data['title'],
        ]);
    }

    public function update(Article $article, $data): bool
    {
        return $article->update($data);
    }
}
