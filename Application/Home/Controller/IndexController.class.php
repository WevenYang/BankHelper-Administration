<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
     //   $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this -> display("index");
    }

    /**
     * 登陆接口
     */
    public function login()
    {
        header('content-type:application/json;charset=utf8');
        $acc = I("post.account");
        $pwd = I("post.password");
        $condition["account"] = $acc;
        $condition["password"] = $pwd;

        $list = M("person_info")->where($condition)->find();
        if ($list) {
            $userId = M("person_info")->where($condition)->getField("id");
            $paypwd = M("person_info")->where($condition)->getField("paypassword");
            $name = M("person_info")->where($condition)->getField("account");
            $icon = M("person_info")->where($condition)->getField("icon");
            $token =md5($condition['account'])."-".md5($condition['password'])."-".time();
            $arr = array(
                "Code" => 200,
                "Data" => array(
                    "token"=> $token,
                    "userId" => $userId,
                    "paypwd" => $paypwd,
                    "name" => $name,
                    "icon" => $icon,
                ),
                "Success" => true,
                "Message" => "登陆成功"
            );
        } else {
            $arr = array(
                "Code" => 200,
                "Data" => array(
                    "token"=> "",
                    "userId" => "",
                    "paypwd" => ""
                ),
                "Success" => false,
                "Message" => "登陆失败"
            );
        }
        echo json_encode($arr);
    }

    /**
     *注册信息
     */
    public function register()
    {
//        $data = M("person_info");
//        $account = I("post.account");
//        $condition["account"] = $account;
//        $condition["password"] = I("post.password");
//        $condition["nickname"] = I("post.nickname");
//        $condition["idcard"] = I("post.idcard");
//        if($data -> where("account = '%s'", $account) -> find()){
//            $arr = array(
//                "Code" => 200,
//                "Data" => "",
//                "Success" => true,
//                "Message" => "该账户名已存在"
//            );
//        }
//        else{
//            $data -> add($condition);
        $arr = array(
            "Code" => 200,
            "Data" => "asfdas",
            "Success" => true,
            "Message" => "注册成功"
        );
//        }
        return json_encode($arr);
    }

    //获取个人资料
    public function getPersonInfo(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_info");
        $now = date("y-m-d H:i:s");
        $userId = I("post.userid");
        $token = I("post.token");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result = $data -> where("id='%s'", $userId) -> select();
        if ($result){
            $arr = array(
                "Code" => 200,
                "Data" => $result,
                "Success" => true,
                "Message" => "获取成功"
            );
        }else{
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "获取失败"
            );
        }
//        }
        echo json_encode($arr);
    }

    //修改个人资料
    public function editPersonInfo(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_info");
        $now = date("y-m-d H:i:s");
        $userId = I("post.id");
        $token = I("post.token");
        $condition["nickname"] = I("post.nickname");
        $condition["phonenum"] = I("post.phonenum");
        $condition["sex"] = I("post.sex");
        $condition["idcard"] = I("post.idcard");
//        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result = $data -> where("id='%s'", $userId) -> save($condition);
        if ($result){
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => true,
                "Message" => "上传成功"
            );
        }else{
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "上传失败"
            );
        }
