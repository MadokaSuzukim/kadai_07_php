<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート結果</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 50%;  /* グラフの幅 */
            max-width: 400px; /* 最大幅を設定 */
            height: auto; /* 高さは自動調整 */
            margin: auto; /* 中央揃え */
        }
        canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
<body>
    <h2>アンケート結果の要約</h2>
    <p>本アンケートでは、合計200人の回答者からのデータを収集しました。大多数の回答者が新しい機能の追加を望んでおり、特に「通知後の行動変化」に対する強い関心が見られました。</p>
    <p>以下のテーブルでは、各質問に対する具体的な回答の概要を示しています。</p>

    <h2>注目すべきポイント</h2>
    <ul>
        <li>95%の回答者が「メンタルヘルス情報の欲求」に「はい」と回答しました。</li>
        <li>「データ取り扱いへの懸念」については、回答者の半数以上が懸念を表明しています。</li>
    </ul>
    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['継続して利用したい', '改善したら利用したい'],
                datasets: [{
                    label: 'アンケート結果',
                    data: [60, 40], // 例: はいが60%, いいえが40%
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>
    <script>
// PHPから受け取ったデータを使用
var dataCounts = <?php echo $jsonData; ?>;

// ラベルとデータ値を抽出
var labels = Object.keys(dataCounts);
var data = labels.map(label => dataCounts[label]);

// Chart.jsで円グラフを描画
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
    }
});
</script>

   
</body>
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
echo "<tr><th>check_times</th><th>frequency</th><th>more_record</th><th>check_times[]</th><th>sself_evaluation_improvement</th><th>self_recognition_change</th><th>additional_features</th><th>behavior_change_after_notification</th><th>notification_reflect_current_state</th><th>end_of_day_notification</th><th>behavior_observation_insights</th><th>actionable_changes</th><th>privacy_policy_understanding</th><th>data_handling_concerns</th><th>need_for_educational_content</th><th>mental_health_info_desire</th><th>
mail_link_received</th><th>
reason_for_not_clicking_link</th><th>
preference_for_chat_over_mail</th><th>
feedback_provision_condition</th><th>
recommendation_likelihood</th><th>
continued_usage_desire</th><th>
usability</th><th>
improvement_suggestions</th><th>
difficulty_reasons</th><th>
integration_ease</th><th>
desire_for_sharing_feature</th><th>
desire_for_specific_sharing_option</th><th>
email</th></tr>"; // メールアドレスは最後に記録"

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


// CSVファイルを開く
$filePath = "survey_responses.csv";
$file = fopen("survey_responses.csv", "r");

// 回答のカウントを保持する配列
$answerCounts = [
    "はい" => 0,
    "いいえ" => 0
];

// CSVファイルを1行ずつ読み込む
while (($row = fgetcsv($file)) !== FALSE) {
    // ここで$rowにはCSVの1行が配列として格納されています
    // 例えば、回答が2列目にあると仮定すると$row[1]でアクセスできます
    // 回答に応じてカウントを増やします
    if (isset($answerCounts[$row[1]])) {
        $answerCounts[$row[1]]++;
    }
}

// ファイルを閉じる
fclose($file);




// JavaScriptで利用できるようにデータをJSON形式でエンコード
$jsonData = json_encode($answerCounts);


// Pythonスクリプトを実行し、出力を$chartOutputに格納
$chartOutput = shell_exec('python data_analysis.py');

// 出力をウェブページに表示
echo $chartOutput;


$file = fopen("survey_responses.csv", "r");
$dataCounts = []; // 各分類のカウントを保持する連想配列

// ファイルを1行ずつ読み込み
while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
    // 例えば$data[1]が分類データを含む列だとする
    $category = $data[1]; // 分類名を取得
    if (!isset($dataCounts[$category])) {
        $dataCounts[$category] = 0;
    }
    $dataCounts[$category]++;
}
fclose($file);

// JavaScriptで使用できるようにデータをJSON形式で出力する準備
$jsonData = json_encode($dataCounts);
echo "Hello World";
?>

</body>
</html>

