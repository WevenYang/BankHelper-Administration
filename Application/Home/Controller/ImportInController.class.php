<?php
/**
 * Created by PhpStorm.
 * User: QQ594
 * Date: 2018/9/11
 * Time: 23:46
 */

namespace Home\Controller;
use Think\Controller;

class ImportInController extends Controller
{
    public function index(){
        //   $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this -> assign("item1", $this -> getTransferInfo());
        $this -> display("index");
    }

    public function getTransferInfo(){
        $result = M("transfer_info") -> where("status = 0") -> select();
        if ($result){
            foreach($result as $info){
                $array[] = $info;
            }

        }
        return $array;
    }

    //审核是否通过,status为1为通过，2为拒绝
    public function passTransferApply($id, $status, $transfer_money, $card_id){
        header('content-type:application/json;charset=utf8');
        $list = M("transfer_info")-> where("id='%s'", $id) -> setField("status", $status);
        $index = new IndexController();
        if ($list) {
            if ($status == 1){
                $before_fix_deposit = M("person_card") -> where("id='%s'", $card_id) -> getField("fixed_deposit");
                $before_current_deposit = M("person_card") -> where("id='%s'", $card_id) -> getField("current_deposit");
                $after_current_deposit = $before_current_deposit - $transfer_money;
                $after_fix_deposit = $before_fix_deposit + $transfer_money;
                //不可重复使用$data,原因估计是该赋值只指定数据库一次
                $result1 = M("person_card") -> where("id='%s'", $card_id) -> setField('current_deposit', $after_current_deposit);
                $result2 = M("person_card") -> where("id='%s'", $card_id) -> setField('fixed_deposit', $after_fix_deposit);
//                $result3 = M("person_card") -> where("id='%s'", $id) -> setField('start_time', date("y-m-d H:i:s"));
                if (($index -> saveMessage(5, $transfer_money)) && $result1 && $result2){
                    $arr = array(
                        "Code" => 200,
                        "Data" => "",
                        "Success" => true,
                        "Message" => "操作成功"
                    );
                }else{
                    $arr = array(
                        "Code" => 200,
                        "Data" => "",
                        "Success" => false,
                        "Message" => "操作失败"
                    );
                }
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => true,
                    "Message" => "审核已成功"
                );
            }else if($status == 2){
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => true,
                    "Message" => "审核已拒绝"
                );
            }else {
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => false,
                    "Message" => "操作失败"
                );
            }

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