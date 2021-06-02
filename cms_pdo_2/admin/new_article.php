<?php
include_once '../start.php';
include_once 'includes/admin.class.php';
$publish = new Admin;
$draft = new Admin;
include_once 'includes/header.php';

if (isset($_POST['publish'])) {
    $title = $_POST['title'];
    $slug  = $_POST['slug'];
    $body  = $_POST['body'];
    if ((empty($title) || (empty($slug) || (empty($body))))) {
        $alert = 'All fields must be filled out.';
    } else {
        $publish->publish($title, $slug, $body);
        header('Location: index.php');
    }
}

if (isset($_POST['draft'])) {
    $title = $_POST['title'];
    $slug  = $_POST['slug'];
    $body  = $_POST['body'];
    if ((empty($title) || (empty($slug) || (empty($body))))) {
        $alert = 'All fields must be filled out.';
    } else {
        $draft->draft($title, $slug, $body);
        header('Location: index.php');
    }
}
?>

<form action="" method="post" autocomplete="off">
    <input type="submit" name="publish" value="PUBLISH">
    <input type="submit" name="draft" value="DRAFT"><br><br>
    <label for="title"><small>Title</small><br>
        <input type="text" name="title" id="title"><br><br>
    </label>
    <label for="title"><small>Slug</small><br>
        <input type="text" name="slug" id="slug"><br><br>
    </label>
    <label for="title"><small>Body</small><br>
        <textarea name="body" id="body" cols="50" rows="20"></textarea>
    </label>
    <?php include 'includes/alert.php' ?>

</form><br>
<a href="index.php">&larr; Back</a>

<?php include_once '../includes/footer.php'; ?>