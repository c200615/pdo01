<?php
  session_start();
  $name = $_SESSION['name'];
  $hobby = $_SESSION['email'];
  $gender = $_SESSION['gender'];
function db_conn() { 
$host = 'localhost';          //ホスト名　'127.0.0.1'; 

$db = 'lesson1';              //データベース名 

$db_user = 'root';            //MySQL接続ユーザー名 

$db_pass = '';                //MySQL接続パスワード 

$charset = 'utf8mb4';         //文字コード 

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";   //DSN 



try { 

    $pdo = new PDO($dsn, $db_user, $db_pass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
     $sql = "INSERT INTO user (email, name, gender) VALUE (:email, :name, :gender)"; 
      $stmt =$pdo ->prepare($sql);
   $stmt->bindValue(':email',  $_SESSION['email'], PDO::PARAM_STR); 
    $stmt->bindValue(':name', $_SESSION['name'], PDO::PARAM_STR); 
    $stmt->bindValue(':gender',$_SESSION['gender'], PDO::PARAM_STR); 

    $stmt->execute(); 

    
} catch (PDOException $e) { 

   echo $e->getMessage(); 
 die();

} 
   
}
db_conn();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>完了画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
       <div>
            <h1>完了画面</h1>
       </div>
    </header>
</div>
<hr>
<p>名前は <?php echo $name;?> さん</p>
<p>メールアドレスは <?php echo $hobby;?> </p>

<p>性別は <?php if( $gender === "1" ){ echo '男性'; }
		elseif( $gender === "2" ){ echo '女性'; }
		elseif( $gender === "9" ){ echo 'その他'; }
?> </p>
<p>以上の内容で登録しました。</p>
<form action="index.html" method="POST">
<div class="button-wrapper">
	<button type="submit" class="btn btn--naby btn--shadow">TOPに戻る</button>
</div>
</form>
<hr>
<div class="container">
    <footer>
        <p>CCC.</p>
    </footer>
</div>
</body>
</html>