<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php 
class slider{
    private $db;
    private $fm;
    public function __construct(){
        $this ->db = new Database();
        $this ->fm = new Format(); 
    }
    public function show(){
        $query = "select * from tbl_slider";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete($sliderId){
        $query = "delete from tbl_slider where sliderId='$sliderId'";
        $result = $this->db->delete($query);
        if($result){
            $alert ='<span style="color:green" class="badge badge-success">Success</span>';
            return $alert;
        }else{
            $alert ='<span class="badge badge-danger">danger</span>';
            return $alert;
        }
    }
    public function showHome(){
        $query = "select * from tbl_slider where type='1'";
        $result = $this->db->select($query);
        return $result;
    }
    public function changeStatus($sliderId, $type){
        $type = mysqli_real_escape_string($this->db->link, $type);
        $sliderId = mysqli_real_escape_string($this->db->link, $sliderId);
        $query = "update tbl_slider set type='$type' where sliderId='$sliderId'";
        $result = $this->db->update($query);
        if($result){
            $alert ='<span style="color:green" class="badge badge-success">Success</span>';
            return $alert;
        }else{
            $alert ='<span class="badge badge-danger">danger</span>';
            return $alert;
        }

    }
    public function add($data, $file){
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        
        
        //kiem tra hinh anh

        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name); // tách phẩn từ sau dấu chấm
        $file_ext = strtolower(end($div)); // lấy phẩn từ cuối cùng
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext; // mã hóa và cẳt từ 0->10 sau đó . đuôi của file
        $uploaded_image = "uploads/".$unique_image; // thư mục đích

        if($sliderName == "" || $type == ""|| $file_name == ""){
            $alert = "Field must be not empty";
            return $alert;
        }else{
            //move_uploaded_file(file, path)
            //file	- Tập tin được tải lên	 path : Chỉ định nơi lưu tập tin được tải lên.
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "Insert into tbl_slider(sliderName,type,image)
             values('$sliderName','$type','$unique_image')";
             $result = $this->db->insert($query);
            if($result){
                $alert ='<span style="color:green" class="badge badge-success">Success</span>';
                return $alert;
            }else{
                $alert ='<span class="badge badge-danger">danger</span>';
                return $alert;
            }
        }
    }
}

?>