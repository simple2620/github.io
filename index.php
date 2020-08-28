//入力したデータの一覧画面
<h2>トップページです<h2>

<h2>practie</h2>

//エラーの表示
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

//MySQLへの接続
<?php require('dbconnect.php'); ?>

//データベースから入力データを取得
<?php
if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
  $page = $_REQUEST['page'];
}else{
  $page = 1;
}
$start = 5 * ($page - 1);
$memos = $db->prepare('SELECT * FROM memos ORDER BY id LIMIT ?,5');
$memos->bindParam(1, $start, PDO::PARAM_INT);
$memos->execute();
print_r($db->errorInfo());
?>

//取得したデータを画面に表示していく
<article>
<?php while ( $memo = $memos->fetch()): ?>
  <p><a href="memo.php?id=<?php print($memo['id']); ?>">
  <?php print(mb_substr($memo['memo'],0,50)); ?>
  <?php print((mb_strlen($memo['memo'])) > 50 ? '...' : ''); ?></a></p>
  <time><?php print($memo['created_at']); ?></time>
  <hr>
<?php endwhile; ?>

//ページングの設定
<?php if ($page >= 2): ?>
<a href="index.php?page=<?php print($page-1); ?>">
<?php print($page-1); ?>ページ目へ</a>
<?php endif; ?>
|
<?php
$counts = $db ->query('SELECT COUNT(*) AS cnt FROM memos');
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 5);
if($page < $max_page):
?>
<a href="index.php?page=<?php print($page+1); ?>">
<?php print($page+1); ?>ページ目へ</a>
<?php endif; ?>
</article>
