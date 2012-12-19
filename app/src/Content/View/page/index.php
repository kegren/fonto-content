<?php $this->load('layout/header'); ?>
<div class="row">
    <section>
        <h2><?php echo $this->purify($page->getTitle()); ?></h2>
        <p><?php echo $this->filter($page->getData(), $page->getFilter()); ?></p>
        <p>
            <a href="<?php echo $baseUrl; ?>content/edit/<?php echo $page->getId(); ?>">Edit</a>
            <a href="<?php echo $baseUrl; ?>content/">View all</a>
        </p>
    </section>
</div>
<?php $this->load('layout/footer'); ?>