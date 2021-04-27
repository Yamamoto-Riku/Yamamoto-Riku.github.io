<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>出力フォーム</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/light.min.css">
    </head>
    <body>
<hr><h3>日報一覧表示</h3><hr>
        <?php
        require_once 'MYDB.php';
        $pdo = db_connect();
        try {
            $sql = "select * from date";
            $stmh = $pdo->prepare($sql);
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る

            $data = [];
            if ($count >= 1) {
                $html = "<table border='1'><tr><td>名前</td><td>授業内容</td><td>感想</td><td>日付</td></tr>";
                while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                    $html .= "<tr><td>".$row['name']."</td>";
                    $html .= "<td>".$row['nai']."</td>";
                    $html .= "<td>".$row['kan']."</td>";
                    $html .= "<td>".$row['data']."</td></tr>";
                }
                $html .= "</table>";
            } else {
                $html = "1件もデータがありません";
            }
            print $html;
        } catch (PDOException $ex) {
            print "エラー:" . $ex->getMessage();
        }
        ?>
<form action="index.php">
<input type="submit" value="トップへ">
</form>
    </body>
</html>