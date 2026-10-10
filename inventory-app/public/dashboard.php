<?php
require_once __DIR__ . '/../config/database.php';
$pageTitle='Dashboard';
require '_header.php';
$totalProducts=(int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$totalStock=(int)$pdo->query('SELECT COALESCE(SUM(stock),0) FROM products')->fetchColumn();
$lowStock=(int)$pdo->query('SELECT COUNT(*) FROM products WHERE stock <= minimum_stock')->fetchColumn();
$inventoryValue=(float)$pdo->query('SELECT COALESCE(SUM(stock*price),0) FROM products')->fetchColumn();
$recent=$pdo->query("SELECT sm.*, p.name AS product_name, u.username FROM stock_movements sm JOIN products p ON p.id=sm.product_id JOIN users u ON u.id=sm.user_id ORDER BY sm.id DESC LIMIT 8")->fetchAll();
?>
<h1>Dashboard</h1><p class="muted">Ringkasan kondisi persediaan barang.</p>
<div class="grid"><div class="card">Total Produk<div class="stat"><?=$totalProducts?></div></div><div class="card">Total Stok<div class="stat"><?=$totalStock?></div></div><div class="card">Stok Rendah<div class="stat"><?=$lowStock?></div></div><div class="card">Nilai Inventory<div class="stat" style="font-size:23px">Rp <?=number_format($inventoryValue,0,',','.')?></div></div></div>
<div class="card"><h2>Transaksi Terbaru</h2><div class="table-wrap"><table><thead><tr><th>Tanggal</th><th>Produk</th><th>Jenis</th><th>Jumlah</th><th>Pengguna</th><th>Catatan</th></tr></thead><tbody>
<?php foreach($recent as $r): ?><tr><td><?=e($r['created_at'])?></td><td><?=e($r['product_name'])?></td><td><?=e($r['type']==='IN'?'Barang masuk':'Barang keluar')?></td><td><?=e($r['quantity'])?></td><td><?=e($r['username'])?></td><td><?=e($r['note'])?></td></tr><?php endforeach; ?>
<?php if(!$recent): ?><tr><td colspan="6" class="muted">Belum ada transaksi.</td></tr><?php endif; ?></tbody></table></div></div>
<?php require '_footer.php'; ?>
