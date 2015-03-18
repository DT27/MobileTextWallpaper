<?php
/**
  * wechat php response
  */

//define your token
define("TOKEN", "mobiletextwallpaper");
$wechatObj = new wxResponse();
$wechatObj->responseMsg();

class wxResponse
{

    public function responseMsg()
    {
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $msgType = $postObj->MsgType;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            $imgtextTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <ArticleCount>1</ArticleCount>
                        <Articles>
                        <item>
                        <Title><![CDATA[DIY你的手机壁纸]]></Title>
                        <Description><![CDATA[]]></Description>
                        <PicUrl><![CDATA[http://www.mobiletextwallpaper.com/img/wxbanner.jpg]]></PicUrl>
                        <Url><![CDATA[http://www.mobiletextwallpaper.com/]]></Url>
                        </item>
                        </Articles>
                        </xml> ";
            $lol=array("(๑˘ ˘๑)","✿◡‿◡","(｡ŏ_ŏ) ","(◍'౪`◍)ﾉﾞ","<(▰˘◡˘▰)>","(つ﹏⊂)","⊙＾⊙","[>\/<]"," ( > c < ) ","ㄟ(≥◇≤)ㄏ","(￣▽￣)~*","〒_〒","..@_@|||||..","⊙﹏⊙‖∣°","%>_<%","//(ㄒoㄒ)//","-____-''","（╯＾╰〉","(╯-╰)/","(° ο°)~","﹌○﹋ ","(~￣▽￣)~[]","╮(╯3╰)╭ ","…(⊙_⊙;)… ","Σ( ° △ °|||)︴","o(一＾一+)o","(—.—||||","（＃－－）/","√(—皿—)√","ヾ(♥ó㉨ò)ﾉ","~w_w~","π_π","‘（*^﹏^*）′ ","一 一+","O__O+","o_o ....");


            if($msgType=="event"){
                $eventStr = $postObj->Event;
                if($eventStr =="subscribe"){
                    $contentStr = "您好♥ 欢迎关注我 ~(￣▽￣)~ \n 壁纸服务请按① \n 聊天服务请按〇";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "text", $contentStr);
                    echo $resultStr;
                    $resultStr2 = sprintf($imgtextTpl, $fromUsername, $toUsername, $time, "news");
                    echo $resultStr2;
                    exit;
                }
            }
            if(!empty($keyword) && is_numeric($keyword)) {
                if ($keyword == 1) {
                    //$contentStr = "请回复序号选择样式：\n 1、生成文字壁纸\n 2、反馈问题";
                    $resultStr = sprintf($imgtextTpl, $fromUsername, $toUsername, $time, "news");
                    echo $resultStr;
                }else{
                    $contentStr = "功能开发中，请谅解 ".$lol[rand(0,22)];
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "text", $contentStr);
                    echo $resultStr;
                }
            }elseif($keyword=="h" || $keyword=="H" || $keyword=="Help" || $keyword=="HELP" || $keyword=="help" || $keyword=="帮助"){
                $contentStr = "请回复序号选择服务：\n 1、生成文字壁纸\n 2、反馈问题";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "text", $contentStr);
                echo $resultStr;
            }elseif(stristr($keyword,"dt")){
                $contentStr = "叔叔我们不约 ".$lol[rand(0,22)];
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "text", $contentStr);
                echo $resultStr;
            }else{
                header("Content-type: text/html; charset=utf-8");
                $res =file_get_contents("http://www.tuling123.com/openapi/api?key=e2dab72595023365067a9fbdeb96ea5d&info=".$keyword);
                $resStr = json_decode($res,true);
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "text", $resStr['text']);
                echo $resultStr;
                exit;
            }

        }else {
        	echo "Exit!";
        	exit;
        }
    }
}

?>