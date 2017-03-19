<?php

//session_start();
//include_once ("./session.php");
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/redirect.php");

class User {

//Logins
    public function regisrer_new() {
        global $mysqli;

        if (isset($_POST['reg'])) {
            $natid = ($_POST['natid']);
            $fname = ($_POST['fname']);
            $lname = ($_POST['lname']);
            $sex = ($_POST['sex']);
            $yob = ($_POST['birthday_day'] . "/" . $_POST['birthday_month'] . "/" . $_POST['birthday_year']);
            $email = ($_POST['email']);
            $pwd = sha1(($_POST['pwd']));
            $cpwd = sha1(($_POST['cpwd']));



            if ($pwd == $cpwd) {
                $query = "INSERT INTO `users` (`natid`, `fname`, `lname`, `sex`, `yob`, `email`, `pwd`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $type_array = array('i', 's', 's', 's', 's', 's', 's');
                $data_array = array($natid, $fname, $lname, $sex, $yob, $email, $pwd);

                if ($db->insert($query, $type_array, $data_array) == 1) {
                    Redirect::to("jobseeker.php?reg=1");
                    echo '<div class="alert alert-success" style="width:360px;">Successfilly registered. <a href="http://localhost/lima/public/home/jlogin.php?login=1">Click here to login</a></div>';
                } else {
                    Redirect::to("jobseeker.php?reg=0");
                    echo '<span class="my_error">NO of Affected rows error(' . $mysqli->errno . ')' . $mysqli->error . '</span>';
                }
            } else {
                echo '<div class="alert alert-error" style="width:360px; color:browm;">Registration Failed passwords.</div>';
            }
        }
    }

//User filenames to determine theeir actions and coockie storage(Not YET done!!)
    public function user_login() {
        global $db;

        //Use path to det user
        if (isset($_POST['login'])) {
            $username = "";
            $log_col = $_POST['liwth'];
            $user = $_POST['uname'];
            $pwd = sha1($_POST['pwd']);
            $login = $_POST['lias'];

//Chosing the col of table where to login fron
            switch ($log_col) {
                case "user":
                    $username = "uname";
                    break;
                case "cuser":
                    $username = "cuname";
                    break;
                case "employee":
                    $username = "employee_no";
                    break;
                case"job_seeker":
                    $username = "natid";
                    break;
                default :
                    echo 'ERROR DETERMINING USER CATEGORY!!!';
            }

//            echo '.' . $user . '.' . $pwd . '.' . $login . '.';
//            $query = "SELECT fname $username, pwd  FROM $login WHERE $username='$user' AND pwd='$pwd' ";
            $query = "SELECT $username, fname, pwd  FROM $login WHERE $username = ? AND pwd = ?";
            $type_array = array('s', 's');
            $data_array = array($user, $pwd);

            $res = $db->select($query, $type_array, $data_array);
            if (!empty($res)) {
                foreach ($res as $row) {
                    $_SESSION[$username] = $row[$username];
                    $empno = $_SESSION[$username];
                    $_SESSION['fname'] = $row['fname'];
                    echo 'Login success';
                    echo 'SESSION NAME' . $_SESSION['fname'];
                    Redirect::to("index.php?rdr=1");
                }
            } else {
                $query = "SELECT fname $username, pwd  FROM $login WHERE $username = ?";
                $type_array = array('s');
                $data_array = array($user);

                $res = $db->select($query, $type_array, $data_array);
                if (!empty($res)) {
                    echo 'Wrong password for ' . $user;
//                    echo '.' . $user . '.' . $pwd . '.' . $login . '.';
                } else {
                    echo 'The username does not exist';
                }
            }
        }
    }

  
    public function create_job_advert($pa, $nn, $ql, $dut, $ab4, $aby, $qr) {
        global $mysqli;

        if ($stm = $mysqli->prepare($qr)) {
            $stm->bind_param("sissss", $pa, $nn, $ql, $dut, $ab4, $aby);
        } else {
            echo 'Prepare failed';
        }
        try {
            $stm->execute();
            if ($mysqli->affected_rows === 1) {
                echo 'Advert added  successfully!!!';
            } else {
                echo 'NO AFFECTED ROWS' . $mysqli->error;
            }
        } catch (Exception $ex) {
            echo 'Error YoG!' . $ex->getMessage() . '  ' . $mysqli->error;
        }
    }

