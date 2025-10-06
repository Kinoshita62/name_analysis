<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/two_column.css">
    <title>姓名判断</title>
</head>
<body>
    <h1>姓名判断</h1>

    <div class="container">
        <!-- 左カラム：補助機能 -->
        <div class="sidebar">
            <a href="/list" class="button-link sidebar-button">姓名一覧</a>

            <h2>漢字検索</h2>
            <form method="get" action="/search">
                <label>画数：</label>
                <input type="text" 
       name="stroke_count" 
       inputmode="numeric" 
       pattern="[0-9]*" 
       min="1" step="1" 
       oninput="if(this.value !== '' && this.value < 1) this.value = '';"><br><br>

                <label>読み仮名：</label>
                <input type="text" name="reading"><br><br>

                <input type="submit" value="検索する" class="sidebar-button">
            </form>
        </div>

        <!-- 中央カラム：メイン診断 -->
        <div class="main-form">
            <form method="post" action="/result">
                <label>名前：</label>
                <input type="text" name="name" required><br><br>

                <label>性別：</label>
                <select name="gender" required>
                    <option value="male">男性</option>
                    <option value="female">女性</option>
                </select><br><br>

                <input type="submit" value="診断する">
            </form>
        </div>
    </div>
</body>
</html>
