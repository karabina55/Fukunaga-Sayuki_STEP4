<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <title>TEST4-confirm</title>
</head>

<body>

    <h1>入力内容確認</h1>
<?php    
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $name = $_POST['name'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $message = $_POST['message'];
        $gender = $_POST['gender'];

        $errors = [];
    }
//名前
$min = 1; $max = 50;
$len = mb_strlen($name, 'UTF-8');
if ($len < $min || $len > $max) {
    $errors[] = "名前は{$min}〜{$max}文字で入力してください。";
} else {
    $pattern = '/^[\p{Hiragana}\p{Katakana}\p{Han}\p{Latin}\p{Zs}]+$/u';
    if (!preg_match($pattern, $name)) {
        $errors[] = '名前は「ひらがな・カタカナ・漢字・英字・空白」のみ使用できます。';
    }
}

//年齢
if ($age !== '' && !preg_match('/^\d{1,3}$/', $age)) {
    $errors[] = '年齢は数字で 1〜3 桁で入力してください。';
}
//電話
if ($phone !== '' && !preg_match('/^\d{1,11}$/', $phone)) {
    $errors[] = '電話番号は数字のみ（ハイフン無し）、最大11桁で入力してください。';
}
//メール
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = '正しいメールアドレスを入力してください。';
}

//入力欄が空の場合
if (!empty($errors)) {
    echo '<h1>入力エラー</h1><ul style="color:red">';
    foreach ($errors as $e) {
        echo '<li>' . htmlspecialchars($e, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ul>';
    echo '<p><a href="javascript:history.back()">戻る</a></p>';
    exit;
}

    else{
        echo "<p>名前:" . htmlspecialchars($name,ENT_QUOTES,'UTF-8'). "</p>";
        echo "<p>年齢:{$age}</p>";
        echo "<p>電話番号:{$phone}";
        echo "<p>メールアドレス:{$email}";
        echo "<p>住所:{$address}";
        echo "<P>質問:" . htmlspecialchars($message,ENT_QUOTES,'UTF-8'). "</P>";
        echo "<p>性別:{$gender}</p>";
    }

    else {
        echo "<p>データが送信されていません。</p>";
    }
    ?>
</body>
</html>