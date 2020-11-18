<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
class category{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if(empty($catName)){
            $alert = "Category must be not empty";
            return $alert;

        }else{
            $query = "Insert into tbl_category(catName) values('$catName')";
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
    public function show_category(){
        $query = "Select * from tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_category($catName,$id){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($catName)){
            $alert = "Category must be not empty";
            return $alert;

        }else{
            $query = "Update tbl_category set catName = '$catName' where catId='$id'";
            $result = $this->db->update($query);
            if($result){
                $alert ='<span style="color:green" class="badge badge-success">Success</span>';
                return $alert;
            }else{
                $alert ='<span class="badge badge-danger">danger</span>';
                return $alert;
            }
        }
    }
    public function getcatbyId($id){
        $query = "Select * from tbl_category where catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_category($id){
        $query = "Delete from tbl_category where catId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert ='<span style="color:green" class="badge badge-success">Success</span>';
            return $alert;
        }else{
            $alert ='<span class="badge badge-danger">danger</span>';
            return $alert;
        }
    }
    public function getProductByCatId($catId){
        $query = "Select * from tbl_product where catId = '$catId'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>