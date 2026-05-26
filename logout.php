<?php
require_once __DIR__ . '/includes/session.php';
unset($_SESSION['user']);
header('Location: /NexiShop/index.php');
exit;
