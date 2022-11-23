<?php 
    include_once("E_Department.php");
    include_once("E_Staff.php");
    include_once("E_Account.php");
    class Model_StaffDepartment {
        public function __construct() {}
        public function GetAllStaff() {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql="SELECT * FROM NHANVIEN";
            $rs = mysqli_query($link,$sql);
            $id = 0;
            while($row=mysqli_fetch_array($rs))
            {
                $IDNV = $row['IDNV'];
                $Hoten = $row['Hoten'];
                $IDPB = $row['IDPB'];
                $Diachi = $row['Diachi'];
                $staffs[$id++] = new Entity_Staff($IDNV, $Hoten, $IDPB, $Diachi);
                
            }
            return $staffs;

        }
        public function GetAllDepartment() {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql = "SELECT * FROM PHONGBAN";
            $rs = mysqli_query($link,$sql);
            $id = 0;
            while($row=mysqli_fetch_array($rs))
            {
                $IDPB = $row['IDPB'];
                $Tenpb = $row['Tenpb'];
                $Mota = $row['Mota'];
                $departs[$id++] = new Entity_Department($IDPB, $Tenpb, $Mota);
                
            }
            return $departs;
        }

        public function GetStaff($IDNV) {
            
            $staffList = $this->GetAllStaff();
            for($i = 0; $i < sizeof($staffList); $i++)
            {
                if($IDNV==$staffList[$i]->IDNV) {
                    return $staffList[$i];
                    break;
                }
               
            }
            return null;
        }

        public function GetDepart($IDPB) {
            
            $departs = $this->GetAllDepartment();
            for($i = 0; $i < sizeof($departs); $i++)
            {
                if($IDPB==$departs[$i]->IDPB) {
                    return $departs[$i];
                    break;
                }
               
            }
            return null;
        }


        public function GetStaffDepartment($IDPB) {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql="SELECT * FROM NHANVIEN WHERE IDPB='$IDPB'";
            $rs = mysqli_query($link,$sql);
            $id = 0;
            while($row=mysqli_fetch_array($rs))
            {
                $IDNV = $row['IDNV'];
                $Hoten = $row['Hoten'];
                $IDPB = $row['IDPB'];
                $Diachi = $row['Diachi'];
                $staffs[$id++] = new Entity_Staff($IDNV, $Hoten, $IDPB, $Diachi);
                
            }
            return $staffs;
        }
        public function SearchStaff($choice, $input) {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql="SELECT * FROM NHANVIEN WHERE $choice LIKE '%$input%'";
            $rs = mysqli_query($link,$sql);
            $id = 0;
            $staffs = null;
            while($row=mysqli_fetch_array($rs)) {
                $IDNV = $row['IDNV'];
                $Hoten = $row['Hoten'];
                $IDPB = $row['IDPB'];
                $Diachi = $row['Diachi'];
                $staffs[$id++] = new Entity_Staff($IDNV, $Hoten, $IDPB, $Diachi);
            }
            return $staffs;

        }

        public function GetAccount() {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql = "SELECT * FROM ADMIN";
            $rs = mysqli_query($link,$sql);
            $i = 0;
            $accountList = null;
            while($row=mysqli_fetch_array($rs)) {
                $Id = $row['Id'];
                $username = $row['username'];
                $password = $row['password'];
                $accountList[$i++] = new Entity_Account($Id, $username, $password);
            }
            return $accountList;

            
        }

        public function GetListIDPB() {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql = "SELECT * FROM PHONGBAN";
            $rs = mysqli_query($link,$sql);

            $i = 0;
            $listIDPB = null;
            while($row=mysqli_fetch_array($rs)) {
                $listIDPB[$i] = $row['IDPB'];
                $i++;
            }
            
            return $listIDPB;

        }

        public function AddStaff($idnv, $hoten, $idpb, $diachi) {
            $staff = $this->GetStaff($idnv);
            if($staff==null) 
            {
                $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
                $db_selected = mysqli_select_db($link,"dulieu");
                $sql = "INSERT INTO NHANVIEN (IDNV,Hoten,IDPB,Diachi) VALUE ('$idnv','$hoten','$idpb','$diachi')";
                $rs = mysqli_query($link,$sql);
                mysqli_close($link);
            }
            else {
                echo 'staff has been exist!';
            }
            
        }

        public function AddNewDepart($idpb, $tenpb, $mota) {
            $depart = $this->GetDepart($idpb);
            if($depart==null) 
            {
                $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
                $db_selected = mysqli_select_db($link,"dulieu");
                $sql = "INSERT INTO PHONGBAN (IDPB,Tenpb,Mota) VALUE ('$idpb','$tenpb','$mota')";
                $rs = mysqli_query($link,$sql);
                mysqli_close($link);
            }
            else {
                echo 'depart has been exist!';
            }
        }
        public function EditDepartment($idpb, $tenpb, $mota) {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql = "UPDATE phongban SET Tenpb = '$tenpb', Mota = '$mota' WHERE IDPB = '$idpb'";
            $result=mysqli_query($link, $sql);
            mysqli_close($link);
        }
        public function DeleteStaff($idnv) {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql = "DELETE FROM NHANVIEN WHERE IDNV='$idnv'";
            $result=mysqli_query($link, $sql);
            mysqli_close($link);
        }
        public function DeleteMultipleStaff($choice) {
            $link=mysqli_connect("localhost","root","") or die("Couldn't connect to database");
            $db_selected = mysqli_select_db($link,"dulieu");
            $sql="SELECT * FROM NHANVIEN";
            $result=mysqli_query($link, $sql);
            $i = 0;
            while($row=mysqli_fetch_array($result)) {
                if($row['IDNV'] == $choice[$i]){
                    $this->DeleteStaff($choice[$i]);
                    $i++;
                }
            }

            mysqli_close($link);
            
        }


    }

?>