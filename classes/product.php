<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
class product{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
        //echo substr(md5(time()),0,10);
    }
    public function show_product(){
        $query = "select tbl_product.*, tbl_category.catName, tbl_branch.branchName
        from ((tbl_product
        inner join tbl_category on tbl_product.catId = tbl_category.catId)
        inner join tbl_branch on tbl_product.branchId = tbl_branch.branchId)
        order by tbl_product.productId desc";
        //$query = "select * from tbl_product order by productId desc";

        $result = $this->db->select($query);
        return $result;
    }
    public function getProductById($id){
        $query = "select * from tbl_product where productId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function insert_product($data, $file){
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $branch = mysqli_real_escape_string($this->db->link, $data['branch']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
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

        if($productName == "" || $branch == "" || $category == "" || $productDesc == "" || $price == "" || $type == ""|| $file_name == ""){
            $alert = "Field must be not empty";
            return $alert;
        }else{
            //move_uploaded_file(file, path)
            //file	- Tập tin được tải lên	 path : Chỉ định nơi lưu tập tin được tải lên.
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "Insert into tbl_product(productName,catId,branchId,productDesc,type,price,image)
             values('$productName','$category','$branch','$productDesc','$type','$price','$unique_image')";
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
    public function update_product($data, $files,$id){
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $branch = mysqli_real_escape_string($this->db->link, $data['branch']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
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
        if($productName == "" || $branch == "" || $category == "" || $productDesc == "" || $price == "" || $type == ""){
            $alert = "Field must be not empty";
            return $alert;
        }else{
            if(!empty($file_name)){ //neu nguoi dung chon anh
                if($file_size > 80960){
                    $alert = "Image should be less than 8MB";
                    return $alert;
                }else if(in_array($file_ext, $permited)=== false){
                    $alert = "you only upload".implode(',',$permited);
                    return $alert;
                }
                else{
                    $query = "update tbl_product set 
                    productName= '$productName',
                    catId= '$category',
                    branchId = '$branch',
                    productDesc = '$productDesc',
                    type='$type',
                    price='$price',
                    image='$unique_image' 
                    where productId='$id'";
                }
            }else{
                //neu khong chon anh
                $query = "update tbl_product set 
                productName= '$productName',
                catId= '$category',
                branchId = '$branch',
                productDesc = '$productDesc',
                type='$type',
                price='$price'
                where productId='$id'";
            }
        $result = $this->db->update($query);
        move_uploaded_file($file_temp,$uploaded_image);
        if($result){
            $alert ='<span style="color:green" class="badge badge-success">Success</span>';
            return $alert;
        }else{
            $alert ='<span class="badge badge-danger">danger</span>';
            return $alert;
        }
        }
    }
    public function delete_product($id){
        $query = "delete from tbl_product where productId= '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert ='<span style="color:green" class="badge badge-success">Success</span>';
            return $alert;
        }else{
            $alert ='<span class="badge badge-danger">danger</span>';
            return $alert;
        }
    }


    //
    
    public function getProductNew(){
        $query = "select * from tbl_product order by productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAll(){
        $query = "select * from tbl_product";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProduct_Feathered(){
        $limit1page = 4;
        if(!isset($_GET['page'])){
            $page = 1;
        }else{
            $page = $_GET['page'];
        }
        $lay_sp = ($page-1)*$limit1page; // VD page  = 3 => $laysp = 8
        $query = "select * from tbl_product where type = '0' order by productId desc Limit $lay_sp,$limit1page";
        // lấy ra 8/4 2 trang + 4 sản phẩm tiếp theo của trang 3
        // lấy sản phẩm trong bản product giới hạn
        // lấy ra 4 sản phẩm tiếp theo 
        $result = $this->db->select($query);
        return $result;
    }
    public function getFullProductById($id){
        $query = "select tbl_product.*,tbl_category.catName,tbl_branch.branchName from
        tbl_product inner join tbl_category on tbl_product.catId = tbl_category.catId
        inner join tbl_branch on tbl_product.branchId = tbl_branch.branchId
        where productId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function search($txtSearch){
        $txtSearch = mysqli_real_escape_string($this->db->link, $txtSearch);
        $query = "select * from tbl_product where productName like '%$txtSearch%'";
        $result = $this->db->select($query);
        return $result;
    }




}
?>