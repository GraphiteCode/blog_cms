<?php



include_once 'start.php';
include_once 'admin/includes/admin.class.php';
$articles = new Admin;
$articles = $articles->fetchArticles();
include_once 'includes/header.php'; ?>
<ol>
    <?php foreach ($articles as $article) { ?>
        <li>
            <a href="article.php?slug=<?php echo esc($article['slug']); ?>">
                <?php echo esc($article['title']) ?>
            </a> - <small>posted <?php echo esc(formatDate($article['created'])) ?></small>
        </li>
    <?php } ?>
</ol>
<br>
<small><a href="admin">admin</a></small>

<?php include_once 'includes/footer.php' ?>