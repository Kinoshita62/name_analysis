{* templates/sp/list.tpl *}
<html>
<head>
    <meta charset="utf-8">
    <title>姓名一覧（SP）</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/sp/list.css">
</head>
<body>
    <h1>保存された姓名一覧</h1>

    {** ===== 男性 ===== **}
    <h2>男性</h2>
    {if $results_male|@count > 0}
        {foreach $results_male as $row}
            {assign var="pairs" value=[
                "tenkaku" => "天格",
                "jingaku" => "人格",
                "chikaku" => "地格",
                "gaikaku" => "外格",
                "soukaku" => "総格"
            ]}
            <table class="sp-entry-table">
                <tbody>
                    {** 1行目：名前／読み方 **}
                    <tr class="row-basic">
                        <th>名前</th>
                        <td>{$row.name}</td>
                        <th>読み方</th>
                        <td>{$row.furigana}</td>
                    </tr>

                    {foreach $pairs as $k=>$lab}
                        {assign var="key" value=$k|cat:"_result"}
                        {assign var="result" value=$row[$key]|default:''}
                        {assign var="count" value=$row[$k]|default:''}
                        {assign var="class" value=(
                            $result == '最大吉' ? 'result-max' :
                            ($result == '大吉' ? 'result-great' :
                            ($result == '吉' ? 'result-good' : 'result-other'))
                        )}
                        <tr class="row-score">
                            <th>{$lab}</th>
                            <td colspan="3">
                                <span class="{$class}">{$result}</span>{if $count ne ''}（{$count}画）{/if}
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {/foreach}
    {else}
        <p>男性のデータはありません。</p>
    {/if}

    {** ===== 女性 ===== **}
    <h2>女性</h2>
    {if $results_female|@count > 0}
        {foreach $results_female as $row}
            {assign var="pairs" value=[
                "tenkaku" => "天格",
                "jingaku" => "人格",
                "chikaku" => "地格",
                "gaikaku" => "外格",
                "soukaku" => "総格"
            ]}
            <table class="sp-entry-table">
                <tbody>
                    <tr class="row-basic">
                        <th>名前</th>
                        <td>{$row.name}</td>
                        <th>読み方</th>
                        <td>{$row.furigana}</td>
                    </tr>

                    {foreach $pairs as $k=>$lab}
                        {assign var="key" value=$k|cat:"_result"}
                        {assign var="result" value=$row[$key]|default:''}
                        {assign var="count" value=$row[$k]|default:''}
                        {assign var="class" value=(
                            $result == '最大吉' ? 'result-max' :
                            ($result == '大吉' ? 'result-great' :
                            ($result == '吉' ? 'result-good' : 'result-other'))
                        )}
                        <tr class="row-score">
                            <th>{$lab}</th>
                            <td colspan="3">
                                <span class="{$class}">{$result}</span>{if $count ne ''}（{$count}画）{/if}
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {/foreach}
    {else}
        <p>女性のデータはありません。</p>
    {/if}

    <br>
    <a href="/index">トップに戻る</a>
</body>
</html>
