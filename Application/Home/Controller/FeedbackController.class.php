<?php
/**
 * Created by PhpStorm.
 * User: QQ594
 * Date: 2018/9/11
 * Time: 23:46
 */

namespace Home\Controller;
use Think\Controller;

class FeedbackController extends Controller
{
    public function index(){
        //   $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this -> assign("item1", $this -> getFeedbackInfo());
        $this -> display("index");
    }

    public function getFeedbackInfo(){
        $result = M("feedback") -> where("type = 0") -> select();
        if ($result){
            foreach($result as $info){
                $array[] = $info;
            }

        }
        return $array;
    }

    public function haveRead($id, $status){
        header('content-type:application/json;charset=utf8');
        $list = M("feedback")-> where("id='%s'", $id) -> setField("type", $status);
        if ($list) {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => true,
                "Message" => "操作成功"
            );
        } else {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "操作失败"
            );
        }
        echo json_encode($arr);
    }
}