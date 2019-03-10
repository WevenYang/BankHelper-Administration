<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
     //   $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this -> display("index");
    }

//    /**
//     * 登陆接口
//     */
//    public function login()
//    {
//        $condition['account'] = I('get.account');
//        $condition['password'] = I('get.password');
//        $list = M("module_login")->where($condition)->find();
//        if ($list) {
////            echo json_encode($list);
//            $token =md5($condition['account'])."-".md5($condition['password'])."-".time();
//            echo "{
//                    \"code\": 200,
//                    \"token\": \"".$token."\",
//                    \"result\": \"登录成功\",
//                    \"data\": ".json_encode($list)."
//                }";
//        } else {
//            echo
//            "{
//    \"code\": 202,
//    \"token\": \"\",
//    \"result\": \"登录失败\",
//    \"data\": \"{}\"
//}";
//        }
//    }

    public function uploadAllOrder(){
        $type = I('get.type');
        switch ($type){
            case 0:
                //采购管理
                $table = M("purchase");
                break;
            case 1:
                //维修管理
                $table = M("repair");
                break;
            case 2:
                //故障管理
                $table = M("hitch");
                break;
            case 3:
                //借还管理
                $table = M("borrow");
                break;
            case 4:
                //报废管理
                $table = M("dump");
                break;
        }
        $con['title'] = I('get.title');
        $con['content'] = I('get.content');
        $con['date'] = I('get.date');
        $con['status'] = I('get.status');
        $con['apply_man'] = I('get.man');
        $table -> add($con);
        if ($table){
            $data = array(
                "code" => 200,
                "data" => "提交成功，等待回复",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "提交失败，请重试",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function login(){
        $condition["account"] = I('get.account');
        $condition["password"] = I('get.password');
//        $acc = input('post.acc');
//        $psd = input('post.psd');
//        $data = Db::query('select * from module_login where account = '.$acc.' and password = '.$psd);
//        $data = Db::table('module_login')->where('account', $acc)->find();
        $data = M("login") -> where($condition) -> find();
        if ($data){
            $arr = array(
                "code" => 200,
                "data" => "登录成功",
                "success" => true
            );
        }else{
            $arr = array(
                "code" => 403,
                "data" => "登录失败",
                "success" => false
            );
        }
        echo json_encode($arr);
    }

    public function register(){
        $acc = I('get.acc');
        $psd  = I('get.psd');
        $nick = I('get.nick');
        $sex = I("get.sex");
        $role = I("get.role");
        //查询是否有该用户注册过
        $con['account'] = $acc;
        $con['password'] = $psd;
        $data = M('login') -> where($con) -> find();
        $con['nick'] = $nick;
        $con['sex'] = $sex;
        $con['role'] = $role;
        if ($data){
            $arr = array(
                "code" => 404,
                "data" => "",
                "message" => "已存在该用户",
                "success" => false
            );
        }else{
            $list = M('login') -> add($con);
//            $list = Db::execute('insert into module_register (account, password, nick, sex, introduce)
//                                  values (?, ?, ?, ?, ?)', [$acc, $psd, $nick, $sex, $introduce]);
            if ($list){
                $arr = array(
                    "code" => 403,
                    "data" => $list,
                    "message" => "注册成功",
                    "success" => false
                );
            }else{
                $arr = array(
                    "code" => 403,
                    "data" => $data,
                    "message" => "注册失败",
                    "success" => false
                );
            }

        }
        echo json_encode($arr);
    }

    public function getHitchOrder(){
        $table = M('hitch');
        $data = $table -> select();
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function getRepairOrder(){
        $table = M('repair');
        $data = $table -> select();
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function getDumpOrder(){
        $table = M('dump');
        $data = $table -> select();
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function getPurchaseOrder(){
        $table = M('purchase');
        $data = $table -> select();
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function getBorrowOrder(){
        $table = M('borrow');
        $data = $table -> select();
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function getAllOrder(){
        $bo = M('borrow') -> select();
        $pu = M('purchase') -> select();
        $du = M('dump') -> select();
        $hi = M('hitch') -> select();
        $re = M('repair') -> select();
        $data = array_merge($pu, $re, $hi, $bo, $du);
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function myMachine(){
        $table = M('mymachine');
        $data = $table -> select();
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function allMachine(){
        $table = M('machinelist');
        $data = $table -> select();
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function getDataCalc(){
        $borrowNum = M("borrow") -> count();
        $dumpNum = M("dump") -> count();
        $hitchNum = M("hitch") -> count();
        $purchaseNum = M("purchase") -> count();
        $repairNum = M("repair") -> count();
        $borrowFromNum = M("mymachine") -> count();
        $allNum = $borrowNum+$dumpNum+$hitchNum+$purchaseNum+$repairNum;
        $data = array(
            "borrowNum" => $borrowNum,
            "dumpNum" => $dumpNum,
            "hitchNum" => $hitchNum,
            "purchaseNum" => $purchaseNum,
            "repairNum" => $repairNum,
            "allNum"=> $allNum,
            "borrowFromNum" => $borrowFromNum
        );
        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "获取成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "获取失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function disposeTheOrder(){
        $array["id"] = I("get.id");
        $types = I("get.type");
        if ($types == 0){
            //通过该工单
            $data = M('purchase') -> where($array) -> setField('status', '0');
        }else if ($types == -1){
            //拒绝该工单
            $data = M('purchase') -> where($array) -> setField('status', '-1');
        }

        if ($data){
            $data = array(
                "code" => 200,
                "data" => $data,
                "message" => "加载成功",
                "success" => true
            );
        }else{
            $data = array(
                "code" => 403,
                "data" => "",
                "message" => "加载失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function t_getFilterOrder(){
        $type = I('get.type');
        switch ($type){
            case 0:
                //采购管理
                $table = M("purchase");
                break;
            case 1:
                //维修管理
                $table = M("repair");
                break;
            case 2:
                //故障管理
                $table = M("hitch");
                break;
            case 3:
                //借还管理
                $table = M("borrow");
                break;
            case 4:
                //报废管理
                $table = M("dump");
                break;
        }
        $data = $table -> select();
        if ($data){
            $data = array(
                "data" => $data,
                "code" => 200,
                "message" => "加载成功",
                "success" => true
            );
        }else{
            $data = array(
                "data" => "",
                "code" => 403,
                "dmessage" => "加载失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function t_verifyOrder(){
        $id = I('get.t_id');
        $type = I('get.type');
        $result = I('get_result');
        switch ($type){
            case 0:
                //采购管理
                $table = M("purchase");
                break;
            case 1:
                //维修管理
                $table = M("repair");
                break;
            case 2:
                //故障管理
                $table = M("hitch");
                break;
            case 3:
                //借还管理
                $table = M("borrow");
                break;
            case 4:
                //报废管理
                $table = M("dump");
                break;
        }
        if ($result == 0){
            $table -> status = 0;
        }else if ($result == -1){
            $table -> status = -1;
        }
        $data = $table -> where("id = $id") -> save();
        if ($data){
            $data = array(
                "data" => $data,
                "code" => 200,
                "message" => "审核成功",
                "success" => true
            );
        }else{
            $data = array(
                "data" => "",
                "code" => 403,
                "dmessage" => "审核失败",
                "success" => false
            );
        }
        echo json_encode($data);
    }

    public function t_reloadMachine(){
        $con['name'] = I("get.name");
        $con['t_id'] = I("get.t_id");
        $con['own'] = I("get.own");
        $con['cover'] = "https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2500398310,3060982317&fm=27&gp=0.jpg";
        $list = M('machinelist') -> add($con);
        if ($list){
            $arr = array(
                "code" => 200,
                "data" => $list,
                "message" => "提交成功",
                "success" => true
            );
        }else{
            $arr = array(
                "code" => 403,
                "data" => $list,
                "message" => "提交失败",
                "success" => false
            );
        }
        echo json_encode($arr);
    }
}