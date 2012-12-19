<?php if ($session->has('Error')) : ?>
<div class="alert alert-error">
    <strong>Error!</strong> <?php echo $session->flashMessage('Error'); ?>
</div>
<?php endif; ?>
<?php if ($session->has('Success')) : ?>
<div class="alert alert-success">
    <strong>Success! </strong> <?php echo $session->flashMessage('Success'); ?>
</div>
<?php endif; ?>