<?php
    include_once('../Model/M_StaffDepartment.php');

    class Ctrl_StaffDepartment {
        public function invoke() {
            //view xem thong tin va liet ke
            //xem thong tin phong ban
            if(isset($_GET['viewDetails']))
            {
                $model_staffDepartment = new Model_StaffDepartment();
                $departs = $model_staffDepartment->GetAllDepartment();
                include_once('../View/xemthongtinPB.html');
            }
            //tim kiem nhan vien
            else if(isset($_GET['searchStaff'])) {
                include_once('../View/SearchStaffs.html');
            }   
            else if(isset($_POST['search'])) {
                $choice = $_POST['choice'];
                $input = $_POST['txtInput'];
                $model_staffDepartment = new Model_StaffDepartment();
                $staffs = $model_staffDepartment->SearchStaff($choice, $input);
                if(!empty($staffs)) {
                    include_once('../View/SearchStaffsView.html');
                }
                else 
                {
                    echo 'error, array $staffs is empty';
                }
            }
            //xem thong tin NVPB
            else if(isset($_GET['IDPB'])) {
                $IDPB = $_GET['IDPB'];
                $model_staffDepartment = new Model_StaffDepartment();
                $staffDepart = $model_staffDepartment->GetStaffDepartment($IDPB);
                if(!empty($staffDepart)) {
                    include_once('../View/xemthongtinNVPB.html');
                }
                else 
                {
                    echo 'error not found';
                }
            }
            else if(isset($_GET['LoginPage'])) {
                header("Location:../View/LoginForm.html");
            }
            //xulidangnhap
            else if(isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $model_staffDepartment = new Model_StaffDepartment();
                $accList = $model_staffDepartment->GetAccount();
                if(!empty($accList)) {
                    $i = 0;
                    while($i != sizeof($accList)) {
                        if($username==$accList[$i]->username && $password==$accList[$i]->password) {
                            header("Location:../View/Menu.html");
                            $i++;
                        }
                    }
                    
                }
                else 
                {
                    echo 'error not found';
                }
            }
            //xu li them NV
            else if(isset($_GET['addstaff'])) {
                $model_staffDepartment = new Model_StaffDepartment();
                $listIDPB = $model_staffDepartment->GetListIDPB();
                
               
                include_once('../View/AddStaff.html');
            }
            else if(isset($_POST['add'])) {

                $idnv = $_POST['IDNV'];
                $hoten = $_POST['Hoten'];
                $idpb = $_POST['IDPB'];
                $diachi = $_POST['Diachi'];
                
                $model_staffDepartment = new Model_StaffDepartment();
                $staffs = $model_staffDepartment->AddStaff($idnv,$hoten,$idpb,$diachi);
                
                header("Location:C_StaffDepartment.php");
            }
            //xu li them phong ban
            else if(isset($_GET['addDepart'])) {
                header('Location:../View/AddDepart.html');
            }
            else if(isset($_POST['thempb'])) {
                $IDPB = $_POST['IDPB'];
                $Tenpb = $_POST['Tenpb'];
                $Mota = $_POST['Mota'];
                $model_staffDepartment = new Model_StaffDepartment();
                $model_staffDepartment->AddNewDepart($IDPB,$Tenpb,$Mota);
                header("Location:C_StaffDepartment.php?viewDetails='1'");

            }
            //xu li cap nhat
            else if(isset($_GET['update'])) {

                $model_staffDepartment = new Model_StaffDepartment();
                $departs = $model_staffDepartment->GetAllDepartment();
                include_once("../View/UpdateView.html");
            }
            else if(isset($_GET['IDPBtoUpdate'])) {
                $IDPB = $_GET['IDPBtoUpdate'];
                $model_staffDepartment = new Model_StaffDepartment();
                $depart = $model_staffDepartment->GetDepart($IDPB);
                include_once("../View/UpdateDepart.html");
            }
            else if(isset($_POST['capnhat'])) {
                $IDPB = $_POST['IDPB'];
                $Tenpb = $_POST['Tenpb'];
                $Mota = $_POST['Mota'];
                $model_staffDepartment = new Model_StaffDepartment();
                $model_staffDepartment->EditDepartment($IDPB,$Tenpb,$Mota);
                header("Location:C_StaffDepartment.php?update='1'");
            }
            //xu li xoa 
            else if(isset($_GET['deleteStaff'])) {
                $model_staffDepartment = new Model_StaffDepartment();
                $staffs = $model_staffDepartment->GetAllStaff();
                include_once("../View/DeleteStaff.html");
            }
            else if(isset($_GET['IDNVToDel'])) {
                $IDNV = $_GET['IDNVToDel'];
                $model_staffDepartment = new Model_StaffDepartment();
                $model_staffDepartment->DeleteStaff($IDNV);
                header("Location:C_StaffDepartment.php?deleteStaff='1'");
            }
            //xoa nhieu NV
            else if(isset($_GET['deleteMultiple'])) {
                $model_staffDepartment = new Model_StaffDepartment();
                $staffs = $model_staffDepartment->GetAllStaff();
                include_once("../View/DeleteMultipleStaffs.html");
            }
            else if(isset($_POST['xoanhieunhanvien'])) {
                $choice = $_POST['choice'];
                $model_staffDepartment = new Model_StaffDepartment();
                $model_staffDepartment->DeleteMultipleStaff($choice);
                header("Location:C_StaffDepartment.php?deleteMultiple='1'");
            }

            //xem thong tin nhan vien
            else {
                $model_staffDepartment = new Model_StaffDepartment();
                $staffs = $model_staffDepartment->GetAllStaff();
                include_once('../View/xemthongtinNV.html');
            }
            


        } 
    };

    $c_staff = new Ctrl_StaffDepartment();
    $c_staff->invoke();

?>