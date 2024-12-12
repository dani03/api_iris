<?php

namespace App\Http\Repositories\Articles;

use App\Models\Article;

class ArticleRepository
{

    public function allArticles()
    {
        return Article::all();
    }

    /**
     * @param int $articleId
     * @return Article|null
     */
    public function getArticle(int $articleId): Article | null
    {
        return Article::find($articleId);
    }

    /**
     * ajoute un article à la base de données
     * @param array $data
     * @return bool
     */
    public function addArticle(array $data):bool
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
