<?php
class UsersController extends AppController{
   //使用モデルの指定（省略可）
   public $uses = array('User');
   //使用コンポーネントの登録
   public $components = array(
       'Session',
       'Auth' => array(
         'authenticate' => array(
           'Form' => array(
             'userModel' => 'User', //ユーザー情報のモデル

           )   
        ),  
       //ログイン後の移動先
       'loginRedirect' => array('controller' => 'feed', 'action' => 'index'),
       //ログアウト後の移動先
       'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
       //ログインページのパス
       'loginAction' => array('controller' => 'users', 'action' => 'login'),
       //未ログイン時のメッセージ
       'authError' => '名前とパスワードを入力して下さい。',
     )
   );
   function beforeFilter(){
     //親クラスのbeforeFilterの読み込み
     parent::beforeFilter();
     AuthComponent::$sessionKey = "Auth.User";
     //認証不要のページの指定
     $this->Auth->allow('login', 'logout', 'add'); 
   }
     //indexアクション（認証が必要なページ）
   function index(){
     //アクセス情報をビューに渡す
     $this->set('userinfo',$this->Auth->user($this->data));
   }
   //ログインアクション（認証が不要なページ）
   function login(){
     //POST送信なら
     if($this->request->is('post')) {
      var_dump($this->Auth->login());
     //ログインOKなら
       if($this->Auth->login()) {
        echo "ここまで来たよ！";
       //Auth指定のログインページへ移動
          return $this->redirect($this->Auth->redirectUrl());
       }else{ //ログインNGなら
         $this->Session->setFlash(__('ユーザ名かパスワードが違います'), 'default', array(), 'auth');
       }
     } 
     print_r($this->Auth->login());
   }
   //ログアウトアクション（認証が不要なページ）
   function logout(){
     $this->Auth->logout();
   }
   //ユーザー追加（認証が不要なページ）
   function add(){
     //POST送信なら
     if($this->request->is('post')) {
       //パスワードのハッシュ値変換
       $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
       //ユーザーの作成
       $this->User->create();
       //リクエストデータを保存できたら
       if ($this->User->save($this->request->data)) {
         $this->Session->setFlash(__('新規ユーザーを追加しました'));
         $this->redirect(array('action' => 'index'));
       }else{ //保存できなかったら
         $this->Session->setFlash(__('登録できませんでした。やり直して下さい'));
       }
     }
   }
}