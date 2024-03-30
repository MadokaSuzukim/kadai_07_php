<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート</title>
    <link rel="stylesheet" href="index.css">
    <style>
        /* フォント */
body {
    font-family: Arial, sans-serif;
}

/* レイアウト */
form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
header {
    text-align: center; /* ヘッダー内のテキストを中央揃えに */
    width: 100%; /* ヘッダーの幅を画面幅全体に */
    padding: 20px 0; /* 上下にパディングを追加 */
    width: 50%; /* ヘッダーの幅を画面の50%に設定 */
    margin: 0 auto; /* 上下のマージンを0、左右のマージンを自動にして中央揃え */
  }

h2 {
    text-align: center; /* テキストを中央揃えにする */
    background-color: rgb(107, 198, 234); /* 背景色を青色にする */
}

 
/* 入力フィールドのスタイル */
input[type="text"],
input[type="email"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* チェックボックスとラジオボタン */
input[type="checkbox"],
input[type="radio"] {
    margin-right: 5px;
}

/* 送信ボタン */
button[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* レスポンシブデザイン */
/* 600pxより小さいデバイス */
@media (max-width: 600px) {
    form {
        padding: 10px;
    }

    input[type="text"],
    input[type="email"],
    textarea,
    select {
        font-size: 14px;
    }
}

/* 768pxより小さいデバイス */
@media (max-width: 768px) {
    form {
        max-width: 500px;
    }
}

/* 992pxより小さいデバイス */
@media (max-width: 992px) {
    form {
        max-width: 700px;
    }
}

/* 1200pxより小さいデバイス */
@media (max-width: 1200px) {
    form {
        max-width: 900px;
    }
}

    </style>
</head>
<body>
    <header>
        <div class="header-content">MARUMARUK使用アンケート</div>
    </header>
    <form action="submit_survey.php" method="post" onsubmit="return validateForm()">
    <!-- フォームの内容 -->
</form>
<script>
function validateForm() {
    // 必須のラジオボタンが選択されているかチェックする例
    var moreRecords = document.querySelector('input[name="more_records"]:checked');
    if (!moreRecords) {
        alert("「1日の回数上限がありましたが、それ以上に記録が残ったほうが良いか？」を選択してください。");
        return false; // 送信を防ぐ
    }
    
    // 他の入力フィールドや選択肢の検証を追加...

    // すべての検証が通った場合は送信を許可
    return true;
}
</script>

<form action="submit_survey.php" method="post">
    <p>セルフコーチングツールMARUMARK（マルマーク）をご登録いただきまして、誠にありがとうございます。</p>
    <p>現在β版としてリリースしており、皆様のアンケート結果を元にブラッシュアップをしていきたいと考えております。</p>
    <p>アンケートにお答えいただけますと幸いです</p>
    <p>所要時間は5分となります。</p>
    <!-- 質問１-->
    <!-- // 使用感に関する質問 -->
    <h2>ご利用についての質問</h2>
    <p>このツールをどの程度の頻度で使用していますか？</p>
    <select name="frequency">
        <option value="daily">毎日</option>
        <option value="weekly">週に5,6回</option>
        <option value="monthly">週に3,4回</option>
        <option value="monthly">週に1,2回</option>
        <option value="rarely">ほとんど使用しない</option>
    </select>
    <!-- 質問２ -->
    <!-- ラジオボタン -->
    <p>1日の回数上限がありましたが、それ以上に記録が残ったほうが良いか？</p>
    <input type="radio" name="more_records" value="yes" required> はい
    <input type="radio" name="more_records" value="no" required> いいえ
    <input type="radio" name="more_records" value="yes"> はい
    <input type="radio" name="more_records" value="no"> いいえ

    <!-- 質問３ -->
    <!-- チェックボックス -->
    <p>チェックをする時間帯（複数選択可）</p>
    <input type="checkbox" name="check_times[]" value="morning"> 起床時
    <input type="checkbox" name="check_times[]" value="before_work"> 終業前
    <input type="checkbox" name="check_times[]" value="after_work"> 終業後
    <input type="checkbox" name="check_times[]" value="before_bed"> 就寝前

    <!-- 自己評価機能に関する質問 -->
    <h2>自己評価機能に関する質問</h2>
    <p>自己評価を行うことで、あなたのメンタルヘルスについての理解は深まりましたか？</p>
    <input type="radio" name="self_evaluation_improvement" value="yes"required> はい
    <input type="radio" name="self_evaluation_improvement" value="no"required> いいえ

    <p>自己評価を記録することによって、あなたの自己認識に変化はありましたか？</p>
    <input type="radio" name="self_recognition_change" value="yes"required> はい
    <input type="radio" name="self_recognition_change" value="no"required> いいえ

    <p>他にどのような機能があったらより自分の心の状態を知ることができますか？</p>
    <textarea name="additional_features"></textarea>

<!-- 通知機能の効果に関する質問 -->
<h2>通知機能の効果に関する質問</h2>
<p>通知を受けた後、あなたの行動に何らかの変化はありましたか？</p>
<input type="radio" name="behavior_change_after_notification" value="yes"required> はい
<input type="radio" name="behavior_change_after_notification" value="no"required> いいえ

<p>通知内容はあなたの現在の心の状態を適切に反映していましたか？</p>
<input type="radio" name="notification_reflect_current_state" value="yes"required> はい
<input type="radio" name="notification_reflect_current_state" value="no"required> いいえ

<p>1日の終わりに通知があったら嬉しいですか？</p>
<input type="radio" name="end_of_day_notification" value="yes"required> はい
<input type="radio" name="end_of_day_notification" value="no"required> いいえ

<!-- 行動観察と自己分析に関する質問 -->
<h2>行動観察と自己分析に関する質問</h2>
<p>このツールを使用している間に、あなたの行動や反応について何か新しい発見はありましたか？</p>
<input type="radio" name="behavior_observation_insights" value="yes"required> はい
<input type="radio" name="behavior_observation_insights" value="no"required> いいえ

<p>自己分析を通じて、あなたのメンタルヘルス管理に役立つ具体的な行動変更はありましたか？</p>
<input type="radio" name="actionable_changes" value="yes"required> はい
<input type="radio" name="actionable_changes" value="no"required> いいえ

<!-- プライバシーとデータ管理に関する質問 -->
<h2>プライバシーとデータ管理に関する質問</h2>
<p>このツールのプライバシーポリシーについてどの程度理解していますか？</p>
<input type="radio" name="privacy_policy_understanding" value="yes"required> はい
<input type="radio" name="privacy_policy_understanding" value="no"required> いいえ

<p>個人情報の取り扱いに関して不安を感じたことはありますか？</p>
<input type="radio" name="data_handling_concerns" value="yes"required> はい
<input type="radio" name="data_handling_concerns" value="no"required> いいえ

<!-- 教育的なコンテンツの必要性について -->
<h2>教育的なコンテンツの必要性について</h2>
<p>もっと情報を含んだものだと良いと感じましたか？</p>
<input type="radio" name="need_for_educational_content" value="yes"required> はい
<input type="radio" name="need_for_educational_content" value="no"required> いいえ

<p>心理学的な知見やメンタルヘルスに関する情報はあったらいいと感じましたか？</p>
<input type="radio" name="mental_health_info_desire" value="yes"required> はい
<input type="radio" name="mental_health_info_desire" value="no"required> いいえ

<!-- SOS機能の有効性に関する質問 -->
<h2>SOS機能の有効性に関する質問</h2>
<p>心の調子が低い時、メールリンクを受け取りましたか？</p>
<input type="radio" name="mail_link_received" value="yes"> はい
<input type="radio" name="mail_link_received" value="no"> いいえ
<!-- <input type="radio" name="mail_link_received" value="not_applicable"> 低い時がなかった -->

<p>受け取った方は、どうしてリンクをクリックしなかったのか。</p>
<input type="radio" name="reason_for_not_clicking_link" value="too_troublesome"> 面倒だった
<input type="radio" name="reason_for_not_clicking_link" value="not_severe_enough"> そこまでの状態ではないと思った
<input type="radio" name="reason_for_not_clicking_link" value="other"> その他
<!-- （理由を記載してください）：<input type="text" name="reason_for_not_clicking_link_other"> -->

<p>メールではなく、チャットだったら敷居は低くなりますか？</p>
<input type="radio" name="preference_for_chat_over_mail" value="yes"required> はい
<input type="radio" name="preference_for_chat_over_mail" value="no"required> いいえ

<p>ユーザーが通知に対するフィードバックを提供できる機能について：ある条件の時にコメントができたら良いと感じますか？</p>
<input type="radio" name="feedback_provision_condition" value="yes"required> はい
<input type="radio" name="feedback_provision_condition" value="no"required> いいえ

<!-- ツールの全体的な満足度に関する質問 -->
<h2>ツールの全体的な満足度に関する質問</h2>
<p>このツールを他の人に推薦したいと思いますか？</p>
<input type="radio" name="recommendation_likelihood" value="yes"required> はい
<input type="radio" name="recommendation_likelihood" value="no"required> いいえ

<p>引き続き利用してみたいか？</p>
<input type="radio" name="continued_usage_desire" value="yes"> はい
<input type="radio" name="continued_usage_desire" value="no"> いいえ
<!-- <input type="radio" name="continued_usage_desire" value="if_improved"> 改善されたらしたい -->

<!-- 質問 -->
<p>ツールの使用感はいかがですか？（使いやすさ、インターフェイスの理解しやすさなど）</p>
<textarea name="usability"></textarea>

<p>このツールの改善点について具体的な提案はありますか？</p>
<textarea name="improvement_suggestions"></textarea>

<p>利用しにくい理由は何ですか？</p>
<textarea name="difficulty_reasons"></textarea>

<p>会社のシステムと連動していたら取り組みやすいか？</p>
<input type="radio" name="integration_ease" value="yes"required> はい
<input type="radio" name="integration_ease" value="no"required> いいえ

<p>もし心の調子を周りと共有できる機能があれば利用したいですか？</p>
<input type="radio" name="desire_for_sharing_feature" value="yes"required> はい
<input type="radio" name="desire_for_sharing_feature" value="no"required> いいえ

<p>特定の人にだけ共有できてしんどさを伝えられる機能があれば利用したいですか？</p>
<input type="radio" name="desire_for_specific_sharing_option" value="yes"required> はい
<input type="radio" name="desire_for_specific_sharing_option" value="no"required> いいえ

<!-- メールアドレス（匿名追跡用） -->
<p>メールアドレス（回答の追跡用、他の目的には使用しません）:</p>
<input type="email" name="email"required>
<p>最後までご回答いただき、誠にありがとうございました。</p>
<button type="submit">送信</button>
</form>
</body>
</html>
