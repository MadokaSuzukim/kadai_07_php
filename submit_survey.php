<!--  POSTデータの受け取り -->
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// フォームからのデータ受け取り
// 使用感に関する質問
$frequency    = $_POST['frequency'] ?? '未回答';
$more_records = $_POST['more_records'] ?? '未回答';
$check_times  = isset($_POST['check_times']) ? implode(', ', $_POST['check_times']) : '未回答';
// $desired_records = $_POST['desired_records'] ?? '未回答'; // 「その場合、１日何回を希望するか？」の回答

// <!-- 自己評価機能に関する質問 -->
$self_evaluation_improvement = $_POST['self_evaluation_improvement'] ?? '未回答'; // 自己評価機能に関する質問
$self_recognition_change = $_POST['self_recognition_change'] ?? '未回答';

// 通知機能の効果に関する質問
$behavior_change_after_notification = $_POST['behavior_change_after_notification'] ?? '未回答'; // 通知機能の効果に関する質問
$notification_reflect_current_state = $_POST['notification_reflect_current_state'] ?? '未回答';
$end_of_day_notification = $_POST['end_of_day_notification'] ?? '未回答';

// 行動観察と自己分析に関する質問
$behavior_observation_insights = $_POST['behavior_observation_insights'] ?? '未回答'; // 行動観察と自己分析に関する質問
$actionable_changes = $_POST['actionable_changes'] ?? '未回答';

// プライバシーとデータ管理に関する質問
$privacy_policy_understanding = $_POST['privacy_policy_understanding'] ?? '未回答'; // プライバシーとデータ管理に関する質問
$data_handling_concerns = $_POST['data_handling_concerns'] ?? '未回答';

// 教育的なコンテンツの必要性について
$need_for_educational_content = $_POST['need_for_educational_content'] ?? '未回答'; // 教育的なコンテンツの必要性について
$mental_health_info_desire = $_POST['mental_health_info_desire'] ?? '未回答';

// SOS機能の有効性に関する質問
// $sos_function_effectiveness = $_POST['sos_function_effectiveness'] ?? '未回答'; // SOS機能の有効性に関する質問
$mail_link_received = $_POST['mail_link_received'] ?? '未回答';
$reason_for_not_clicking_link = $_POST['reason_for_not_clicking_link'] ?? '未回答';
$preference_for_chat_over_mail = $_POST['preference_for_chat_over_mail'] ?? '未回答';
$feedback_provision_condition = $_POST['feedback_provision_condition'] ?? '未回答';

// 全体的な満足度に関する質問
$recommendation_likelihood = $_POST['recommendation_likelihood'] ?? '未回答';
$continued_usage_desire = $_POST['continued_usage_desire'] ?? '未回答';
$additional_features = $_POST['additional_features'] ?? '未回答';
$usability = $_POST['usability'] ?? '未回答';
$improvement_suggestions = $_POST['improvement_suggestions'] ?? '未回答';
$difficulty_reasons = $_POST['difficulty_reasons'] ?? '未回答';
$integration_ease = $_POST['integration_ease'] ?? '未回答';
$desire_for_sharing_feature = $_POST['desire_for_sharing_feature'] ?? '未回答';
$desire_for_specific_sharing_option = $_POST['desire_for_specific_sharing_option'] ?? '未回答';
$email = $_POST['email'] ?? '未回答';

// CSVファイルのパス
$filePath = 'survey_responses.csv';
// ファイルを開く（ファイルが存在しない場合は作成される）
$file = fopen($filePath, 'a');
// ファイルオープンに失敗した場合の処理
if (!$file) {
    die("ファイルを開けませんでした。");
}

// CSVに書き込むデータの配列
$data = [
    date('Y-m-d H:i:s'), // 現在の日時を追加
    $frequency,
    $check_times,
    $more_records,
    $self_evaluation_improvement,
    $self_recognition_change,
    $behavior_change_after_notification,
    $notification_reflect_current_state,
    $end_of_day_notification,
    $behavior_observation_insights,
    $actionable_changes,
    $privacy_policy_understanding,
    $data_handling_concerns,
    $need_for_educational_content,
    $mental_health_info_desire,
    $mail_link_received,
    $reason_for_not_clicking_link,
    $preference_for_chat_over_mail,
    $feedback_provision_condition,
    $recommendation_likelihood,
    $continued_usage_desire,
    $additional_features,
    $usability,
    $improvement_suggestions,
    $integration_ease,
    $desire_for_sharing_feature,
    $desire_for_specific_sharing_option,
    $email // メールアドレスは最後に記録
];
// CSVファイルへのデータ書き込み
fputcsv($file, $data);
// ファイルを閉じる
fclose($file);

echo "アンケートの回答をありがとうございます。";
 // データを出力 -->
echo "<pre>";
print_r($data);
echo "</pre>";


header("Location: thanks.html");
exit;



?>