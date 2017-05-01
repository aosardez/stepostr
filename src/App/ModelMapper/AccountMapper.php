<?php

namespace App\ModelMapper;

use App\Model\Account;
use App\ModelMapper\BaseMapper;

class AccountMapper extends BaseMapper
{
    public function create(Account $model)
    {
        $sql = "INSERT INTO account (username, password, displayName, active, lastLoginDate, dateCreated, dateModified)
            VALUES (:username, :password, :displayName, :active, :lastLoginDate, :dateCreated, :dateModified)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "username" => $model->getUsername(),
            "password" => $model->getPassword(),
            "displayName" => $model->getDisplayName(),
            "active" => $model->getActive(),
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
        $sql = "SELECT id, username, password, displayName, active, lastLoginDate, dateCreated, dateModified FROM account
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
        $sql = "SELECT id, username, password, displayName, active, lastLoginDate, dateCreated, dateModified FROM account
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if($result) {
            return new Account($stmt->fetch());
        }
    }

    public function update(Account $model) {
        $sql = "UPDATE account SET username = :username, password = :password, displayName = :displayName, active = :active, lastLoginDate = :lastLoginDate, dateCreated = :dateCreated, dateModified = :dateModified
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $model->getId(),
            "username" => $model->getUsername(),
            "password" => $model->getPassword(),
            "displayName" => $model->getDisplayName(),
            "active" => $model->getActive(),
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
