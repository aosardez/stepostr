<?php

namespace App\ModelMapper;

use App\Model\PageStep;
use App\ModelMapper\BaseMapper;

class PageStepMapper extends BaseMapper
{
    public function create(PageStep $model)
    {
        $sql = "INSERT INTO pagestep (pageId, name, body, image)
            VALUES (:pageId, :name, :body, :image)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "pageId" => $model->getPageId(),
            "name" => $model->getName(),
            "body" => $model->getBody(),
            "image" => $model->getImage()
        ]);
        if(!$result) {
            throw new Exception("could not create record");
        }
    }

    public function readAllUnderPage($pageId) 
    {
        $sql = "SELECT id, pageId, name, body, image FROM pagestep
            WHERE pageId = :pageId 
            ORDER by id";
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
