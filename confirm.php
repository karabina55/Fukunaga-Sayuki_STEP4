<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<p>データが送信されていません。</p>';
    exit;
}

$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$message = $_POST['message'] ?? '';
$gender = $_POST['gender'] ?? '';

$errors = [];

/* 名前チェック */
$min = 1; $max = 50;
$len = mb_strlen($name, 'UTF-8');
if ($len < $min || $len > $max) {
    $errors[] = "名前は{$min}〜{$max}文字で入力してください。";
} else {
    $pattern = '/^[\p{Hiragana}\p{Katakana}\p{Han}\p{Latin}\p{Zs}]+$/u';
    if (!preg_match($pattern, $name)) {
        $errors[] = '名前はひらがな、カタカナ、漢字、英字、半角数字、ハイフンのみ使用できます。';
    }
}

/* 年齢・電話・メールチェック */
if (!filter_var($age, FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 0, 'max_range' => 150]
]) && $age !== '0') {
    $errors[] = '年齢は0~150の間で入力してください。';
}
if ($phone !== '' && !preg_match('/^[\d-]+$/', $phone)) {
    $errors[] = '電話番号は半角数字とハイフンのみ使用できます。';
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = '正しいメールアドレスの形式が正しくありません。';
}

$pattern = '/^[\p{Hiragana}\p{Katakana}\p{Han}\p{Latin}\p{Zs}]+$/u';
$address = $_POST['address'] ?? '';
if (!preg_match($pattern, $address)) {
    $errors[] = '住所はひらがな、カタカナ、漢字、英字、半角数字、ハイフンのみ使用できます。';
}

/* エラーがあれば表示して戻す */
if (!empty($errors)) {
    echo '<h1>入力エラー</h1><ul style="color:red">';
    foreach ($errors as $e) {
        echo '<li>' . htmlspecialchars($e, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ul>';
    echo '<p><a href="javascript:history.back()">戻る</a></p>';
    exit;
}

/* 問題なければ表示 */
?>
<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><title>確認</title></head>
<body>
    <h1>入力内容確認</h1>
    <p>名前: <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
    <p>年齢: <?= htmlspecialchars($age, ENT_QUOTES, 'UTF-8') ?></p>
    <p>電話番号: <?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?></p>
    <p>メールアドレス: <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
    <p>住所: <?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?></p>
    <p>質問: <?= nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) ?></p>
    <p>性別: <?= htmlspecialchars($gender, ENT_QUOTES, 'UTF-8') ?></p>
</body>
</html>