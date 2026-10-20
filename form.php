<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Test4</title>

 <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <header>
        <h1>フォーム入力</h1>
    </header>

    <main class="main-frame">
        <form class="card-form" action="confirm.php" method="POST">
    
                <label for="name">お名前:</label><br>
                <input type="text" id="name" name="name"><br><br>

                <label for="age">年齢:</label><br>
                <input type="text" id="age" name="age"><br><br>

                <label for="phone">電話番号:</label><br>
                <input type="tel" id="phone" name="phone"><br><br>
    
                <label for="email">メールアドレス:</label><br>
                <input type="email" id="email" name="email"><br><br>

                <label for="address">住所:</label><br>
                <input type="text" id="address" name="address"><br><br>
    
                <label for="message">質問:</label><br>
                <textarea type="message" id="message" name="message" rows="4" cols="40"></textarea><br><br>

                <label for="gender">性別:</label><br>
                <div class="select-wrapper">
                <select id="gender" name="gender"class="custom-select" aria-label="性別">
                    <option value="male">男性</option>
                    <option value="female">女性</option>
                </select>
                </div><br><br>

            <div class="actions">
                <button type="submit">送信</button>
            </div>
                

        </form>
    </main>
</body>
</html>

