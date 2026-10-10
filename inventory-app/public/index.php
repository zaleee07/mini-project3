<?php
require_once __DIR__ . '/../helpers/auth.php';
if (empty($_SESSION['user'])) {
    header('Location: login.php');
} else {
    header('Location: dashboard.php');
}
exit;
