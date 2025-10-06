<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/search.css">
</head>
<body>
  <h1>漢字検索結果</h1>

  {if $results|@count > 0}
    <table border="1" cellpadding="4">
      <tr>
        <th>漢字</th>
        <th>画数</th>
        <th>音読み</th>
        <th>訓読み</th>
      </tr>
      {foreach $results as $row}
        <tr>
        <td class="kanji-cell" data-kanji="{$row->getKanji()}">
            {$row->getKanji()}
        </td>
        <td>{$row->getStrokeCount()}</td>
        <td>{$row->getOnyomi()}</td>
        <td>{$row->getKunyomi()}</td>
        </tr>
      {/foreach}
    </table>
  {else}
    <p>該当する漢字は見つかりませんでした。</p>
  {/if}

  <br>
  <a href="/index">トップに戻る</a>

  <!-- モーダル -->
  <div id="kanjiModal" class="modal" onclick="closeModalByOverlay(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
      <p id="modal-text"></p>
      <a href="/index" class="button-link">トップに戻る</a>
    </div>
  </div>

  <!-- JSはbody閉じタグ直前に置く -->
  {literal}
  <script>
    // 起動時にセルへイベントを付与（SPでも確実に拾う）
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.kanji-cell').forEach(td => {
        td.addEventListener('click', function () {
          const kanji = td.getAttribute('data-kanji') || td.textContent.trim();
          copyKanji(kanji);
        });
      });
    });

    function copyKanji(kanji) {
      // 1) まず Clipboard API を試す
      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(kanji)
          .then(() => openModal(`「${kanji}」をコピーしました！`))
          .catch(() => legacyCopy(kanji));
      } else {
        // 2) HTTP や未サポート環境はフォールバック
        legacyCopy(kanji);
      }
    }

    // フォールバック：一時textareaで execCommand('copy')
    function legacyCopy(text) {
      const ta = document.createElement('textarea');
      ta.value = text;
      ta.style.position = 'fixed';
      ta.style.top = '-1000px';
      ta.style.opacity = '0';
      document.body.appendChild(ta);
      ta.focus();
      ta.select();

      let ok = false;
      try { ok = document.execCommand('copy'); } catch (e) { ok = false; }
      document.body.removeChild(ta);

      if (ok) {
        openModal(`「${text}」をコピーしました！`);
      } else {
        // 失敗時でもモーダルは出す（案内文に切り替え）
        openModal(`コピーに失敗しました。\n「${text}」を長押ししてコピーしてください。`);
      }
    }

    function openModal(msg) {
      const modal = document.getElementById('kanjiModal');
      const p = document.getElementById('modal-text');
      p.textContent = msg;
      modal.style.display = 'block';
    }

    // モーダルは外側タップでのみ閉じる
    function closeModalByOverlay(e) {
      if (e.target.id === 'kanjiModal') {
        e.currentTarget.style.display = 'none';
      }
    }
  </script>
  {/literal}
</body>
</html>