//        }
        echo json_encode($arr);
    }

    //查询账户余额
    public function queryBalance(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_account");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $userid = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result = $data -> where("u_id = '%s'", $userid) -> getField("account");
        if ($result){
            $arr = array(
                "Code" => 200,
                "Data" => array(
                    "balance" => $result,
                ),
                "Success" => true,
                "Message" => "查询成功"
            );
        }else{
            $arr = array(
                "Code" => 200,
                "Data" => array(
                    "balance" => 0,
                ),
                "Success" => false,
                "Message" => "查询失败"
            );
        }
//        }
        echo json_encode($arr);
    }

    //修改密码
    public function resetPwd(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_info");
        $now = date("y-m-d H:i:s");
        $userId = I("post.userId");
        $token = I("post.token");
        $former = I("post.formerPwd");
        $client = strstr($token, "15");
        $newPwd = I("post.newPwd");
        if (strstr(strtotime($now), "15") - $client > 7200){
            $arr = array(
                "Code" => 203,
                "Data" => "",
                "Success" => false,
                "Message" => "认证失败，请重新登陆",
            );
        }else{
            $formerpwd = explode("-", $token);
            if (md5($former) == $formerpwd[1]){
                $data = M("person_info") -> where('id='.$userId)-> setField("password", $newPwd);
                if($data){
                    $arr = array(
                        "Code" => 200,
                        "Data" => "",
                        "Success" => true,
                        "Message" => "登陆密码修改成功"
                    );
                }else {
                    $arr = array(
                        "Code" => 200,
                        "Data" => "",
                        "Success" => false,
                        "Message" => "登陆密码修改失败"
                    );
                }

            }else {
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => false,
                    "Message" => "原密码输入错误".$formerpwd
                );
            }
        }
        echo json_encode($arr);
    }

    //支付密码修改
    public function resetPayPwd(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_info");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $userId = I("post.userId");
        $former = I("post.formerPwd");
        $client = strstr($token, "15");
        $newPwd = I("post.newPwd");
        if (strstr(strtotime($now), "15") - $client > 7200){
            $arr = array(
                "Code" => 203,
                "Data" => "",
                "Success" => false,
                "Message" => "认证失败，请重新登陆"
            );
        }else{
            $formerpwd = explode("-", $token);
            if (md5($former) == $formerpwd[1]){
                $result = $data -> where('id='.$userId)-> setField("paypassword", $newPwd);
                if($result){
                    $arr = array(
                        "Code" => 200,
                        "Data" => "",
                        "Success" => true,
                        "Message" => "支付密码修改成功"
                    );
                }else {
                    $arr = array(
                        "Code" => 200,
                        "Data" => "",
                        "Success" => false,
                        "Message" => "支付密码修改失败"
                    );
                }

            }else {
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => false,
                    "Message" => "原密码输入错误".$formerpwd
                );
            }
        }
        echo json_encode($arr);
    }

    //意见反馈
    public function feedback(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("feedback");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $condition["content"] = I("post.content");
        $condition["user_id"] = I("post.user");
        $condition["date"] = $now;
        $client = strstr($token, "15");
        if (strstr(strtotime($now), "15") - $client > 7200){
            $arr = array(
                "Code" => 203,
                "Data" => "",
                "Success" => false,
                "Message" => "认证失败，请重新登陆"
            );
        }else{
            $result = $data -> add($condition);
            if ($result){
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => true,
                    "Message" => "上传成功"
                );
            }else{
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => false,
                    "Message" => "上传失败"
                );
            }
        }
        echo json_encode($arr);
    }

    //风险举报
    public function riskReport(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("risk");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $condition["content"] = I("post.content");
        $condition["user_id"] = I("post.user");
        $condition["date"] = $now;
        $client = strstr($token, "15");
        if (strstr(strtotime($now), "15") - $client > 7200){
            $arr = array(
                "Code" => 203,
                "Data" => "",
                "Success" => false,
                "Message" => "认证失败，请重新登陆"
            );
        }else{
            $result = $data -> add($condition);
            if ($result){
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => true,
                    "Message" => "上传成功"
                );
            }else{
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => false,
                    "Message" => "上传失败"
                );
            }
        }
        echo json_encode($arr);
    }

    //获取转账用户账号id
    public function getPeopleAccount(){
        header('content-type:application/json;charset=utf8');
        $account = I("post.account");
        $list = M("person_info")->where("account='%s'", $account) -> select();
        if ($list) {
            $userId = M("person_info")->where("account='%s'", $account) ->getField("id");
            $nickname = M("person_info")->where("account='%s'", $account) ->getField("nickname");
            $arr = array(
                "Code" => 200,
                "Data" => array(
                    "userId"=> $userId,
                    "nickName" => $nickname
                ),
                "Success" => true,
                "Message" => "查询成功"
            );
        } else {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "输入账号不存在，请重新输入"
            );
        }
        echo json_encode($arr);
    }

    //定期转活期、活期转定期
    public function transfer(){
        header("Content-Type:text/html; charset=utf-8");
        $now = date("y-m-d H:i:s");
        $userId = I("post.userid");
        $type = I("post.type");
        $token = I("post.token");
        $transfer_money = I("post.num");
        $before_fix_deposit = I("post.fix_deposit");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        //0代表转入，1代表转出
        if ($type == 0){
            $before_current_deposit = M("person_account") -> where("u_id='%s'", $userId) -> getField("current_deposit");
            $after_current_deposit = $before_current_deposit - $transfer_money;
            $after_fix_deposit = $before_fix_deposit + $transfer_money;
            //不可重复使用$data,原因估计是该赋值只指定数据库一次
            $result1 = M("person_account") -> where("u_id='%s'", $userId) -> setField('current_deposit', $after_current_deposit);
            $result2 = M("person_account") -> where("u_id='%s'", $userId) -> setField('fixed_deposit', $after_fix_deposit);
            if ($result1 && $result2){
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
        }else if($type == 1){

            $before_current_deposit = M("person_account") -> where("u_id='%s'", $userId) -> getField("current_deposit");
            $after_current_deposit = $before_current_deposit + $transfer_money;
            $after_fix_deposit = $before_fix_deposit - $transfer_money;
            $result1 = M("person_account") -> where("u_id='%s'", $userId)  -> setField("current_deposit", $after_current_deposit);
            $result2 = M("person_account") -> where("u_id='%s'", $userId)  -> setField("fixed_deposit", $after_fix_deposit);
            if ($result1 && $result2){
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
        }else {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "操作失败，请检查接口"
            );
        }

//        }
        echo json_encode($arr);
    }

    //获取用户的账户信息
    public function getMyAccount(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_account");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $userid = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result1 = $data -> where("u_id = '%s'", $userid) -> getField("account");
        $result2 = $data -> where("u_id = '%s'", $userid) -> getField("fixed_deposit");
        $result3 = $data -> where("u_id = '%s'", $userid) -> getField("current_deposit");
        if ($result1 && $result2 && $result3){
            $arr = array(
                "Code" => 200,
                "Data" => array(
                    "account" => $result1,
                    "fixed_deposit" => $result2,
                    "current_deposit" => $result3,
                ),
                "Success" => true,
                "Message" => "查询成功"
            );
        }else{
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "查询失败"
            );
        }
//        }
        echo json_encode($arr);
    }

    //获取银行信息
    public function getBankMessage(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("bank_message");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $userid = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result = $data -> order("id desc") -> select();
        if ($result){
            $arr = array(
                "Code" => 200,
                "Data" => $result,
                "Success" => true,
                "Message" => "获取成功"
            );
        }else {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "获取失败"
            );
        }
