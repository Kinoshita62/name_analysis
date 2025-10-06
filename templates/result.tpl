<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/result.css">
</head>

<body>
<form method="post" action="/save">

    <h1>判定結果</h1>
    <h2>{$name}</h2>
    {assign var="items" value=[
        "天格" => [$tenkaku_result, $tenkaku],
        "人格(性格運)" => [$jingaku_result, $jingaku],
        "地格(家庭運/健康運)" => [$chikaku_result, $chikaku],
        "外格(対人運/結婚運)" => [$gaikaku_result, $gaikaku],
        "総格(全般運)" => [$soukaku_result, $soukaku]
    ]}
    <table class="table-result">
    {foreach $items as $label => $vals}
        {assign var="result" value=$vals[0]}
        {assign var="count" value=$vals[1]}
        {assign var="class" value=(
            $result == '最大吉' ? 'result-max' :
            ($result == '大吉' ? 'result-great' :
            ($result == '吉' ? 'result-good' : 'result-other'))
        )}
        <tr>
            <th>{$label}</th>
            <td class="{$class}">{$result}（{$count}画）</td>
        </tr>
    {/foreach}
    </table>

    <!-- 隠しフィールド -->
    <input type="hidden" name="name" value="{$name}">
    <input type="hidden" name="gender" value="{$gender}">
    <input type="hidden" name="tenkaku" value="{$tenkaku}">
    <input type="hidden" name="tenkaku_result" value="{$tenkaku_result}">
    <input type="hidden" name="jingaku" value="{$jingaku}">
    <input type="hidden" name="jingaku_result" value="{$jingaku_result}">
    <input type="hidden" name="chikaku" value="{$chikaku}">
    <input type="hidden" name="chikaku_result" value="{$chikaku_result}">
    <input type="hidden" name="gaikaku" value="{$gaikaku}">
    <input type="hidden" name="gaikaku_result" value="{$gaikaku_result}">
    <input type="hidden" name="soukaku" value="{$soukaku}">
    <input type="hidden" name="soukaku_result" value="{$soukaku_result}">

    <br>
    <label>読み方：</label>
    <input type="text" name="furigana" required><br><br>

    <!-- 保存ボタン -->
    <div style="text-align:center; margin-top:20px;">
        <input type="submit" value="保存する">
    </div>
</form>

<!-- フォームの外に配置した「トップに戻る」リンク -->
<div style="text-align:center; margin-top:20px;">
    <a href="/index">トップに戻る</a>
</div>
</body>
</html>
