<?php
/** @var \src\components\view\template\PhpEngine $this */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php $this->getSlots()->output('title') ?></title>

    <?php if ($this->getSlots()->has('description')): ?>
        <meta name="description" content="<?= $this->getSlots()->get('description') ?>">
    <?php endif; ?>

    <?php if ($this->getSlots()->has('keywords')): ?>
        <meta name="keywords" content="<?= $this->getSlots()->get('keywords') ?>">
    <?php endif; ?>

    <?php if ($this->getSlots()->has('author')): ?>
        <meta name="author" content="<?= $this->getSlots()->get('author') ?>">
    <?php endif; ?>

    <link href="/css/vendor.min.css" rel="stylesheet" type="text/css">
    <?php $this->getSlots()->output('header_assets') ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Simple app</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <?php $this->getSlots()->output('_content') ?>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
<?php $this->getSlots()->output('footer_assets') ?>
</body>
</html>