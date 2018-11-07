<?php

//获取微信个人信息中转（m.kyueyun.com）
class WxAction extends Action {

  public function get_user_info($openid = FALSE) {
      //var_dump(111);exit();
      if(!$openid) {
        exit('缺少openid失败!');
      }
      $token = S('wxtoken');
     if (!$token) {
          $access = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxbbd3b017b3e18d83&secret=89c98fc18b2779a1313ef1c710c5e3df');
          $access = json_decode($access, true);
          //var_dump($access);exit();
          if (isset($access['access_token'])) {
              S('wxtoken', $access['access_token'], 7000);
          } else {
              exit('获取token 失败!');
         }
      }

      $user_data =file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openid);
      echo $user_data;
      // $user_data = json_decode($user_data, true);
      // return $user_data;
  }


  private function get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    } 
}
