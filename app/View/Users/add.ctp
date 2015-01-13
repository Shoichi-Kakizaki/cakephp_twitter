<?php
 echo $this->Form->create('User', array('url' => 'add'));
 echo $this->Form->input('username',array('label'=>'ユーザ名'));
 echo $this->Form->input('password',array('label'=>'パスワード'));
 echo $this->Form->input('email',array('label'=>'メールアドレス'));
 echo $this->Form->end('新規ユーザを作成する');
?>