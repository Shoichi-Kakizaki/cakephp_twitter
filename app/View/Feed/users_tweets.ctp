<h2><?php echo $userStatus['User']['username']?>さんのタイムライン一覧</h2>
<p>ツイート数:<?php echo $userStatus['User']['text_count']?>  フォロー数:<?php echo $followCount['Follow']['follow_count']?>  フォロワー数:<?php echo $followCount['Follow']['follower_count']?></p>
<p><?php echo $this->Html->link('タイムライン一覧へ','index',array());?></p>
<p><?php echo $this->Html->link('お気に入りタイムライン一覧へ','myfeed',array());?></p>

  
  <?php 
    if($usercheck){
      echo $this->Form->create('null',array('url' => array('controller' => 'feed', 'action' => 'addFollow')));
      echo $this->Form->input('Follow.user_id', array('type' => 'hidden','name' => 'user_id', 'default' => $userinfo['id']));
      echo $this->Form->input('Follow.follow_id', array('type' => 'hidden','name' => 'follow_id', 'default' => $user_id));
      echo $this->Form->end('フォローする');
    }else{
      echo $this->Form->create('null',array('url' => array('controller' => 'feed', 'action' => 'deleteFollow')));
      echo $this->Form->input('Follow.user_id', array('type' => 'hidden','name' => 'user_id', 'default' => $userinfo['id']));
      echo $this->Form->input('Follow.follow_id', array('type' => 'hidden','name' => 'follow_id', 'default' => $user_id));
      echo $this->Form->end('フォロー解除');
    }
  ?>


<ul>
  <?php foreach($userFeed as $userfeed): ?>
    <!-- 配列のデータを取り出してechoで出力する、h()はエスケープ -->
    <li><?php echo h($userfeed['Feed']['text']); ?></li>
  <?php endforeach; ?>
</ul>