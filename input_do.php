//フォームからの情報を保存する

<h2>Practice</h2>

//MySQLへの接続
<?php require('dbconnect.php'); ?>


<?php
// $dbの内容を確認
var_dump($db);

//入力されたテキストデータをDBに保存する
if (!empty($_POST["memo"])) {
    $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
    $statement->execute(array($_POST['memo']));
    // エラーを表示
    var_dump($db->errorInfo());
    echo 'メモが登録されました';
}else{
    echo 'メモが入力されていません';
}
// プログラムが最後まで実行されたか確認するために行数を表示します。
echo __LINE__;
?>
