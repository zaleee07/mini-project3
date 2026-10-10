<?php
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/escape.php';
require_once __DIR__ . '/../helpers/csrf.php';
require_login();
?><!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($pageTitle ?? 'Inventory Management')?></title><link rel="stylesheet" href="style.css"></head><body>
<header class="top"><strong>Inventory Management</strong><nav><a href="dashboard.php">Dashboard</a><a href="categories.php">Kategori</a><a href="products.php">Produk</a><a href="suppliers.php">Supplier</a><a href="stock.php">Transaksi Stok</a><a href="reports.php">Laporan</a><?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?><a href="users.php">Pengguna</a><?php endif; ?><a href="logout.php">Logout</a></nav></header><main class="container">
<div class="muted small" style="margin-bottom:14px">Login sebagai <?=e($_SESSION['user']['username'])?> · Role: <?=e($_SESSION['user']['role'])?></div>
