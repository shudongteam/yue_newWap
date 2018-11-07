<?php

class WxPayConfig {

    //基本信息
    const APPID = 'wxbbd3b017b3e18d83';
    const APPSECRET = '89c98fc18b2779a1313ef1c710c5e3df';
    const MCHID = '1499231802';
    const KEY = 'bd8325f9ed2337e207e24b691322a96e';
    //证书目录
    const SSLCERT_PATH = '../cert/apiclient_cert.pem';
    const SSLKEY_PATH = '../cert/apiclient_key.pem';
    //安全验证
    const CURL_PROXY_HOST = "0.0.0.0";
    const CURL_PROXY_PORT = 0;
    //上报信息
    const REPORT_LEVENL = 1;
    //提交地址
    #const Submit = "http://w.ymzww.cn/Personal/Payinterface";
    //反馈地址
    const Notify = "http://m.kyueyun.com/NewWap/Notify/weixin/";
    //失败地址
   // const Shibai = "http://text.nw.ymzww.cn/Pay/err.html";
    //成功地址
   // const Chenggong = "http://text.nw.ymzww.cn/Pay/ok/";
    //检测地址
   // const Jiance = "http://text.nw.ymzww.cn/Pay/payresult/trade/";

}
