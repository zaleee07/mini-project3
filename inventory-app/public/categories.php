<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/auth.php'; require_login();
require_once __DIR__ . '/../helpers/escape.php'; require_once __DIR__ . '/../helpers/csrf.php';
$pageTitle='Kategori'; $message=''; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf();
 if (($_POST['action']??'')==='add') {
  $name=trim($_POST['name']??''); $description=trim($_POST['description']??'');
  if($name==='') $error='Nama kategori wajib diisi.';
  else { try {$st=$pdo->prepare('INSERT INTO categories(name,description) VALUES(?,?)');$st->execute([$name,$description]);$message='Kategori berhasil ditambahkan.';} catch(PDOException $e){$error='Kategori gagal ditambahkan. Pastikan nama kategori belum digunakan.';} }
 }
 if (($_POST['action']??'')==='delete') {
  require_admin();
  try {$st=$pdo->prepare('DELETE FROM categories WHERE id=?');$st->execute([(int)$_POST['id']]);$message='Kategori dihapus.';} catch(PDOException $e){$error='Kategori masih dipakai oleh produk sehingga tidak dapat dihapus.';}
 }
}
$rows=$pdo->query('SELECT c.*, COUNT(p.id) product_count FROM categories c LEFT JOIN products p ON p.category_id=c.id GROUP BY c.id ORDER BY c.name')->fetchAll();
require '_header.php';
?>
<h1>Data Kategori</h1><?php if($message):?><div class="notice"><?=e($message)?></div><?php endif;?><?php if($error):?><div class="error"><?=e($error)?></div><?php endif;?>
<div class="card"><h2>Tambah Kategori</h2><form method="post"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><input type="hidden" name="action" value="add"><label>Nama kategori</label><input name="name" required maxlength="100"><label>Deskripsi</label><input name="description" maxlength="255"><div class="actions"><button>Tambah</button></div></form></div>
<div class="card"><h2>Daftar Kategori</h2><div class="table-wrap"><table><tr><th>Nama</th><th>Deskripsi</th><th>Jumlah produk</th><th>Aksi</th></tr><?php foreach($rows as $r):?><tr><td><?=e($r['name'])?></td><td><?=e($r['description'])?></td><td><?=e($r['product_count'])?></td><td><?php if(($_SESSION['user']['role']??'')==='admin'):?><form method="post" onsubmit="return confirm('Hapus kategori ini?')"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=e($r['id'])?>"><button class="danger">Hapus</button></form><?php else:?>-<?php endif;?></td></tr><?php endforeach;?></table></div></div>
<?php require '_footer.php'; ?>
