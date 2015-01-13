<?php
App::uses('AppController', 'Controller');

class FeedController extends AppController {
  //このコントローラーの名前
  public $name = "Feed";
  //このコントローラーで使用するモデル名
  public $uses = array('Feed','Follow','User');
  //outh認証の設定
  public $components = array("Auth");
  
  public function index() {
    $this->set('userinfo',$this->Auth->user());
    $allFeed = $this->Feed->find('all');
    $this->set('allFeed', $allFeed);
  }
    public function myfeed() {
     $userInfo = $this->Auth->user();
     $this->set('userinfo',$userInfo);
     $myFeed = $this->Feed->myFeed($userInfo['id']);
     $this->set('myFeed', $myFeed);
  }

  public function tweets(){
    //データがPOSTされたら
    if($this->request->is('post')){
      //データを保存
      if($this->Feed->save($this->request->data)){
        //indexページへ移動する
        $this->redirect('index');
      }else{
        $this->Session->setFlash(__('登録できませんでした。やり直して下さい'));
      }
    }
  }
  public function addFollow(){
    //データがPOSTされたら
    if($this->request->is('post')){
      //データを保存
      if($this->Follow->save($this->request->data)){
        //indexページへ移動する
        $this->redirect('myfeed');
      }else{
        $this->Session->setFlash(__('登録できませんでしたｗｗやり直して下さい'));
        $this->redirect('index');
      }
    }
  }
  public function deleteFollow(){
    //データがPOSTされたら
    if($this->request->is('post')){
      //データを保存
      if($this->Follow->deleteAll($this->request->data)){
        //indexページへ移動する
        $this->redirect('myfeed');
      }else{
        $this->Session->setFlash(__('登録できませんでしたｗｗやり直して下さい'));
        $this->redirect('index');
      }
    }
  }

  public function users_tweets($user_id){
    $this->set('user_id',$user_id);
    $userinfo = $this->Auth->user();
    $this->set('userinfo',$userinfo);
    $this->set('usercheck',$this->Follow->followCheck($userinfo['id'],$user_id));
    $userFeed = $this->Feed->find('all',array('conditions' => array('Feed.user_id' => $user_id)));
    $this->set('userFeed', $userFeed);
    $this->set('userStatus', $this->User->getUserStatus($user_id));
    $this->set('followCount', $this->Follow->getFollowCount($user_id));
  }


}



