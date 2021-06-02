<?php $articles = $articles->fetchArticles(); ?>
<div class="adminNav">
    <a href="new_article.php">NEW ARTICLE</a>
    <a href="logout.php">Log out</a>
</div>
<h2>Published</h2>
<?php
if (empty($articles)) {
    echo 'No Articles.';
    // $alert = "No articles.";
    // include_once 'includes/alert.php';
}
foreach ($articles as $article) {
?>
    <table>
        <tr>
            <td>
                <small>
                    <?php echo esc(formatDate($article['created'])); ?>
                </small>

            </td>
            <td>
                <a href="article.php?slug=<?php echo esc($article['slug']); ?>"> <?php echo esc($article['title']); ?></a>
            </td>
            <td>
                <div class="">
                    <form action="" method="post">
                        <a href="edit_article.php?slug=<?php echo esc($article['slug']); ?>">Edit</a>
                        <input type="hidden" name="slug" id="slug" value="<?php echo $article['slug']; ?>">
                        <input type="submit" name="deleteArticle" value="Delete">
                    </form>
                </div>
            </td>
        </tr>
    </table>
<?php } ?>

<?php $drafts = $drafts->fetchDrafts(); ?>

<h2>Drafts</h2>
<?php
if (empty($drafts)) {
    echo 'No Drafts.';

    // $alert = "No drafts.";
    // include_once 'includes/alert.php';
}
foreach ($drafts as $draft) { ?>
    <table>
        <tr>
            <td>
                <small>
                    <?php echo esc(formatDate($draft['created'])); ?>
                </small>
            </td>
            <td>
                <a href="article.php?slug=<?php echo esc($draft['slug']); ?>"><?php echo esc($draft['title']); ?></a>
            </td>
            <td>
                <div class="">
                    <form action="" method="post">
                        <a href="edit_draft.php?slug=<?php echo esc($draft['slug']); ?>">Edit</a>
                        <input type="hidden" name="slug" id="slug" value="<?php echo $draft['slug']; ?>">
                        <input type="submit" name="deleteDraft" value="Delete">
                    </form>
                </div>
            </td>
        </tr>
    </table>
<?php }

if (isset($_POST['deleteArticle'])) {
    $slug = $_POST['slug'];
    $deleteArticle->deleteArticle($slug);
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteDraft'])) {
    $slug = $_POST['slug'];
    $deleteDraft->deleteDraft($slug);
    echo "<meta http-equiv='refresh' content='0'>";
}

// if (isset($_POST['deleteDraft'])) {
//     $slug = $_POST['slug'];
//     $deleteDraft->deleteDraft($slug);
//     header('Location: index.php');
// }

?>