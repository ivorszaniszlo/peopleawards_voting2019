<?php

/**
 * Created by PhpStorm.
 * User: Ivor Szaniszló
 * Date: 09/05/2018
 * Time: 2:24 PM
 */
class Voting
{
    public function READ_ORG() {
        global $db;

        $sql = "SELECT * FROM organization ORDER BY org ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

    public function READ_POSITION($org) {
        global $db;

        $sql = "SELECT *
                FROM positions
                WHERE org = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $org);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function READ_NOMINEES($org, $pos) {
        global $db;

        $sql = "SELECT *
                FROM nominees
                WHERE org = ?
                AND pos = ?";
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

    public function VALIDATE_VOTE($org, $pos, $voters_id) {
        global $db;

        //Check to see if the voter votes already
        $sql = "SELECT *
                FROM votes
                WHERE org = ?
                AND pos = ?
                AND voters_id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $org, $pos, $voters_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function VOTE_NOMINEE($org, $pos, $candidate_id, $voters_id) {
        global $db;

        //Check to see if the voter votes already
        $sql = "SELECT *
                FROM votes
                WHERE org = ?
                AND pos = ?
                AND voters_id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $org, $pos, $voters_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Egy jelöltre egyszer szavazhat!</div>";
        } else {
            //Vote successful.
            $sql = "INSERT INTO votes(org, pos, candidate_id, voters_id)VALUES(?, ?, ?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ssii", $org, $pos, $candidate_id, $voters_id);
            }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Sikeres szavazás.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }


}