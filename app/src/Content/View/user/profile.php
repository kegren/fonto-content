<?php $this->load('layout/header'); ?>
<div class="row">
    <section>
        <h2>Your profile page</h2>
        <?php $this->load('include/message'); ?>
        <?php echo $form->open($baseUrl.'user/profile', 'post'); ?>
        <div class="controls">
            <?php echo $form->label('username', 'Username'); ?>
            <?php echo $form->input('text', 'username', array('value' => isset($user) ? $this->purify($user->getUsername()) : '')); ?>
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
            <?php echo $form->input('text', 'name', array('value' => isset($user) ? $this->purify($user->getName()) : '')); ?>
            <span class="help-block text-error">
				<?php echo isset($validation) ? $validation->getError('name') : ''; ?>
			</span>
        </div>
        <div class="controls">
            <?php echo $form->label('email', 'Email'); ?>
            <?php echo $form->input('text', 'email', array('value' => isset($user) ? $this->purify($user->getEmail()) : '')); ?>
            <span class="help-block text-error">
				<?php echo isset($validation) ? $validation->getError('email') : ''; ?>
			</span>
        </div>
        <?php echo $form->submit('Update', array('class' => 'btn btn-info')); ?>
        <?php echo $form->close(); ?>

        <h3>You have following role/roles </h3>
        <ul>
        <?php foreach ($user->getRoles() as $roles ) : ?>
            <li><strong><?php echo $roles->getName(); ?></strong></li>
        <?php endforeach; ?>
        </ul>
    </section>
</div>
<?php $this->load('layout/footer'); ?>