<?php

//第三方账户
class AccountsAction extends Action {
   private $website;
   public function __construct()
   {
       $this->website=[
           'master_id' => '29',
           'web_id' => '29',
           'web_name' => '品书风格',
           'webphone' => '15952022287',
           'qq' => '965490571',
           'automatic' => '1',
           'weixin' => 'https://wx3.sinaimg.cn/mw690/006Zrgzsgy1fmxmlsgytpj3076076aaj.jpg',
           'web_url' => 'wap29.nw.kyueyun.com',
           'all_ps' => 'hezuo',
           'login_url' => 'm.kyueyun.com',
           'preload' => 'NewWap',
           'beian' => '赣ICP备18001577号-2',
           'wx_id' => 'wxbbd3b017b3e18d83',
           'wx_secret' => '89c98fc18b2779a1313ef1c710c5e3df',

       ];
   }



    //微信登录
    public function weixin() {


      //  $redirect_uri = urlencode('http://' . $this->website['login_url'] . '/Accounts/wxcallback.html?backUrl=') . base64_encode($_GET[backUrl]);
        //授权弹框
      //  header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->website['wx_id'] . '&redirect_uri=' . $redirect_uri . '&response_type=code&scope=snsapi_userinfo&state=' . $this->website['web_url'] . '&connect_redirect=1#wechat_redirect');

        $appid=$this->website['wx_id'];
        $redirect_uri=urlencode('http://'.$this->website['login_url'].'/Accounts/wxcallback');
      $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
     //echo $url;exit();
      header('location:'.$url);
    }

    //微信反馈
    public function wxcallback() {
     // echo base64_decode($_GET['backUrl']);exit();
      // var_dump($this->website);exit();
        vendor("Oauth.Oauth");
        $oauth = new Oauth($this->website, 'wx');
        $openid = $oauth->callback();
        $login_type = '微信';
      // echo $openid;exit();
        //echo 'http://' . $_GET[state] . '/Accounts/login?openid=' . $openid . '&login_type=' . $login_type . '&backUrl=' . base64_decode($_GET[backUrl]);exit();
        header('location:http://' . $_GET[state] . '/Accounts/login?openid=' . $openid . '&login_type=' . $login_type . '&backUrl=' . base64_decode($_GET[backUrl]));
        // file_put_contents("wxcallback.txt", urlencode(base64_decode($_GET[backUrl])));
    }

    //登录并注册
    public function login($openid, $login_type) {
       echo $openid;
       echo "<br>";
       echo $login_type;
        $is = A('Hezuoaccount')->login($openid);
        if ($is == 2) {
            A('Hezuoaccount')->registers($openid, $login_type);
        }
    }

}
