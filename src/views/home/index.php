<?php
/** @var \src\components\view\template\PhpEngine $this */
$this->extend('layout.php');
$this->getSlots()->set('title', $title);
$this->getSlots()->set('description', $title);
?>
<h1>Home page</h1>