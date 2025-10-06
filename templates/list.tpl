{* templates/list.tpl *}
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/list.css">
    <title>姓名一覧</title>
</head>
<body>
    <h1>保存された姓名一覧</h1>

    <h2>男性</h2>
    {if $results_male|@count > 0}
        <table class="list-table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>読み方</th>
                    <th>天格</th>
                    <th>人格(性格運)</th>
                    <th>地格(家庭運/健康運)</th>
                    <th>外格(対人運/結婚運)</th>
                    <th>総格(全般運)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach $results_male as $row}
                    <tr>
                        <td>{$row.name}</td>
                        <td>{$row.furigana}</td>
                        {foreach ["tenkaku","jingaku","chikaku","gaikaku","soukaku"] as $k}
                            {assign var="key" value=$k|cat:"_result"}
                            {assign var="result" value=$row[$key]}
                            {assign var="count" value=$row[$k]}
                            {assign var="class" value=(
                                $result == '最大吉' ? 'result-max' :
                                ($result == '大吉' ? 'result-great' :
                                ($result == '吉' ? 'result-good' : 'result-other'))
                            )}
                            <td class="{$class}">{$result}（{$count}画）</td>
                        {/foreach}
                        <td>
                            <form method="post" action="/delete" style="display:inline;">
                                <input type="hidden" name="id" value="{$row.id}">
                                <input type="submit" value="削除" onclick="return confirm('本当に削除しますか？');">
                            </form>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p>男性のデータはありません。</p>
    {/if}

    <h2>女性</h2>
    {if $results_female|@count > 0}
        <table class="list-table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>読み方</th>
                    <th>天格</th>
                    <th>人格(性格運)</th>
                    <th>地格(家庭運/健康運)</th>
                    <th>外格(対人運/結婚運)</th>
                    <th>総格(全般運)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach $results_female as $row} {* ← 修正ポイント *}
                    <tr>
                        <td>{$row.name}</td>
                        <td>{$row.furigana}</td>
                        {foreach ["tenkaku","jingaku","chikaku","gaikaku","soukaku"] as $k}
                            {assign var="key" value=$k|cat:"_result"}
                            {assign var="result" value=$row[$key]}
                            {assign var="count" value=$row[$k]}
                            {assign var="class" value=(
                                $result == '最大吉' ? 'result-max' :
                                ($result == '大吉' ? 'result-great' :
                                ($result == '吉' ? 'result-good' : 'result-other'))
                            )}
                            <td class="{$class}">{$result}（{$count}画）</td>
                        {/foreach}
                        <td>
                            <form method="post" action="/delete" style="display:inline;">
                                <input type="hidden" name="id" value="{$row.id}">
                                <input type="submit" value="削除" onclick="return confirm('本当に削除しますか？');">
                            </form>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p>女性のデータはありません。</p>
    {/if}

    <br>
    <a href="/index">トップに戻る</a>
</body>
</html>
