<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// エンコーディングとタイムゾーンの設定
header('Content-Type: text/html; charset=UTF-8');

$color = array(
  array('赤', 255, 0, 0),
  array('黄', 255, 255, 0),
  array('緑', 0, 255, 0),
  array('水', 0, 255, 255),
  array('青', 0, 0, 255),
  array('紫', 255, 0, 255),
);

// ファイルが存在しない場合は初期化
if (!file_exists('sample.txt')) {
    file_put_contents('sample.txt', "0\n0\n0\n0\n0\n0\n");
}

$ed = file('sample.txt');
foreach ($ed as &$votes) {
    $votes = rtrim($votes);
}

// 画像表示時の処理
if (isset($_GET['image']) && $_GET['image'] == 'yes') {
    $sum = array_sum($ed);
    $deg = array(270);
    $ad = 0;
    foreach ($ed as $votes) {
        $ad += $votes;
        $deg[] = (int)(($ad / $sum) * 360) + 270;
    }

    $img = imagecreate(200, 200);
    imagecolorallocate($img, 255, 255, 255); // 背景色を白に設定
    foreach ($color as $i => $c) {
        $col = imagecolorallocate($img, $c[1], $c[2], $c[3]);
        imagefilledarc($img, 100, 100, 190, 190, $deg[$i], $deg[$i + 1], $col, IMG_ARC_PIE);
    }
    header("Content-Type: image/png");
    imagepng($img);
    imagedestroy($img);
    exit();
}

// 投票時の処理
if (isset($_POST['submit']) && isset($_POST['cn']) && array_key_exists($_POST['cn'], $color)) {
    $ed[$_POST['cn']]++;
    file_put_contents('sample.txt', implode("\n", $ed));
    // POST/リダイレクト/GETパターンを使用して二重送信を防ぐ
    header('Location: sample.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アンケート</title>
</head>
<body>
<form method="post" action="sample.php">
あなたが好きな色は？<br><br>
<?php
foreach ($color as $i => $c) {
    echo "<input type='radio' name='cn' value='{$i}'>{$c[0]}<br>\n";
}
?>
<br>
<input type="submit" name="submit" value="投票">
</form>
<img src="sample.php?image=yes"><br>
<?php
foreach ($color as $i => $c) {
    echo "{$c[0]} {$ed[$i]} 票<br>\n";
}
?>
</body>
</html>
