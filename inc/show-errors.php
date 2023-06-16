<?php if (isset($_SESSION['errors'])) { ?>
    <div class="alert alert-danger">
        <?php foreach ($_SESSION['errors'] as $errors) { ?>
            <p><?= $errors; ?></p>
        <?php } ?>
    </div>
<?php }
unset($_SESSION['errors']); ?>