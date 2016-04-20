<?php

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin', G_ADMIN_DIR, 'no');

class vote_admin extends admin {

    public function __construct() {
        parent::__construct();
        $this->ment = array(
            array("lists", "充值卡列表", ROUTE_M . '/' . ROUTE_C . ""),
            array("addcate", "添加充值卡", ROUTE_M . '/' . ROUTE_C . "/insert"),
        );
        $this->db = $this->DB();
    }

    //显示全部投票
    public function init() {
        $vote = $this->db->GetList("select * from `@#_czk`");
        include $this->tpl(ROUTE_M, 'vote.list');
    }

    //生成卡号
    public function sckh() {
        $i = 1;
        for ($i; $i < 12; $i++) {
            $aa = rand(1000, 9999);
            $bb = rand(1000, 9999);
            $cc = rand(1000, 9999);
            $result[] = $aa . $bb . $cc;
        }
        echo json_encode($result);
    }

    //添加投票
    public function insert() {


        if (isset($_POST["submit"])) {
           
            foreach ($_POST['czknum'] as $key => $value) {
                if ($value and $_POST['password'][$key]) {
                    $data[$key]['czknum'] = $value;
                    $data[$key]['password'] = $_POST['password'][$key];
                    $data[$key]['mianzhi'] = $_POST['mianzhi'][$key];
                    $data[$key]['type'] = $_POST['type'][$key];
                }
            }

            foreach ($data as $key => $value) {
//                $result[] = $fwczk->add($value);
                $this->db->Query("INSERT INTO `@#_czk`(czknum,password,mianzhi,type)VALUES('{$value['czknum']}','{$value['password']}','{$value['mianzhi']}','{$value['type']}')");
                $vote_id[] = $this->db->insert_id();
            }
//            for ($i = 0; $i < count($option); $i++) {
//
//                $this->db->Query("INSERT INTO `@#_vote_option`(vote_id,option_title)VALUES('$vote_id','$option[$i]')");
//            }

            _message("添加成功");
        }
        include $this->tpl(ROUTE_M, 'vote.insert');
    }

    //修改投票
    public function vote_update() {
        //$vote_id=intval($_GET['id']);
        $vote_id = $this->segment(4);


        $vote = $this->db->GetOne("select * from `@#_vote_subject`   where vote_id='$vote_id'");
        $vote_option = $this->db->GetList("select * from `@#_vote_option`     where vote_id='$vote_id'");


        if (!$vote)
            _message("参数错误");


        if (isset($_POST["submit"])) {
            if ($_POST['title'] == null)
                _message("投票名不能为空");
            $title = htmlspecialchars($_POST['title']);
            $option = $_POST['option'];
            $option_id = $_POST['option_id'];
            $starttime = $_POST['starttime'];
            $endtime = $_POST['endtime'];
            $description = $_POST['description'];
            $allowview = $_POST['allowview'];
            $allowguest = $_POST['allowguest'];
            $interval = $_POST['interval'];
            $enabled = $_POST['enabled'];


            $year = ((int) substr($starttime, 0, 4)); //取得年份

            $month = ((int) substr($starttime, 5, 2)); //取得月份

            $day = ((int) substr($starttime, 8, 2)); //取得几号

            $starttime = mktime(0, 0, 0, $month, $day, $year);


            $year = ((int) substr($endtime, 0, 4)); //取得年份

            $month = ((int) substr($endtime, 5, 2)); //取得月份

            $day = ((int) substr($endtime, 8, 2)); //取得几号

            $endtime = mktime(0, 0, 0, $month, $day, $year);




            $sendtime = time();


            $this->db->Query("UPDATE `@#_vote_subject` SET vote_title='$title',vote_starttime='$starttime',vote_endtime='$endtime',vote_sendtime='$sendtime',vote_description='$description',vote_allowview='$allowview',vote_allowguest='$allowguest',vote_interval='$interval',vote_enabled='$enabled'  where`vote_id`='$vote_id' ");



            for ($i = 0; $i < count($option); $i++) {

                if ($i > (count($option_id) - 1)) {

                    $this->db->Query("INSERT INTO `@#_vote_option`(vote_id,option_title)VALUES('$vote_id','$option[$i]')");
                } else {


                    $this->db->Query("UPDATE `@#_vote_option` SET option_title='$option[$i]' where `vote_id`='$vote_id' and `option_id`='$option_id[$i]' ");
                }
            }



            _message("修改成功", WEB_PATH . "/vote/vote_admin");
        }

        include $this->tpl(ROUTE_M, 'vote.update');
    }

    //显示投票总数
    public function vote_total() {
        //$vote_id=$_GET['id'];
        $vote_id = $this->segment(4);
        $vote_option = $this->db->getlist("select * from `@#_vote_option` where  `vote_id`='$vote_id'");


        $vote_total = 0;
        for ($i = 0; $i < count($vote_option); $i++) {
            $vote_total+=$vote_option[$i]['option_number'];
        }


        for ($i = 0; $i < count($vote_option); $i++) {
            if ($vote_total != 0) {
                $vote_number_total[$i] = round(($vote_option[$i]['option_number'] / $vote_total) * 100, 2);
            } else {
                $vote_number_total[$i] = 0;
            }
        }



        include $this->tpl(ROUTE_M, 'vote.total');
    }

    public function del() {

        $id=intval($_GET['id']);    
		$id = $this->segment(5);
        $result = $this->db->Query("DELETE FROM `@#_czk` where `id`='$id'");
        if ($result) {
            _message("删除成功");
        } else {
            _message("删除失败");
        }
    }

}

?>