<?php $this->load('layout/header'); ?>
<section>
    <h1>Content</h1>
    <p>Create, edit and view content.</p>
    <h2>All content</h2>
    <?php if ($listAll) : ?>
    <ul>
    <?php foreach ($listAll as $c) : ?>
        <li>
            <?php echo $c->getId(); ?> <?php echo $c->getTitle();?> by <?php echo $c->getUser()->getUsername(); ?>
            <a href="<?php echo $baseUrl; ?>content/edit/<?php echo $c->getId(); ?>">Edit</a>
            <a href="<?php echo $baseUrl; ?>page/view/<?php echo $c->getId(); ?>">View</a>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <h2>Actions</h2>
    <p><a href="<?php echo $baseUrl; ?>content/new">Create new</a> </p>
    <p><a href="<?php echo $baseUrl; ?>blog">Show as blog</a></p>
</section>
<?php $this->load('layout/footer'); ?>