<?php

namespace App\ModelMapper;

use App\Model\Category;
use App\ModelMapper\BaseMapper;

class CategoryMapper extends BaseMapper
{
    public function create(Category $model)
    {
        $sql = "INSERT INTO category (name, description, published, dateCreated, dateModified)
            VALUES (:name, :description, :published, :dateCreated, :dateModified)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $model->getName(),
            "description" => $model->getDescription(),
            "published" => $model->getPublished(),
            "dateCreated" => $model->getDateCreated(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not create record");
        }
    }

    public function readAll() 
    {
        $sql = "SELECT id, name, slug, description, published, dateCreated, dateModified FROM category
            ORDER BY name";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new Category($row);
        }
        return $results;
    }

    public function read($id) 
    {
        $sql = "SELECT id, name, slug, description, published, dateCreated, dateModified FROM category
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if($result) {
            return new Category($stmt->fetch());
        }
    }

    public function update(Category $model) {
        $sql = "UPDATE category SET name = :name, description = :description, published = :published, dateCreated = :dateCreated, dateModified = :dateModified
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $model->getId(),
            "name" => $model->getName(),
            "description" => $model->getDescription(),
            "published" => $model->getPublished(),
            "dateCreated" => $model->getDateCreated(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}
