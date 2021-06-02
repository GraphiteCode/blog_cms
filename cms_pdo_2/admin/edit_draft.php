<?php
include_once '../start.php';
include_once 'includes/admin.class.php';
$draft = new Admin;
$saveDraft = new Admin;
$publishDraft = new Admin;
$deleteDraft = new Admin;
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
    $draft = $draft->fetchBySlug($slug);
?>
    <form action="" method="post" autocomplete="off">
        <h2><?php echo esc($draft['title']); ?> (draft)</h2>

        <input type="submit" name="saveDraft" value="SAVE">
        <input type="submit" name="publishDraft" value="PUBLISH">
        <input type="submit" name="deleteDraft" value="DELETE">
        <br><br>
        <label for="title"><small>Title</small><br>
            <input type="text" name="title" id="title" placeholder="title" value="<?php echo esc($draft['title']); ?>"><br><br>
        </label>
        <label for="title"><small>Slug</small><br>
            <input type="text" name="slug" id="slug" placeholder="slug" value="<?php echo esc($draft['slug']); ?>"><br><br>
        </label>
        <label for="title"><small>Title</small><br>
            <textarea name="body" id="body" cols="50" rows="20" placeholder="body"><?php echo esc($draft['body']); ?></textarea><br><br>
        </label>
        <input type="hidden" name="id" id="id" value="<?php echo $draft['id']; ?>">
        <?php
        if (!$draft['updated']) {
            $draft['updated'] = Date('Y');
        } else { ?>
            <small> Last Updated: <?php echo esc(formatDate($draft['updated'])); ?></small>
        <?php }

        ?>
    </form>



    <br>
    <a href="index.php">&larr; Back</a>
<?php
    if (isset($_POST['saveDraft'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $body = $_POST['body'];
        $id = $_POST['id'];
        $updated = $_POST['updated'];
        $saveDraft->saveDraft($title, $slug, $body, $id, $updated);
        header('Location: index.php');
    }

    if (isset($_POST['publishDraft'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $body = $_POST['body'];
        // $id = $_POST['id'];
        $publishDraft->publish($title, $slug, $body);
        $deleteDraft->deleteDraft($slug);
        header('Location: index.php');
    }

    if (isset($_POST['deleteDraft'])) {
        $slug = $_POST['slug'];
        $deleteDraft->deleteDraft($slug);
        header('Location: index.php');
    }
}
include_once '../includes/footer.php';
?>