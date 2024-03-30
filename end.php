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
<!-- 各質問ごとにグラフを表示するためのコンテナ -->
<div id="chartsContainer"></div>
<script>
var questionAnswers = <?php echo $jsonData?>

Object.keys(questionAnswers).forEach(function(questionIndex) {
    var answers = questionAnswers[questionIndex];

    // グラフを描画するためのcanvas要素を動的に生成
    var canvas = document.createElement('canvas');
    canvas.id = 'chart' + questionIndex;
    document.getElementById('chartsContainer').appendChild(canvas);

    // Chart.jsでグラフを描画
    var ctx = canvas.getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Yes', 'No'],
            datasets: [{
                data: [answers.yes, answers.no],
                backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: '質問 ' + questionIndex + ' の回答分布'
            },
            responsive: true,
        }
    });
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
echo "<tr><th>日時</th><th>頻度</th><th>チェック時間</th><th>記録増加</th><th>自己評価の改善</th><th>自己認識の変化</th><><th>通知後の行動変化</th><th>通知の現状反映</th><th>一日の終わりの通知</th><th>行動観察の洞察</th><th>行動変化</th><th>プライバシーポリシーの理解</th><th>データ取り扱いへの懸念</th><th>教育コンテンツの必要性</th><th>メンタルヘルス情報の欲求</th><th>メールリンク受信</th><th>リンク未クリックの理由</th><th>メールよりチャットの好み</th><th>フィードバック条件</th><th>推薦意向</th><th>継続使用希望</th><th>汎用性</th><th>スタンプ種類</th><th>嬉しいスタンプ</th><th>システム連携の容易さ</th><th>共有機能の利用希望</th><th>特定共有オプションの利用希望</th><th>Email</th></tr>";
echo "<tr><th>check_times</th><th>frequency</th><th>check_times[]</th><th>more_record[]</th><th>sself_evaluation_improvement</th><th>self_recognition_change</th>><th>behavior_change_after_notification</th><th>notification_reflect_current_state</th><th>end_of_day_notification</th><th>behavior_observation_insights</th><th>actionable_changes</th><th>privacy_policy_understanding</th><th>data_handling_concerns</th><th>need_for_educational_content</th><th>mental_health_info_desire</th><th>
mail_link_received</th><th>
reason_for_not_clicking_link</th><th>
preference_for_chat_over_mail</th><th>
feedback_provision_condition</th><th>
recommendation_likelihood</th><th>
continued_usage_desire</th><th>
additional_features</th><th>
usability</th><th>
improvement_suggestions</th><th>
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

$filePath = 'survey_responses.csv';
$file = fopen($filePath, "r");

// 各項目ごとに回答を集計するための多次元配列を用意
// 例: $questionAnswers[質問][回答] = カウント数;
$questionAnswers = [];

while (($row = fgetcsv($file)) !== FALSE) {
    // 例として、3番目の列から質問の回答が始まると仮定
    for ($i = 3; $i < count($row); $i++) {
        // ここで、$iは質問のインデックス、$row[$i]はその質問に対する回答
        if (!isset($questionAnswers[$i])) {
            $questionAnswers[$i] = ['yes' => 0, 'no' => 0];
        }
        if ($row[$i] === 'yes') {
            $questionAnswers[$i]['yes']++;
        } elseif ($row[$i] === 'no') {
            $questionAnswers[$i]['no']++;
        }
    }
}
fclose($file);
// JavaScriptで利用できるようにデータをJSON形式でエンコード
$jsonData = json_encode($questionAnswers);
?>
</body>
</html>

