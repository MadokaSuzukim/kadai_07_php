<?php
 // CSVファイルからデータを読み込む --> 
$rows = array_map('str_getcsv', file($filePath));
$header = array_shift($rows);

// データの加工と集計
$questionCounts = [];
$totalResponses = count($rows);

foreach ($rows as $row) {
    // 各質問の回答を集計
    foreach ($row as $index => $answer) {
        $question = $header[$index];
        if (!isset($questionCounts[$question])) {
            $questionCounts[$question] = [];
        }
        if (!isset($questionCounts[$question][$answer])) {
            $questionCounts[$question][$answer] = 0;
        }
        $questionCounts[$question][$answer]++;
    }
}

// 集計結果の表示
foreach ($questionCounts as $question => $answers) {
    echo "<h3>$question</h3>";
    foreach ($answers as $answer => $count) {
        $percentage = round(($count / $totalResponses) * 100, 2);
        echo "$answer: $count ($percentage%)<br>";
    }
}
?>
