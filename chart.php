<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// フォームデータがPOSTリクエストで送信されたかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームデータを処理し、必要なデータを取得するコード
    // 以下にフォームデータを処理するコードを追加
    // グラフのデータを生成するコード
    $graphData = array(
        // グラフデータの内容を記述
    );

    // グラフデータをJSON形式に変換してクライアントに返す
    header('Content-Type: application/json');
    echo json_encode($graphData);
} else {
    // POSTリクエストでない場合はエラーメッセージを返す
    http_response_code(405); // HTTP 405 Method Not Allowed
    echo "HTTP Error 405: Method Not Allowed";
}

// CSVファイルからデータを読み込む
$filePath = 'survey_responses.csv';
$lines = file($filePath, FILE_IGNORE_NEW_LINES); // ファイルの各行を配列として読み込む

// 各質問項目のラベル
$labels = [
    'frequency',
    'more_records',
    'check_times',
    'self_evaluation_improvement',
    'self_recognition_change',
    'additional_features',
    'behavior_change_after_notification',
    'notification_reflect_current_state',
    'end_of_day_notification',
    'behavior_observation_insights',
    'actionable_changes',
    'privacy_policy_understanding',
    'data_handling_concerns',
    'need_for_educational_content',
    'mental_health_info_desire',
    'mail_link_received',
    'reason_for_not_clicking_link',
    'preference_for_chat_over_mail',
    'feedback_provision_condition',
    'recommendation_likelihood',
    'continued_usage_desire',
    'usability',
    'improvement_suggestions',
    'difficulty_reasons',
    'integration_ease',
    'desire_for_sharing_feature',
    'desire_for_specific_sharing_option'
];

// 各質問項目の回答を数えるための連想配列を初期化
$counts = array_fill_keys($labels, []);

// 各質問項目の回答を集計
foreach ($lines as $line) {
    $data = str_getcsv($line);
    for ($i = 1; $i < count($data) - 1; $i++) { // メールアドレス以外のデータを処理
        $response = $data[$i];
        if (!isset($counts[$labels[$i - 1]][$response])) {
            $counts[$labels[$i - 1]][$response] = 0;
        }
        $counts[$labels[$i - 1]][$response]++;
    }
}

// グラフ用のデータを初期化
$graphData = [];

// 各質問項目の回答の割合を計算
foreach ($counts as $label => $responses) {
    $totalResponses = array_sum($responses);
    $graphData[$label] = [];
    foreach ($responses as $response => $count) {
        $percentage = round(($count / $totalResponses) * 100, 2); // 割合を計算して小数点以下2桁に丸める
        $graphData[$label][$response] = $percentage;
    }
}

// グラフデータをJSON形式に変換
$graphJson = json_encode($graphData);

// ここでアンケートデータを処理して、$graphDataにJSON形式で格納する
// 例:
// $graphData = json_encode($processedData); // $processedDataはアンケートデータを適切に処理した結果の変数

// JSON形式のデータを出力
header('Content-Type: application/json');
echo $graphJson;
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
    <!-- グラフを表示するCanvas要素 -->
    <canvas id="myChart" width="400" height="400"></canvas>

    <!-- フォーム -->
    <!-- <form action="chart.php" method="post"> -->
        <!-- ここにフォームの内容を記述 -->
        <h1>アンケート結果</h1>
        <?php
// エラー表示を有効にします（開発中のみ推奨）
ini_set('display_errors', 1);
error_reporting(E_ALL);

// CSVファイルを開きます
$file = fopen("data.csv", "r");

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

        <button type="submit">グラフを表示</button>
    </form>

    <script>
        // chart_data.phpからJSONデータを取得
        fetch('chart.php')
            .then(response => response.json())
            .then(graphData => {
                // グラフを描画する処理
                var chartData = {};
                Object.keys(graphData).forEach(function(question) {
                    chartData[question] = [];
                    Object.keys(graphData[question]).forEach(function(response) {
                        chartData[question].push({
                            label: response,
                            data: graphData[question][response],
                            backgroundColor: getRandomColor(), // 色をランダムに設定
                        });
                    });
                });

                // グラフを描画
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        datasets: chartData, // 初めに表示する質問の回答を設定
                    },
                    options: {
                        responsive: true,
                    }
                });

                // ランダムな色を生成する関数
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>
