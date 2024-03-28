<?php
// エラー表示を有効にします（開発中のみ推奨）
ini_set('display_errors', 1);
error_reporting(E_ALL);

// CSVファイルを開きます
$file = fopen("survey_responses.csv", "r");

// ファイルが正しく開かれたかを確認
if ($file === false) {
    die("ファイルを開けませんでした。");
}

// データをHTMLテーブルとして表示する準備
echo "<table border='1'>";
// テーブルのヘッダーを出力
echo "<tr><th>日時</th><th>頻度</th><th>記録増加</th><th>チェック時間</th><th>自己評価の改善</th><th>自己認識の変化</th><th>追加機能</th><th>通知後の行動変化</th><th>通知の現状反映</th><th>一日の終わりの通知</th><th>行動観察の洞察</th><th>行動変化</th><th>プライバシーポリシーの理解</th><th>データ取り扱いへの懸念</th><th>教育コンテンツの必要性</th><th>メンタルヘルス情報の欲求</th><th>メールリンク受信</th><th>リンク未クリックの理由</th><th>メールよりチャットの好み</th><th>フィードバック条件</th><th>推薦意向</th><th>継続使用希望</th><th>使いやすさ</th><th>改善提案</th><th>利用しにくい理由</th><th>システム連携の容易さ</th><th>共有機能の利用希望</th><th>特定共有オプションの利用希望</th><th>Email</th></tr>";

// ファイルを1行ずつ読み込み、HTMLテーブルの行として出力
while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
    echo "<tr>";
    foreach ($data as $cell) {
        echo "<td>" . htmlspecialchars($cell) . "</td>";
    }
    echo "</tr>";
}

// テーブル終了
echo "</table>";

// ファイルを閉じます
fclose($file);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート結果</title>
    <link rel="stylesheet" href="index.css">
    <style>
        /* 全体のコンテナを中央揃えにします */
        h1 {
          text-align: center; /* テキストを中央揃えにする */
          margin: auto; /* 自動的に余白を調整して中央に配置 */
          width: 50%; /* 必要に応じて幅を調整してください */
        }
        
        /* ボタンも中央に揃えたい場合、テキスト揃えだけでは不足する場合があります */
        button {
          display: block; /* ブロック要素として表示 */
          margin: 0 auto; /* 上下のマージンは0、左右のマージンは自動で中央揃え */
        }
      </style>
</head>
<body>
</html>