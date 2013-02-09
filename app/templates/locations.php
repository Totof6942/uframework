<?php include(__DIR__.'/includes/header.php'); ?>

<div class="page-header">
    <h1>Locations</h1>
</div>

<ul class="breadcrumb">
    <li class="active">Locations</li>
</ul>

<?php if (!empty($locations)) : ?>
    <ul>
        <?php foreach ($locations as $location) : ?>
            <li><a href="/locations/<?= $location->getId(); ?>"><?= $location->getName(); ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    No location.
<?php endif; ?>

<form action="/locations" method="POST" class="form-inline">
    <fieldset>
        <legend>Create new location</legend>
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" placeholder="Location's name...">
        <input type="submit" class="btn" value="Add New">
    </fieldset>
</form>

<?php include(__DIR__.'/includes/footer.php');
