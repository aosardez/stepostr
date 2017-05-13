<?php

namespace App\ModelMapper;

use App\Model\Account;
use App\ModelMapper\BaseMapper;

class AccountMapper extends BaseMapper
{
    public function create(Account $model)
    {
        $sql = "INSERT INTO account (username, password, displayName, active, admin, lastLoginDate, dateCreated, dateModified)
            VALUES (:username, :password, :displayName, :active, :admin, :lastLoginDate, :dateCreated, :dateModified)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "username" => $model->getUsername(),
            "password" => $model->getPassword(),
            "displayName" => $model->getDisplayName(),
            "active" => $model->getActive(),
            "admin" => $model->getAdmin(),
            "lastLoginDate" => $model->getLastLoginDate(),
            "dateCreated" => $model->getDateCreated(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not create record");
        }
        return $this->db->lastInsertId();
    }

    public function readAll() 
    {
        $sql = "SELECT id, username, password, displayName, active, admin, lastLoginDate, dateCreated, dateModified FROM account
            ORDER BY username";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new Account($row);
        }
        return $results;
    }

    public function read($id) 
    {
        $sql = "SELECT id, username, password, displayName, active, admin, lastLoginDate, dateCreated, dateModified FROM account
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if($result) {
            $row = $stmt->fetch();
            if($row != null) { 
                return new Account($row);
            }
            else {
                return null;
            }
        }
    }

    public function readByUsername($username) 
    {
        $sql = "SELECT id, username, password, displayName, active, admin, lastLoginDate, dateCreated, dateModified FROM account
            WHERE username = :username AND active = 1";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "username" => $username
        ]);
        if($result) {
            $row = $stmt->fetch();
            if($row != null) { 
                return new Account($row);
            }
            else {
                return null;
            }
        }
    }

    public function update(Account $model) {
        $sql = "UPDATE account SET username = :username, password = :password, displayName = :displayName, active = :active, admin = :admin, lastLoginDate = :lastLoginDate, dateCreated = :dateCreated, dateModified = :dateModified
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $model->getId(),
            "username" => $model->getUsername(),
            "password" => $model->getPassword(),
            "displayName" => $model->getDisplayName(),
            "active" => $model->getActive(),
            "admin" => $model->getAdmin(),
            "lastLoginDate" => $model->getLastLoginDate(),
            "dateCreated" => $model->getDateCreated(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM account WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}
