<?php
include_once '../start.php';
include_once 'includes/admin.class.php';
$article = new Admin;
$saveArticle = new Admin;
$draftArticle = new Admin;
$deleteArticle = new Admin;
include_once 'includes/header.php';

if (!isset($_GET['slug'])) { ?>
    <form action="" method="post" autocomplete="off">
        <input type="text" name="title" id="title" placeholder="title"><br><br>
        <input type="text" name="slug" id="slug" placeholder="slug"><br><br>
        <textarea name="body" id="body" cols="50" rows="20" placeholder="body"></textarea><br><br>
    </form>
    <br>
    <a href="index.php">&larr; Back</a>
<?php } else {
    $slug = $_GET['slug'];
    $article = $article->fetchBySlug($slug);
?>
    <form action="" method="post" autocomplete="off">
        <h2><?php echo esc($article['title']); ?></h2>

        <input type="submit" name="saveArticle" value="SAVE">
        <input type="submit" name="draftArticle" value="DRAFT">
        <input type="submit" name="deleteArticle" value="DELETE">
        <br>
        <br>
        <label for="title"><small>Title</small><br>
            <input type="text" name="title" id="title" placeholder="title" value="<?php echo esc($article['title']); ?>"><br><br>
        </label>
        <label for="slug"><small>Slug</small><br>
            <input type="text" name="slug" id="slug" placeholder="slug" value="<?php echo esc($article['slug']); ?>"><br><br>
        </label>
        <label for="body"><small>Body</small><br>

            <textarea name="body" id="body" cols="50" rows="20" placeholder="body"><?php echo esc($article['body']); ?></textarea><br><br>
        </label>
        <input type="hidden" name="id" id="id" value="<?php echo $article['id']; ?>">
        <?php
        if (!$article['updated']) {
            $article['updated'] = Date('Y');
        } else { ?>
            <small> Last Updated: <?php echo esc(formatDate($article['updated'])); ?></small>
        <?php }

        ?>
    </form>



    <br>
    <a href="index.php">&larr; Back</a>
<?php
    if (isset($_POST['saveArticle'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $body = $_POST['body'];
        $id = $_POST['id'];
        $updated = $_POST['updated'];
        $saveArticle->saveArticle($title, $slug, $body, $id, $updated);
        header('Location: index.php');
    }

    if (isset($_POST['draftArticle'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $body = $_POST['body'];
        // $id = $_POST['id'];
        $draftArticle->draft($title, $slug, $body);
        $deleteArticle->deleteArticle($slug);
        header('Location: index.php');
    }

    if (isset($_POST['deleteArticle'])) {
        $slug = $_POST['slug'];
        $deleteArticle->deleteArticle($slug);
        header('Location: index.php');
    }
}
include_once '../includes/footer.php';
?>