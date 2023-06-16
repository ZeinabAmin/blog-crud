<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>
<?php
$conn = mysqli_connect("localhost", "root", "", "blog-crud");
// $query = "SELECT * from `posts`";
$query = "SELECT id,title,created_at from `posts`";
$result = mysqli_query($conn, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// echo "<pre>";
// print_r($posts);
// echo "</pre>";
?>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>All posts</h3>
                </div>
                <div>
                    <a href="create-post.php" class="btn btn-sm btn-success">Add new post</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Published At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- syntax
                 if():
                 endif();
                 foreach ():
                 endforeach; 
                 -->
                    <!-- //server side rendering -->
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <td><?= $post['title']; ?></td>
                            <td><?= $post['created_at']; ?></td>
                            <td>
                                <a href="show-post.php?id=<?= $post['id']; ?>" class="btn btn-sm btn-primary">Show</a>
                                <a href="edit-post.php?id=<?= $post['id']; ?>" class="btn btn-sm btn-secondary">Edit</a>
                                <a href="delete-post.php?id=<?= $post['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('do you really want to delete post?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>