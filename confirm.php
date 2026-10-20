<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$message = $_POST['message'] ?? '';
$gender = $_POST['gender'] ?? '';

$errors = [];
$isPost = ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';

/* 名前チェック */
 $pattern = '/^[\p{Hiragana}\p{Katakana}\p{Han}\p{Latin}]+$/u';
 if (!preg_match($pattern, $name)) {
            $errors[] = '名前はひらがな、カタカナ、漢字、英字、のみ使用できます。';
        }
//年齢
if ($age !== '') {
if (!filter_var($age, FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 0, 'max_range' => 150]
]) && $age !== '0') {
    $errors[] = '年齢は0から150の間で入力してください。';
}}

//電話
if ($phone !== '' && !preg_match('/^[0-9\-]+$/', $phone)) {
    $errors[] = '電話番号は半角数字とハイフンのみ使用できます。';
}

//メール
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'メールアドレスの形式が正しくありません。';
}

//住所
$pattern = '/^[\p{Hiragana}\p{Katakana}\p{Han}\p{Latin}\0-9\-]+$/u';
$address = $_POST['address'] ?? '';
if (!preg_match($pattern, $address)) {
    $errors[] = '住所はひらがな、カタカナ、漢字、英字、半角数字、ハイフンのみ使用できます。';
}
?>

//htmlの表示

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

//POSTじゃない場合
<?php
if (!$isPost) :
?>
    <h1>データが送信されていません。</h1>
        <p>フォームから送信してください。<br>
        <a href="form.php">フォームへ戻る</a>
        </p>

<?php
elseif (!empty($errors)) :
?>
        <h1>入力エラー</h1>
        <div class="errors">
            <p>以下の項目をご確認ください：</p>
            <ul>
<?php foreach ($errors as $e) : ?>
                <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
            </ul>
            <p><a href="javascript:history.back()">フォームに戻る</a></p>
        </div>

//POSTの場合
<?php
else :
?>
    <h1>入力内容確認</h1>
        <p>名前: <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
        <p>年齢: <?= htmlspecialchars($age, ENT_QUOTES, 'UTF-8') ?></p>
        <p>電話番号: <?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?></p>
        <p>メールアドレス: <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
        <p>住所: <?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?></p>
        <p>質問: <?= nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) ?></p>
        <p>性別: <?= htmlspecialchars($gender, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

</body>
</html>