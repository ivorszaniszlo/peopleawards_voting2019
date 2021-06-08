<?php

/**
 * Created by PhpStorm.
 * User: Ivor Szaniszló
 * Date: 09/05/2018
 * Time: 11:55 AM
 */
class Nominees
{

    public function INSERT_NOMINEE($org, $pos, $name, $employee_id) {
        global $db;

        //Check to see if the nominee already exists in the database.
        $sql = "SELECT *
                FROM nominees
                WHERE name = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows >= 0) {
            //Insert nominee
            $sql = "INSERT INTO nominees(org, pos, name, employee_id)VALUES(?, ?, ?, ?)";

            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("sssi", $org, $pos, $name, $employee_id);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Jelölt sikeresen hozzáadva</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_NOMINEE() {
        global $db;

        $sql = "SELECT *
                FROM nominees
                ORDER BY employee_id ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function EDIT_NOMINEE($nom_id) {
        global $db;

        $sql = "SELECT *
                FROM nominees
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $nom_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_NOMINEE($org, $pos, $name, $employee_id, $nom_id) {
        global $db;

        $sql = "UPDATE nominees
                SET org = ?, pos = ?, name = ?, employee_id = ?
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssssi", $org, $pos, $name, $employee_id, $nom_id);
        }
        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Sikeresen frissítve <a href='http://localhost/peopleawards_voting2019/app/sandbox/add_nominees.php'><span class='glyphicon glyphicon-backward'></span> </a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_NOMINEE($nom_id) {
        global $db;

        $sql = "DELETE FROM nominees
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $nom_id);
        }
        if($stmt->execute()) {
            header("location: http://localhost/peopleawards_voting2019/app/sandbox/add_nominees.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

    public function READ_NOM_BY_ORG_POS($org, $pos) {
        global $db;

        $sql = "SELECT *
                FROM nominees
                WHERE nominees.org = ?
                AND nominees.pos = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $org, $pos);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function COUNT_VOTES($candidate_id) {
        global $db;

        $sql = "SELECT candidate_id
                FROM votes
                WHERE candidate_id = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $candidate_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }
}