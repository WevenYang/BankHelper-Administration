<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function show(){
        echo "fuck u";
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
                "Success" => true,
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
        $data = M("person_info");
        $account = I("post.account");
        $condition["account"] = $account;
        $condition["password"] = I("post.password");
        $condition["nickname"] = I("post.nickname");
        $condition["idcard"] = I("post.idcard");
        if($data -> where("account = '%s'", $account) -> find()){
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "该账户名已存在"
            );
        }
        else{
            $result = $data -> add($condition);
            $id = $data -> where($condition) -> getField("id");
            $con["u_id"] = $id;
            $con["account"] = 0;
            $con["fixed_deposit"] = 0;
            $con["current_deposit"] = 0;
            $add_id_to_account = M("person_account") -> add($con);
            if ($result && $add_id_to_account){
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => true,
                    "Message" => "注册成功"
                );
            }else {
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => false,
                    "Message" => "注册失败"
                );
            }

        }
        echo json_encode($arr);
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
        $data = M("person_card");
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
        $result = $data -> where("id = '%s'", $userid) -> getField("total");
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
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆",
//            );
//        }else{
        $formerpwd = explode("-", $token);
        if (md5($former) == $formerpwd[1]){
            $data = M("person_info") -> where('id='.$userId)-> setField("password", $newPwd);
            if($data){
                $arr = array(
                    "Code" => 200,
                    "Data" => "",
                    "Success" => true,
                    "Message" => "登陆密码修改成功，请重新登录"
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
//        }
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
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
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
//        }
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
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
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
//        }
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
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
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
//        }
        echo json_encode($arr);
    }

    //获取转账用户账号id
    public function getPeopleAccount(){
        header('content-type:application/json;charset=utf8');
        $account = I("post.account");
        $list = M("person_card")->where("cardNum='%s'", $account) -> select();
        if ($list) {
            $userId = M("person_card")->where("cardNum='%s'", $account) ->getField("id");
            $nickname = M("person_card")->where("cardNum='%s'", $account) ->getField("card_name");
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
        $duration = I("post.duration");
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
//            $before_current_deposit = M("person_card") -> where("id='%s'", $userId) -> getField("current_deposit");
//            $after_current_deposit = $before_current_deposit - $transfer_money;
//            $after_fix_deposit = $before_fix_deposit + $transfer_money;
//            //不可重复使用$data,原因估计是该赋值只指定数据库一次
//            $result1 = M("person_card") -> where("id='%s'", $userId) -> setField('current_deposit', $after_current_deposit);
//            $result2 = M("person_card") -> where("id='%s'", $userId) -> setField('fixed_deposit', $after_fix_deposit);
//            if (($this -> saveMessage(2, $transfer_money)) && $result1 && $result2){
//                $arr = array(
//                    "Code" => 200,
//                    "Data" => "",
//                    "Success" => true,
//                    "Message" => "操作成功"
//                );
//            }else{
//                $arr = array(
//                    "Code" => 200,
//                    "Data" => "",
//                    "Success" => false,
//                    "Message" => "操作失败"
//                );
//            }
            $info['c_id'] = $userId;
            $info['num'] = $transfer_money;
            $info['apply_time'] = $now;
            $info['status'] = 0;
            $info['duration'] = $duration;
            $result = M("transfer_info") -> add($info);
            if (($this -> saveMessage(2, $transfer_money)) && $result){
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
        }else if($type == 1){

            $before_current_deposit = M("person_card") -> where("id='%s'", $userId) -> getField("current_deposit");
            $after_current_deposit = $before_current_deposit + $transfer_money;
            $after_fix_deposit = $before_fix_deposit - $transfer_money;
            $result1 = M("person_card") -> where("id='%s'", $userId)  -> setField("current_deposit", $after_current_deposit);
            $result2 = M("person_card") -> where("id='%s'", $userId)  -> setField("fixed_deposit", $after_fix_deposit);
            if (($this -> saveMessage(3, $transfer_money)) && $result1 && $result2){
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
        $data = M("person_card");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $cardid = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result1 = $data -> where("id = '%s'", $cardid) -> getField("total");
        $result2 = $data -> where("id = '%s'", $cardid) -> getField("fixed_deposit");
        $result3 = $data -> where("id = '%s'", $cardid) -> getField("current_deposit");
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
        $data = M("person_card");
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
        $result2 = $data -> where("id = '%s'", $userid) -> getField("fixed_deposit");
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
        $data = M("person_card");
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
        $result3 = $data -> where("id = '%s'", $userid) -> getField("current_deposit");
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
        //0为充值，1为转账，2为转入定期，3为转出定期，4为提现，5为转入定期审核通知
        $now = date("y-m-d");
        $condition["type"] = $type;
        $condition["num"] = $num;
        $condition["date"] = $now;
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
        $former_deposit = M("person_card") -> where("id='%s'", $userid) -> getField("total");
        $fixed_deposit = M("person_card") -> where("id='%s'", $userid) -> getField("fixed_deposit");
        $current_deposit = $former_deposit + $num;
        $current_current = $current_deposit - $fixed_deposit;
        $result = M("person_card") -> where("id='%s'", $userid) -> setField("total", $current_deposit);
        $result1 = M("person_card") -> where("id='%s'", $userid) -> setField("current_deposit", $current_current);
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

    //提现接口
    public function withDraw(){
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
        $former_deposit = M("person_card") -> where("id='%s'", $userid) -> getField("total");
        $fixed_deposit = M("person_card") -> where("id='%s'", $userid) -> getField("fixed_deposit");
        $current_deposit = $former_deposit - $num;
        $current_current = $current_deposit - $fixed_deposit;
        $result = M("person_card") -> where("id='%s'", $userid) -> setField("total", $current_deposit);
        $result1 = M("person_card") -> where("id='%s'", $userid) -> setField("current_deposit", $current_current);
        if (($this -> saveMessage(4, $num)) && $result && $result1){

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
        $former_deposit = M("person_card") -> where("id='%s'", $userid) -> getField("total");
        $former_deposit1 = M("person_card") -> where("id='%s'", $toAccountId) -> getField("total");
        $former_current_user = M("person_card") -> where("id='%s'", $userid) -> getField("current_deposit");
        $former_current_to_account = M("person_card") -> where("id='%s'", $toAccountId) -> getField("current_deposit");
        if ($former_deposit < $num){
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "转账金额已超出活期余额"
            );
        }else {
            //用户转账后的总额
            $current_deposit = $former_deposit - $num;
            //对方转账后的总额
            $current_deposit1 = $former_deposit1 + $num;
            //用户转账后的活期余额
            $former_current_user1 = $former_current_user - $num;
            //对方转账后的活期余额
            $former_current_to_account1 = $former_current_to_account + $num;
            $result = M("person_card") -> where("id='%s'", $userid) -> setField("total", $current_deposit);
            $result1 = M("person_card") -> where("id='%s'", $toAccountId) -> setField("total", $current_deposit1);
            $result_user = M("person_card") -> where("id='%s'", $userid) -> setField("current_deposit", $former_current_user1);
            $result1_to_account = M("person_card") -> where("id='%s'", $toAccountId) -> setField("current_deposit", $former_current_to_account1);
            if (($this -> saveMessage(1, $num)) && $result && $result1 && $result_user && $result1_to_account){

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
        }

//}
        echo json_encode($arr);
    }

    public function getPersonCard(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_card");
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
        $result = $data -> where("u_id = '%s'", $userid) -> order("id desc") -> select();
        if ($result){
            $arr = array(
                "Code" => 200,
                "Data" => $result,
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
//  }
        echo json_encode($arr);
    }

    public function deletePersonCard(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_card");
        $now = date("y-m-d H:i:s");
        $token = I("post.token");
        $id = I("post.id");
        $client = strstr($token, "15");
//        if (strstr(strtotime($now), "15") - $client > 7200){
//            $arr = array(
//                "Code" => 203,
//                "Data" => "",
//                "Success" => false,
//                "Message" => "认证失败，请重新登陆"
//            );
//        }else{
        $result = $data -> where("id = '%s'", $id) -> delete();
        if ($result){
            $arr = array(
                "Code" => 200,
                "Data" => $result,
                "Success" => true,
                "Message" => "解绑成功"
            );
        }else {
            $arr = array(
                "Code" => 200,
                "Data" => "",
                "Success" => false,
                "Message" => "解绑失败"
            );
        }
//  }
        echo json_encode($arr);
    }

    public function addPersonCard(){
        header("Content-Type:text/html; charset=utf-8");
        $data = M("person_card");
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
        $condition["u_id"] = $userid;
        $condition["cardNum"] = $num;
        $result = $data -> add($condition);
        if ($result){
            $arr = array(
                "Code" => 200,
                "Data" => $result,
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
//  }
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