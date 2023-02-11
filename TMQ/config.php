<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");

$dbhost = 'localhost';
$dbname = 'thanhtri_test';
$dbusername = 'thanhtri_test';
$dbpassword = 'QRNuyU7)fd6Q';
//-- Kết Nối PDO --//

// Kiểm tra kết nối
try {
$db = new PDO("mysql:host=localhost;dbname=$dbname", $dbusername, $dbpassword);
$db->exec("set names utf8"); //Set bảng mã
} catch (PDOException $e) {
    //echo $e->getMessage();
    echo'Loi ket noi';
    exit;
}
     if (isset($_SESSION['uid']) && $_SESSION['uid']){
      //echo $_SESSION['uid'];
    $uid = $_SESSION['uid'];
    $TMQ  = $db->query("SELECT * FROM `TMQ_user` WHERE `uid` = '$uid' ")->fetch();
     }else{
         $TMQ = null;
     } 
     $time = date("d-m-Y");
     
     $website = $_SERVER['SERVER_NAME'];
     //lấy thời gian hoạt động web
     $timehoatdong = strtotime(date('2019-07-05 00:00:0'));
     $timehoatdong = (time()-$timehoatdong)/86400;
     

     //bộ đếm chung
     $thanhvien  = $db->query("SELECT * FROM `TMQ_user`")->rowCount();
     $giaodich  = $db->query("SELECT * FROM `TMQ_lichsu`")->rowCount();
     $soacc  = $db->query("SELECT * FROM `TMQ_baiviet`")->rowCount();
    $nickdaban = $db->query("SELECT COUNT(id) FROM `TMQ_baiviet` WHERE `trangthai` = '0'")->fetchColumn();
    $doanhthu = $db->query("SELECT SUM(giatien) FROM `TMQ_lichsu`")->fetchColumn();
    $uoctinh = $db->query("SELECT SUM(giatien) FROM `TMQ_baiviet`")->fetchColumn();
    $napthe = $db->query("SELECT SUM(giatien) FROM `TMQ_baiviet`")->fetchColumn();
    $dichvu = $db->query("SELECT SUM(giatien) FROM `TMQ_baiviet`")->fetchColumn();
    
    
    
    //bộ đếm theo ngày
    $user_ngay  = $db->query("SELECT * FROM `TMQ_user` WHERE `date` = '$time'")->rowCount();
    $giaodich_ngay  = $db->query("SELECT * FROM `TMQ_lichsu` WHERE `date` LIKE '%$time'")->rowCount();
    $soacc_ngay  = $db->query("SELECT * FROM `TMQ_baiviet` WHERE `time` LIKE '%$time'")->rowCount();
    $doanhthu_ngay = $db->query("SELECT SUM(giatien) FROM `TMQ_lichsu` WHERE `date` LIKE '%$time'")->fetchColumn();
    $nick_ngay = $db->query("SELECT * FROM `TMQ_lichsu` WHERE `date` LIKE '%$time'")->rowCount();
    $napthe_ngay = $db->query("SELECT SUM(menhgia) FROM `TMQ_napthe` WHERE `date` LIKE '%$time'")->fetchColumn();

   $db->exec("CREATE TABLE IF NOT EXISTS `TMQ_setting` (
  `key` text CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

/*$db->exec("INSERT INTO `TMQ_setting` (`key`, `text`) VALUES
('title', 'Xây dựng và phát triển bởi TMQ'),
('baotri', '0'),
('facebook', 'https://www.facebook.com/zTMQz'),
('phone', '0585589918'),
('name', 'Trần Minh Quang'),
('thongbao', '&lt;a href=&quot;/&quot;&gt;TMQ&lt;/a&gt;'),
('logo', 'https://demo2.tmquang.monster/admin/images/logo.png'),
('ck_ctv', '0.5'),
('odp_muanick', '0')"); */