<?php $this->load('layout/header'); ?>
<div class="row">
    <section class="blog">
        <h2>Blog</h2>
        <p>List all content of type 'post'.</p>
        <?php if ($listAll) : ?>

            <?php foreach ($listAll as $blog) : ?>
            <article>
                <header>
                    <h3><?php echo $this->purify($blog->getTitle()); ?></h3>
                    <p>Posted on: <?php echo $blog->getCreated()->format('Y-m-d'); ?></p>
                </header>
                <section>
                    <p><?php echo $this->purify(nl2br($blog->getData())); ?></p>
                    <p><a href="<?php echo $baseUrl; ?>content/edit/<?php echo $blog->getId(); ?>">Edit</a></p>
                </section>
            </article>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </section>
</div>
<?php $this->load('layout/footer'); ?>