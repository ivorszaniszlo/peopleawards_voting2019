<?php

/**
 * Created by PhpStorm.
 * User: Ivor Szaniszló
 * Date: 09/05/2018
 * Time: 4:01 PM
 */
class EmployeeLogin
{
    private $_employee_id;
    public $_password;

    public function __construct($c_employee_id, $c_password) {
        $this->_employee_id = $c_employee_id;
        $this->_password = $c_password;
    }

    public function EmpLogin() {
        global $db;
        //Start session
        session_start();

        //Array to store error message
        $error_msg_array = array();

        //Error messages
        $error_msg = FALSE;

        if($this->_employee_id == "") {
            $error_msg_array[] = "Kérem írja be a vállalati emailcímét";
            $error_msg = TRUE;
        }

        if($error_msg) {
            $_SESSION['ERROR_MSG_ARRAY'] = $error_msg_array;
            $error_msg_array[] = "Elnézését kérjük, a jelszó nem található az adatbázisban.";
            header("http://localhost/peopleawards_voting2019/app/sandbox/index.php");
            exit();
        }

        $sql = "SELECT * FROM voters WHERE employee_id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $this->_employee_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //Create session
            session_regenerate_id();
            $_SESSION['ID']      = $row['id'];
            $_SESSION['NAME']    = $row['name'];
            $_SESSION['EMPLOYEE_ID'] = $row['employee_id'];
            $username = $_SESSION['USERNAME'] = $row['username'];
            session_write_close();

            //check AD
            $password = $this->_password;
            $rtnCheckedData = checkLoginDataInActiveDirectory($username,$password);
            if($rtnCheckedData) {
            header("location: http://localhost/peopleawards_voting2019/app/sandbox/emp_page.php");
            }
            else {
                $error_msg_array[] = "A elszó helytelen, kérem próbálja újra.";
                $error_msg = TRUE;
                header("location: http://localhost/peopleawards_voting2019/app/sandbox/process/error.php");
                exit();
            }
            $stmt->free_result();
        } else {
            $error_msg_array[] = "Az emailcím helytelen, kérem próbálja újra.";
            $error_msg = TRUE;

            if($error_msg) {
                $_SESSION['ERROR_MSG_ARRAY'] = $error_msg_array;
                header("location: http://localhost/peopleawards_voting2019/app/sandbox/index.php");
                exit();
            }
            $stmt->free_result();
        }
        $result->free();
        return $result;
    }
}