//}
        echo json_encode($arr);
    }

    //获取定期余额
    public function getFixDeposit(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_account");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $userid = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result2 = $data -> where("u_id = '%s'", $userid) -> getField("fixed_deposit");
        if ($result2){
            $arr = array(
                "Code" => 200,
                "Data" => $result2,
                "Success" => true,
                "Message" => "查询成功"
            );
        }else{
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "查询失败"
            );
        }
//        }
        echo json_encode($arr);
    }

    //获取活期余额
    public function  getCurrentDeposit(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_account");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $userid = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result3 = $data -> where("u_id = '%s'", $userid) -> getField("current_deposit");
        if ($result3){
            $arr = array(
                "Code" => 200,
                "Data" => $result3,
                "Success" => true,
                "Message" => "查询成功"
            );
        }else{
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "查询失败"
            );
        }
//        }
        echo json_encode($arr);
    }

    //保存信息接口
    public function saveMessage($type, $num){
        $data = M("bank_message");
        //0为充值，1为转账，2为转入定期，3为转出定期
        $condition["type"] = $type;
        $condition["num"] = $num;
        $result = $data -> add($condition);
        if ($result){
            return true;
        }else {
            return false;
        }


    }

    //充值接口
    public function recharge(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("bank_message");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $num = I("post.num");
        $userid = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $former_deposit = M("person_account") -> where("u_id='%s'", $userid) -> getField("account");
        $fixed_deposit = M("person_account") -> where("u_id='%s'", $userid) -> getField("fixed_deposit");
        $current_deposit = $former_deposit + $num;
        $current_current = $current_deposit - $fixed_deposit;
        $result = M("person_account") -> where("u_id='%s'", $userid) -> setField("account", $current_deposit);
        $result1 = M("person_account") -> where("u_id='%s'", $userid) -> setField("current_deposit", $current_current);
        if (($this -> saveMessage(0, $num)) && $result && $result1){

            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => true,
                "Message" => "操作成功"
            );
        }else {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "操作失败"
            );
        }
//}
        echo json_encode($arr);
    }

    public function transferToAccount(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("bank_message");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $num = I("post.num");
        $userid = I("post.id");
        $toAccountId = I("post.toAccountId");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $former_deposit = M("person_account") -> where("u_id='%s'", $userid) -> getField("account");
        $former_deposit1 = M("person_account") -> where("u_id='%s'", $toAccountId) -> getField("account");
        $current_deposit = $former_deposit + $num;
        $current_deposit1 = $former_deposit - $num;
        $result = M("person_account") -> where("u_id='%s'", $userid) -> setField("account", $current_deposit);
        $result1 = M("person_account") -> where("u_id='%s'", $toAccountId) -> setField("account", $current_deposit1);
        if (($this -> saveMessage(1, $num)) && $result && $result1){

            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => true,
                "Message" => "操作成功"
            );
        }else {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "操作失败"
            );
        }
//}
        echo json_encode($arr);
    }

    public function test(){
        $token = I("post.token");
        $arr = array(
            "token" => $token,
        );
        echo json_encode($arr);
    }


}