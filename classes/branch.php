<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class branch{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_branch($branchName){
            $branchName = $this->fm->validation($branchName);
            $branchName = mysqli_real_escape_string($this->db->link, $branchName);
            if(empty($branchName)){
                $alert = "Branch must be not empty";
                return $alert;
            }else{
                $query = "Insert into tbl_branch(branchName) values ('$branchName')";
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
        public function show_branch(){
            $query = "Select * from tbl_branch order by branchId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getBranchById($id){
            $query = "Select * from tbl_branch where branchId='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_branch($branchName, $id){
            $branchName = $this->fm->validation($branchName);
            $branchName = mysqli_real_escape_string($this->db->link, $branchName);
            if(empty($branchName)){
                $alert = "Branch is not empty";
                return $alert;
            }else{
                $query = "Update tbl_branch set branchName = '$branchName' where branchId='$id' ";
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
        public function delete_branch($id){
            $query = "delete from tbl_branch where branchId='$id'";
            $result = $this->db->delete($query);
            return $result;
        }

        
        
    }
?>