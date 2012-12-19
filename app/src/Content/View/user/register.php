<?php $this->load('layout/header'); ?>
<div class="row" xmlns="http://www.w3.org/1999/html">
    <section>
        <h2>Register an account</h2>

        <?php $this->load('include/message'); ?>

        <?php echo $form->open($baseUrl.'user/register', 'post'); ?>
        <div class="controls">
            <?php echo $form->label('username', 'Username'); ?>
            <?php echo $form->input('text', 'username', array('value' => isset($_POST['username']) ? $this->purify($_POST['username']) : '')); ?>
            <span class="help-block text-error">
				<?php echo isset($validation) ? $validation->getError('username') : ''; ?>
			</span>
        </div>
        <div class="controls">
            <?php echo $form->label('password', 'Password'); ?>
            <?php echo $form->input('password', 'password'); ?>
            <span class="help-block text-error">
				<?php echo isset($validation) ? $validation->getError('password') : ''; ?>
			</span>
        </div>
        <div class="controls">
            <?php echo $form->label('password_repeat', 'Repeat password'); ?>
            <?php echo $form->input('password', 'password_repeat'); ?>
            <span class="help-block text-error">
				<?php echo isset($validation) ? $validation->getError('password_repeat') : ''; ?>
			</span>
        </div>
        <div class="controls">
            <?php echo $form->label('name', 'Name'); ?>
            <?php echo $form->input('text', 'name', array('value' => isset($_POST['name']) ? $this->purify($_POST['name']) : '')); ?>
            <span class="help-block text-error">
				<?php echo isset($validation) ? $validation->getError('name') : ''; ?>
			</span>
        </div>
        <div class="controls">
            <?php echo $form->label('email', 'Email'); ?>
            <?php echo $form->input('text', 'email', array('value' => isset($_POST['email']) ? $this->purify($_POST['email']) : '')); ?>
            <span class="help-block text-error">
				<?php echo isset($validation) ? $validation->getError('email') : ''; ?>
			</span>
        </div>
        <?php echo $form->submit('Login', array('class' => 'btn')); ?>
        <?php echo $form->close(); ?>
    </section>
    <p>Already an member? <a href="<?php echo $baseUrl.'user/login' ?>">login</a></p>
</div>
<?php $this->load('layout/footer'); ?>