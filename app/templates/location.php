<?php include(__DIR__.'/includes/header.php'); ?>

<div class="page-header">
    <h1><?= $location->getName(); ?></h1>
</div>

<ul class="breadcrumb">
    <li><a href="/locations">Locations</a> <span class="divider">/</span></li>
    <li class="active"><?= $location->getName(); ?></li>
</ul>

<h2>Comments</h2>

<?php if (!empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>
        <blockquote>
            <p><?= $comment->getBody(); ?></p>
            <small>by <strong><?= $comment->getUsername(); ?></strong>, <?= $comment->getCreatedAt()->format('Y/m/d H:i:s'); ?></small>
        </blockquote>
    <?php endforeach; ?>
<?php else : ?>
    No comment.
<?php endif; ?>

<form action="/locations/<?= $location->getId(); ?>" method="POST" class="form-inline">
    <fieldset>
        <legend>Update this location</legend>
        <input type="hidden" name="_method" value="PUT">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" value="<?= $location->getName(); ?>">
        <input type="submit" class="btn" value="Update">
    </fieldset>
</form>

<form action="/locations/<?= $location->getId(); ?>" method="POST" class="form-inline">
    <fieldset>
        <legend>Delete this location</legend>
        <input type="hidden" name="_method" value="DELETE" />
        <input type="submit" class="btn btn-danger" value="Delete" />
    </fieldset>
</form>

<?php include(__DIR__.'/includes/footer.php');
