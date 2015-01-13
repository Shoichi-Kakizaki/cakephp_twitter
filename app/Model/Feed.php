<?php
class Feed extends AppModel{
  // var $hasMany = array(
  //   'feeds'=>array(
  //      'className'=>'follows',
  //      'foreignKey'=>false ,
  //      'conditions'=>array('feeds.user_id = follows.follow_id')
  //    )
  // );
  //自分の名前を定義
  public $name = 'Feed';
  public $validate = array(
    'text' => array(
      'required' => array(
        'rule' => 'notEmpty',
        'message' => 'ツイートを入力してください'
      ),
      'maxlength' => Array(
        'rule' => Array('maxLength', 140),
        'message' => 'ツイートは140文字以内で入力してください',
      ),
    ),
  );

  public function myFeed($user_id){
    $params = array(
      'conditions' => array(
        'Follow.user_id = ?' => array($user_id),
      ),
      'joins' => array(
        array(
          'type' => 'INNER',
          'alias' => 'Follow',
          'table' => 'follows',
          'conditions' => 'Feed.user_id = Follow.follow_id'          
        ),
      ),
    );
    $data = $this->find('all',$params);
    return $data;
  }
}