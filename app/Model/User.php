<?php
class User extends AppModel{
   //モデル名の指定（省略可）
   public $name = 'User';
   //バリデーションの設定
   public $validate = array(
   'username' => array(
   'required' => array(
   'rule' => array('notEmpty'),
   'message' => 'ユーザー名を入力して下さい。'
   )
   ),
   'email' => array(
   'required' => array(
   'rule' => array('email'),
   'message' => 'メールアドレスを入力してください。'
   )
   ),
   'password' => array(
   'required' => array(
   'rule' => array('minLength',8),
   'message' => 'パスワードは8文字以上にして下さい。'
   )
   ),
   );
  //保存前にハッシュ値変換を行います
   public function beforeSave($options=array()) {
   if (isset($this->data[$this->alias]['password'])) {
   $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
   }
   return true;
   }

   public function getUserStatus($user_id){
     $this->virtualFields = array(
       'text_count' => 'sum(case when user_id = '.$user_id.' then 1 else 0 end)'
     );
     $params = array(
       'fields' => array(
         'text_count',
         'username',
       ),

       'conditions' => array(
         'User.id = ?' => array($user_id),
        ),
       'joins' => array(
          array(
            'type' => 'INNER',
            'alias' => 'Feed',
            'table' => 'feeds',
            'conditions' => 'User.id = Feed.user_id'          
          ),
       ),
     );
     $data = $this->find('first',$params);
     return $data;
   }

}