<?php
class Follow extends AppModel{
  // var $hasAndBelongsToMany = array('Feed');
  //自分の名前を定義
  public $name = 'Follow';

  //フォローされているのかチェック。されていればtrue,されてなければfalseを返す
  public function followCheck($user_id, $follow_id){
    $params = array(
      'conditions' => array(
        'Follow.user_id = ?' => array($user_id),
      ),
    );
    $Status = $this->find('all',$params);

    foreach ($Status as $status){
      if ($follow_id == $status['Follow']['follow_id']){
        return $bool = false;  
      }
    }
    return $bool = true;
  } 
  public function getFollowCount($user_id){
     $this->virtualFields = array(
        'follow_count' => 'sum(case when user_id = '.$user_id.' then 1 else 0 end)',
        'follower_count' => 'sum(case when follow_id = '.$user_id.' then 1 else 0 end)',
      );
     $params = array(
       'fields' => array(
         'follow_count',
         'follower_count',
       ),
     );
     $data = $this->find('first',$params);
     return $data; 
  }
}