    public function make_enquiries($ug, $tt, $bdes, $q) {
        global $mysqli;

        if ($stm = $mysqli->prepare($q)) {
            $stm->bind_param("sss", $ug, $tt, $bdes);
        } else {
            echo 'Prepare failed';
        }
        try {
            $stm->execute();
            if ($mysqli->affected_rows === 1) {
                echo 'Enquiry submitted successfully!!!' . $mysqli->error;
            } else {
                echo 'Submission failed!!!' . $mysqli->error;
            }
        } catch (Exception $ex) {
            echo 'Error YoG1' . $ex->getMessage() . '  ' . $mysqli->error;
        }
    }

    public function request_workers($n, $d, $r, $bd, $ci, $ri, $dur, $q) {
        global $mysqli;

        if ($stm = $mysqli->prepare($q)) {
            $stm->bind_param("isssssi", $n, $d, $r, $bd, $ci, $ri, $dur);
        } else {
            echo 'Prepare failed' . $mysqli->error;
        }
        try {
            $stm->execute();
            if ($mysqli->affected_rows === 1) {
                echo 'Request submitted successfully...';
//                echo 'PO L  '.$pol;
            } else {
                echo 'No affected rows' . $mysqli->error;
            }
        } catch (Exception $ex) {
            echo 'Error Yog1' . $ex->getMessage() . '  ' . $mysqli->error;
        }
    }

    public function search($cs1, $cs2, $cs3, $st1, $ccn, $co, $q) {
        global $mysqli;
        $search = $mysqli->query($q);

        if ($search->num_rows <= 0) {
            echo 'No results for the search';
        } else {
            echo '<h4>Results are below' . '</h4>';
            while ($search_results = mysqli_fetch_assoc($search)) {
                echo 'One   ' . $search_results[$cs1] . '<br/>' . 'Two   ' . $search_results[$cs2] . '<br/>' . 'Three   ' . $search_results[$cs3] . '<br/>';
            }
        }
    }

    public function add_profile_pic($final_name) {
        if (isset($_POST['upload_pic'])) {
//    $fname = ($_POST['fname']);
            $bl_size = FALSE;
            $bl_name = FALSE;
            $bl_ext = FALSE;
            $upload = $_FILES['picture']['tmp_name'];
            //Checking name....
            if (strlen($final_name) <= 0) {
                $bl_name = FALSE;
                echo 'Name cannot be empty';
            } else {
                $bl_name = TRUE;
            }
            //checking size
            if ($_FILES['picture']['size'] <= 1024000) {
                $bl_size = TRUE;
            } else {
                $bl_size = FALSE;
                echo 'Image too large. Must be less than 1mb.';
            }
//checking type
            if (is_uploaded_file($upload)) {
                switch ($_FILES['picture']['type']) {
                    case "image/jpeg":
                        $extension = ".jpg";
                        $bl_ext = TRUE;
                        break;
                    case "image/gif":
                        $extension = ".gif";
                        $bl_ext = TRUE;
                        break;
                    case "image/png":
                        $extension = ".png";
                        $bl_ext = TRUE;
                        break;
                }
//        echo $bl_ext." AND ".$bl_name." AND ".$bl_size." AND ".$extension;
            } else {
//        echo $bl_ext." AND ".$bl_name." AND ".$bl_size." AND ".$extension;
            }//$bl_ext&&
            if ($bl_name && $bl_size && $bl_ext) {
                $pic_n_loc = "../images/" . $final_name . "" . $extension;
                $result = move_uploaded_file($upload, $pic_n_loc);
                if ($result) {
                    $query = "INSERT INTO `uploaded_pics` (`loc_name`, `userid`) VALUES (?,?)";
                    $uid = $final_name;
                    $db = new MySQLDatabase();
                    $mysqli = $db->connect_to_db();
                    if ($stm = $mysqli->prepare($query)) {
                        $stm->bind_param("si", $pic_n_loc, $uid);
                    } else {
                        echo 'prepare failed' . $mysqli->error;
                    }
                    try {
                        $stm->execute();
                        if ($mysqli->affected_rows === 1) {
                            echo '<br/>Insertion to DB SUCCESS!!!';
                        }
                    } catch (PDOException $e) {
                        echo 'ERROR' . $e->getMessage() . " " . $mysqli->error;
                    }

                    include ("../includes/image.inc.php");

//    $img_loc = "../images/phone.png";
//                    echo 'IMAGE SIZE = ';
//            print_r(getimagesize($pic_n_loc));

                    $thumb_loc = "../images/thumb_nails/thumb_" . $final_name . ".png";

                    create_thumbnail($pic_n_loc, $thumb_loc, 40, 40);

//                    echo 'Thub nail<br/>';
//            print_r(getimagesize($thumb_loc));
//                    echo '<img style = "border:1px solid black; border-radius:50%;" src="' . $thumb_loc . '" alt="Loading image"><br/>';

                    echo 'Upload successfull.<br/>';
                    echo '<img width = "500px" src="' . $pic_n_loc . '" alt="Loading image">';
//                    echo 'File uploaded successfully to' . $pic_n_loc;
                } else {
                    echo 'File upload failed';
                }
            } else {
                echo 'Failed. The file must be a .gif, .png or .jpeg image  and less than 1MB.';
            }
        } else {
            echo '<form enctype="multipart/form-data" action="#" method="post">
                    <input type="file" name="picture"   >
                    <input type="submit" class="btn btn-sm btn-info" name="upload_pic" value="Upload image" style="margin:10px 0 0 0;">
                </form>';
        }
    }

