<h2><?php echo h($userinfo['username']);?>さんのお気に入りタイムライン</h2>
<p><?php echo $this->Html->link('タイムライン一覧へ','index',array());?></p>
  <?php
    //フォームの開始を宣言する
    echo $this->Form->create('null',array('url' => array('controller' => 'feed', 'action' => 'add')));
    //入力フォームの生成
    echo $this->Form->input('Feed.text', array('type' => 'text'));
    //送信する
    echo $this->Form->submit('ツイート');
  ?>

<ul>
  <?php foreach($myFeed as $myfeed): ?>
  <!-- 配列のデータを取り出してechoで出力する、h()はエスケープ -->
    <li><?php echo $this->Html->link($myfeed['Feed']['text'],array('controller' => 'Feed','action' => 'users_tweets',$myfeed['Feed']['user_id']));?></li>
  <?php endforeach; ?>
</ul>