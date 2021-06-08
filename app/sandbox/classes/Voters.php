<?php

/**
 * Created by PhpStorm.
 * User: Ivor Szaniszló
 * Date: 09/05/2018
 * Time:10:10 PM
 */
class Voters
{
    public function INSERT_VOTER($name, $username, $company, $employee_id) {
        global $db;

        //Check to see if the voter exists
        $sql = "SELECT *
                FROM voters
                WHERE name = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Elnézést, a szavazó már szerepel az adatbázisban.</div>";
        } else {
            //Insert voter
            $sql = "INSERT INTO voters(name, username, company, employee_id)VALUES(?, ?, ?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ssss",  $username, $name, $company, $employee_id);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Szavazó sikeresen hozzáadva.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_VOTERS() {
        global $db;

        $sql = "SELECT *
                FROM voters
                ORDER BY name ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function EDIT_VOTER($voter_id) {
        global $db;

        $sql = "SELECT *
                FROM voters
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $voter_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_VOTER($username, $name, $company, $employee_id, $voter_id) {
        global $db;

        $sql = "UPDATE voters
                SET name = ?, username = ?, company = ?, employee_id = ?
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssssi", $username, $name, $company, $employee_id, $voter_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Szavazó sikeresen frissítve.<a href='http://localhost/peopleawards_voting2019/app/sandbox/add_voters.php'><span class='glyphicon glyphicon-backward'></span></a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_VOTER($voter_id) {
        global $db;

        $sql = "DELETE FROM voters
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $voter_id);
        }

        if($stmt->execute()) {
            header("location: http://localhost/peopleawards_voting2019/app/sandbox/add_voters.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }
}