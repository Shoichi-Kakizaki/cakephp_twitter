<h2>タイムライン</h2>
<p><?php echo $this->Html->link('お気に入りタイムライン一覧へ','myfeed',array());?></p>
  <?php
    //フォームの開始を宣言する
    echo $this->Form->create('null',array('url' => array('controller' => 'feed', 'action' => 'tweets')));
    //入力フォームの生成
    echo $this->Form->input('Feed.text', array('type' => 'text'));
    //送信する
    echo $this->Form->end('ツイート');
  ?>

<ul>
  <?php foreach($allFeed as $allfeed): ?>
    <!--個別の詳細ページへのリンク-->
    <li><?php echo $this->Html->link($allfeed['Feed']['text'],array('controller' => 'Feed','action' => 'users_tweets',$allfeed['Feed']['user_id']));?></li>
  <?php endforeach; ?>
</ul>


