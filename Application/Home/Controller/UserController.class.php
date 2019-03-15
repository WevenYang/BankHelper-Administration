<?php
/**
 * Created by PhpStorm.
 * User: QQ594
 * Date: 2018/9/12
 * Time: 23:10
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller
{
        public function index(){
            $this -> assign("item1", $this -> getUser());
            $this -> display("index");
        }

        public function getUser(){
            $result = M("person_info") -> select();
            if ($result){
                foreach($result as $info){
                    $array[] = $info;
                }

            }
            return $array;
        }
}