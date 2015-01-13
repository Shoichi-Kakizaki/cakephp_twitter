<h2>一覧表示</h2>
<ul>
    <?php foreach($allResult as $): ?>
        <!-- <?php debug($memo); ?> デバッグ-->

       <!-- 配列のデータを取り出してechoで出力する、h()はエスケープ -->
        <li><?php echo h($memo['Memo']['title']); ?></li>

    <?php endforeach; ?>
</ul>