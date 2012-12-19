<?php $this->load('layout/header') ?>
<div class="row">
    <section>
        <h2>Login to your account.</h2>
        <?php $this->load('include/message'); ?>

        <?php echo $form->open($baseUrl.'user/login', 'post'); ?>
        <div class="controls">
            <?php echo $form->label('username', 'Username'); ?>
            <?php echo $form->input('text', 'username', array('value' => isset($_POST['username']) ? $this->purify($_POST['username']) : '')); ?>
        </div>
        <div class="controls">
            <?php echo $form->label('password', 'Password'); ?>
            <?php echo $form->input('password', 'password'); ?>
        </div>
        <?php echo $form->submit('Login', array('class' => 'btn')); ?>
        <?php echo $form->close(); ?>

    </section>
    <a href="<?php echo $baseUrl.'user/register'; ?>">No account? Get one!</a>
</div>
<?php $this->load('layout/footer') ?>