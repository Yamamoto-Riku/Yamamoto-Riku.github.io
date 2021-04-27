<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>入力フォーム</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/light.min.css">
    </head>
    <body>
<hr><h3>日報入力画面</h3><hr>
        <?php
        require_once 'MYDB.php';
        $pdo = db_connect();
        if (empty($_POST) || empty($_POST['name']) || empty($_POST['nai'])) {
            ?>
            <form method="post" action="insert.php">
                <label>名前</label>
                <input type="text" name="name">
<br>
                <label>授業内容</label>
                <textarea name="nai"></textarea><br>
                <label>感想</label>
                <textarea name="kan"></textarea><br>
                <br>
                <input type="submit" value="送信">
            </form>
            <?php
        } elseif (!empty($_POST['name']) && !empty($_POST['nai'])) {
            try{
            if (empty($_POST['kan'])) {
                $sql = "insert into date(name,nai,data) values( :name,:nai,now())";
                $stmh = $pdo->prepare($sql);
                $stmh->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
                $stmh->bindValue(":nai", $_POST['nai'], PDO::PARAM_STR);
            } else {
                $sql = "insert into date(name,nai,kan,data) values(:name,:nai,:kan,now())";
                $stmh = $pdo->prepare($sql);
                $stmh->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
                $stmh->bindValue(":kan", $_POST['kan'], PDO::PARAM_STR);
                $stmh->bindValue(":nai", $_POST['nai'], PDO::PARAM_STR);
            }
            $stmh->execute();
            print "送信完了";
            
            } catch (PDOException $ex){
                print "エラー:".$ex->getMessage();
            }
?>
<form action="index.php">
<input type="submit" value="トップへ">
</form>
<?php
        }
        ?>
    </body>
</html>