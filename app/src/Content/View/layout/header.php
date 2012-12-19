<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fonto Framework</title>
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>web/app/Content/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>web/app/Content/css/style.css">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row">
        <header class="header">
            <?php $session->has('user'); ?>
				<span class="pull-right">
				<?php if ($session->has('user')) : ?>
                    <p><?php echo $session->get('username'); ?> <a href="<?php echo $baseUrl.'user/logout'; ?>">Logout</a></p>
                    <?php else : ?>
                    <p><a href="<?php echo $baseUrl.'user/login'; ?>">Login</a> </p>
                    <?php endif; ?>
				</span>
            <h1>Fonto Framework</h1>
        </header>
    </div>