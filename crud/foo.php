<?php
require __DIR__ . "/../classes/Crud.php";
$crud = new Crud();
if (isset($_POST['add'])) {
    $crud->insert_article($_POST);
    header("Location: /Blog/crud/index.php");
}

if (isset($_POST['edit'])) {
    $crud->update_articles($_POST, $_GET['id']);
    //header("Location: /Blog/crud/index.php");
}

if (isset($_POST['delete'])) {
    $crud->delete_articles($_GET['id']);
    header("Location: /Blog/crud/index.php");
}
