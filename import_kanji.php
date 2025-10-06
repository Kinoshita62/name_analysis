<?php
require_once __DIR__ . '/php/db.php';

$xmlFile = __DIR__ . '/kanjidic2.xml';
if (!file_exists($xmlFile)) {
    die("XMLファイルが見つかりません: $xmlFile");
}

// XMLを読み込み
$xml = simplexml_load_file($xmlFile);

$count = 0;
foreach ($xml->character as $char) {
    $kanji = (string) $char->literal;
    $stroke = (int) $char->misc->stroke_count[0];

    // 音訓を抽出
    $onyomiArr = [];
    $kunyomiArr = [];
    if (isset($char->reading_meaning->rmgroup->reading)) {
        foreach ($char->reading_meaning->rmgroup->reading as $reading) {
            $type = (string) $reading['r_type'];
            if ($type === 'ja_on') {
                $onyomiArr[] = (string) $reading;
            } elseif ($type === 'ja_kun') {
                $kunyomiArr[] = (string) $reading;
            }
        }
    }

    $onyomi = implode(',', $onyomiArr);
    $kunyomi = implode(',', $kunyomiArr);

    // DB保存（meanings 削除済み）
    $stmt = $pdo->prepare("
        INSERT INTO kanji_data (kanji, stroke_count, onyomi, kunyomi)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$kanji, $stroke, $onyomi, $kunyomi]);

    $count++;
}
echo "インポート完了: {$count} 件登録しました\n";
