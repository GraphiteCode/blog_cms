<?php
include_once 'start.php';
include_once 'admin/includes/admin.class.php';
$article = new Admin;
include_once 'includes/header.php';

if (!isset($_GET['slug'])) {
    header('Location: index.php');
    exit();
} else {
    $slug = $_GET['slug'];
    $article = $article->fetchBySlug($slug); ?>
    <h2><?php echo esc($article['title']); ?></h2><small> - posted <?php echo esc(formatDate($article['created'])); ?></small>
    <p><?php echo esc($article['body']); ?></p>
    <a href="index.php">&larr; Back</a>

<?php
    include_once 'includes/footer.php';
}
?>