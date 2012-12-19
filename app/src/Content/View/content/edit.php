<?php $this->load('layout/header'); ?>
<section>
    <?php if ($create) : ?>
    <h2>Create Content</h2>
        <p>Create new content.</p>
    <?php $link = $baseUrl."content/new"; ?>
    <?php else : ?>
    <h2>Edit Content</h2>
        <p>You can edit and save this content.</p>
    <?php $link = $baseUrl."content/edit"; ?>
    <?php endif; ?>
    <?php $this->load('include/message'); ?>
    <?php echo $form->open($link, 'post');?>
    <?php echo $form->hidden('contentId', array('value' => isset($editData) ? $editData->getId() : '')) ?>
    <div class="controls">
        <?php echo $form->label('title', 'Title'); ?>
        <?php echo $form->input('text', 'title', array('value' => isset($editData) ? $editData->getTitle() : $this->purify($this->post('title')))); ?>
        <span class="help-block text-error">
            <?php echo isset($validation) ? $validation->getError('title') : ''; ?>
        </span>
    </div>
    <div class="controls">
        <?php echo $form->label('slug', 'Slug'); ?>
        <?php echo $form->input('text', 'slug', array('value' => isset($editData) ? $editData->getSlug() : $this->purify($this->post('slug')))); ?>
        <span class="help-block text-error">
            <?php echo isset($validation) ? $validation->getError('slug') : ''; ?>
        </span>
    </div>
    <div class="controls">
        <?php echo $form->label('data', 'Data'); ?>
        <?php echo $form->textarea('data', isset($editData) ? $editData->getData() : $this->purify($this->post('data')), array('class' => 'test')); ?>
        <br />
        <span class="help-block text-error">
            <?php echo isset($validation) ? $validation->getError('data') : ''; ?>
        </span>
    </div>
    <div class="controls">
        <?php echo $form->label('type', 'Type'); ?>
        <?php echo $form->input('text', 'type', array('value' => isset($editData) ? $editData->getType() : $this->purify($this->post('type')))); ?>
        <span class="help-block text-error">
            <?php echo isset($validation) ? $validation->getError('type') : ''; ?>
        </span>
    </div>
    <div class="controls">
        <?php echo $form->label('filter', 'Filter'); ?>
        <?php echo $form->input('text', 'filter', array('value' => isset($editData) ? $editData->getFilter() : $this->purify($this->post('filter')))); ?>
        <span class="help-block text-error">
            <?php echo isset($validation) ? $validation->getError('filter') : ''; ?>
        </span>
    </div>
    <?php echo $form->submit(($create) ? 'Create' : 'Update', array('class' => 'btn')); ?>
    <?php echo $form->close(); ?>
</section>
<?php $this->load('layout/footer'); ?>