<?php

class Admin
{
    public function login($user, $pass)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM users WHERE user = ? and pass = ?");

        $query->bindValue(1, $user);
        $query->bindValue(2, $pass);
        $query->execute();

        $num = $query->rowCount();
        return $num;
    }

    public function logout()
    {
        session_destroy();
    }

    public function fetchTables()
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM drafts
                                UNION
                                SELECT * FROM articles");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchBySlug($slug)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM drafts WHERE slug = ?
                                UNION
                                SELECT * FROM articles WHERE slug = ?");
        $query->bindValue(1, $slug);
        $query->bindValue(2, $slug);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchArticles()
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM articles ORDER BY created DESC");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchDrafts()
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM drafts ORDER BY created DESC");
        $query->execute();

        return $query->fetchAll();
    }




    public function saveArticle($title, $slug, $body, $id)
    {
        global $pdo;
        $query = $pdo->prepare("UPDATE articles SET title=?, slug=?, body=? WHERE id=?");
        $query->execute([$title, $slug, $body, $id]);
    }

    public function saveDraft($title, $slug, $body, $id)
    {
        global $pdo;
        $query = $pdo->prepare("UPDATE drafts SET title=?, slug=?, body=? WHERE id=?");
        $query->execute([$title, $slug, $body, $id]);
    }




    public function deleteArticle($slug)
    {
        global $pdo;
        $query = $pdo->prepare("DELETE FROM articles WHERE slug = ?");
        $query->bindValue(1, $slug);
        $query->execute();
    }
    public function deleteDraft($slug)
    {
        global $pdo;
        $query = $pdo->prepare("DELETE FROM drafts WHERE slug = ?");
        $query->bindValue(1, $slug);
        $query->execute();
    }

    //NEW ARTICLES

    public function publish($title, $slug, $body)
    {
        global $pdo;
        $query = $pdo->prepare("INSERT INTO articles (title, slug, body) VALUES (?,?,?)");
        $query->execute([$title, $slug, $body]);
    }


    public function draft($title, $slug, $body)
    {
        global $pdo;
        $query = $pdo->prepare("INSERT INTO drafts (title, slug, body) VALUES (?,?,?)");
        $query->execute([$title, $slug, $body]);
    }
}
