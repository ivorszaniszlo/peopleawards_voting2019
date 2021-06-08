<?php

/**
 * Created by PhpStorm.
 * User: Ivor Szaniszló
 * Date: 09/05/2018
 * Time: 12:59 PM
 */
class Organization
{
    public function INSERT_ORG($organization) {
        global $db;

        //Check if the organization already exists in the database
        $sql = "SELECT *
                FROM organization
                WHERE org = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $organization);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sajnáljuk, a hozzáadni kívánt szervezet már létezik az adatbázisban.</div>";
        } else {
            //Successfully inserted
            $sql = "INSERT INTO organization(org)VALUES(?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("s", $organization);
            }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Új szervezet hozzáadva!</div>";
            }
            $stmt->free_result();
        }
        $result->free();
        return $stmt;
    }

    public function READ_ORG() {
        global $db;

        $sql = "SELECT * FROM organization";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

    public function EDIT_ORG($org_id) {
        global $db;

        $sql = "SELECT *
                FROM organization
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $org_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_ORG($org, $org_id) {
        global $db;

        $sql = "UPDATE organization
                SET org = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("si", $org, $org_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Sikeresen frissítve <a href='http://localhost/peopleawards_voting2019/app/sandbox/add_org.php'><span class='glyphicon glyphicon-backward'></span> </a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_ORG($org_id) {
        global $db;

        //Delete organization
        $sql = "DELETE FROM organization
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $org_id);
        }

        if($stmt->execute()) {
            header("location: http://localhost/peopleawards_voting2019/app/sandbox/add_org.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }
}