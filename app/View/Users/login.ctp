<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array('url' => 'login')); ?>
<?php echo $this->Form->input('username', array('label' => 'ユーザ名')); ?>
<?php echo $this->Form->input('password', array('label' => 'パスワード')); ?>
<?php echo $this->Form->end('ログイン'); ?>