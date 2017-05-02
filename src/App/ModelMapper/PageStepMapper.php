<?php

namespace App\ModelMapper;

use App\Model\PageStep;
use App\ModelMapper\BaseMapper;

class PageStepMapper extends BaseMapper
{
    public function create(PageStep $model)
    {
        $sql = "INSERT INTO pagestep (pageId, name, `order`, body, imagePath)
            VALUES (:pageId, :name, :order, :body, :imagePath)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "pageId" => $model->getPageId(),
            "name" => $model->getName(),
            "order" => $model->getOrder(),
            "body" => $model->getBody(),
            "imagePath" => $model->getImagePath()
        ]);
        if(!$result) {
            throw new Exception("could not create record");
        }
    }

    public function read($id) 
    {
        $sql = "SELECT id, pageId, name, `order`, body, imagePath FROM pagestep
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if($result) {
            $row = $stmt->fetch();
            return new PageStep($row);
        }
    }

    public function readAllUnderPage($pageId) 
    {
        $sql = "SELECT id, pageId, name, `order`, body, imagePath FROM pagestep
            WHERE pageId = :pageId 
            ORDER by `order`";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "pageId" => $pageId
        ]);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new PageStep($row);
        }
        return $results;
    }

    public function update(PageStep $model) 
    {
        $sql = "UPDATE pagestep SET pageId = :pageId, name = :name, `order` = :order, body = :body, imagePath = :imagePath WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $model->getId(),
            "pageId" => $model->getPageId(),
            "name" => $model->getName(),
            "order" => $model->getOrder(),
            "body" => $model->getBody(),
            "imagePath" => $model->getImagePath()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM pagestep WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if(!$result) {
            throw new Exception("could not delete records");
        }
    }

    public function deleteAllUnderPage($pageId) {
        $sql = "DELETE FROM pagestep WHERE pageId = :pageId";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "pageId" => $pageId
        ]);
        if(!$result) {
            throw new Exception("could not delete records");
        }
    }
}