    public function change_pwd($table_name, $user_col, $pwd_col, $user) {

        if (isset($_POST['change_pwd'])) {

            global $db;
            $current = sha1($_POST['current']);
            $new = sha1($_POST['new']);
            $confirm = sha1($_POST['confirm']);

            //First confirm if the new password and confirm password are same with the case.
            switch ($new) {
                case $confirm: {

                        //if they are equall, go ahead and confirm if the entered current password is the true existing password
                        $query = "SELECT $user_col, $pwd_col FROM $table_name WHERE $user_col = ? AND $pwd_col = ?";
                        $type_array = array('i', 's');
                        $data_array = array($user, $current);

                        $res = $db->select($query, $type_array, $data_array);
                        if (!empty($res)) {
//                            echo '<br/>Correct Current password.';
                            foreach ($res as $row) {
                                $user = $row[$user_col];
                                $pwd = $row[$pwd_col];
//                                echo $user . ' AND ' . $pwd;
                            }
                            $query = "UPDATE $table_name SET $pwd_col = ? WHERE $user_col = ?";
                            $type_array = array('s', 'i');
                            $data_array = array($new, $user);

                            if ($db->insert($query, $type_array, $data_array) == 1) {
                                echo '<br/>Password changed successfully.';
                            } else {
                                echo '<br/>FAILED to change password!';
                            }
                        } else {
                            echo '<br/>Wrong old password.';
                        }

                        break;
                    }
                default :

                    echo 'Passwords do not match';
            }
        } else {
            ?>
            <style>
                label{
                    font-weight: 400;
                }
            </style>
            <form class="form-horizontal" role="form" method="post" action="" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 5px; width: 395px;">
                <legend style="text-align: center;">Change password.</legend>
                <div class="form-group">
                    <label class="control-label col-sm-5" for="">Current password:</label>
                    <div class="col-sm-7">
                        <input id="" class="" type="password" name="current"required placeholder="" maxlength="32" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5">New password:</label>
                    <div class="col-sm-7">
                        <input id="" class=" " type="password" name="new"required placeholder=""  maxlength="32">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-sm-5">Confirm password:</label>
                    <div class="col-sm-7">          
                        <input  id="" type="password" class=" " name="confirm" required placeholder=""  maxlength="32">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5"></label>
                    <div class="col-sm-4">
                        <input id="reg" class="btn btn-xs btn-primary" type="submit" name="change_pwd" value="Change password"/>
                    </div>
                    <div class="col-sm-7">
                    </div>
                </div>
            </form>
            <?php

        }
    }

}

$users = new User();
