<?php
$user_id = $_GET['id'];
require 'inc/db.php';
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();
$_SESSION['auth'] = $user;
header('Location: account.php');


