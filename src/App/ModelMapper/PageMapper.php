<?php

namespace App\ModelMapper;

use App\Model\Page;
use App\ModelMapper\BaseMapper;
use App\ModelMapper\PageStepMapper;

class PageMapper extends BaseMapper
{
    public function create(Page $model)
    {
        $sql = "INSERT INTO page (title, slug, introduction, body, conclusion, categoryId, authorId, updaterId, published, dateCreated, dateModified)
            VALUES (:title, :slug, :introduction, :body, :conclusion, :categoryId, :authorId, :updaterId, :published, :dateCreated, :dateModified)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "title" => $model->getTitle(),
            "slug" => $model->getSlug(),
            "introduction" => $model->getIntroduction(),
            "body" => $model->getBody(),
            "conclusion" => $model->getConclusion(),
            "categoryId" => $model->getCategoryId(),
            "authorId" => $model->getAuthorId(),
            "updaterId" => $model->getUpdaterId(),
            "published" => $model->getPublished(),
            "dateCreated" => $model->getDateCreated(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not create record");
        }
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function readAll($includeSteps) 
    {
        $sql = "SELECT id, title, slug, introduction, body, conclusion, categoryId, authorId, updaterId, published, dateCreated, dateModified FROM page
            ORDER BY dateCreated DESC";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            if ($includeSteps)
            {
                $stepMapper = new PageStepMapper($this->db);
                $steps = $stepMapper->readAllUnderPage($row['id']);
                $row['steps'] = $steps;
            }
            else
            {
                $row['steps'] = null;
            }
            $results[] = new Page($row);
        }
        return $results;
    }

    public function read($key) 
    {
        $sql = "SELECT id, title, slug, introduction, body, conclusion, categoryId, authorId, updaterId, published, dateCreated, dateModified FROM page
            WHERE id = :key OR slug = :key";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "key" => $key
        ]);
        if($result) {
            $row = $stmt->fetch();            
            $stepMapper = new PageStepMapper($this->db);
            $steps = $stepMapper->readAllUnderPage($row['id']);
            $row['steps'] = $steps;
            return new Page($row);
        }
    }

    public function update(Page $model) {
        $sql = "UPDATE page SET title = :title, slug = :slug, introduction = :introduction, body = :body, conclusion = :conclusion, categoryId = :categoryId, authorId = :authorId, updaterId = :updaterId, published = :published, dateCreated = :dateCreated, dateModified = :dateModified
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $model->getId(),
            "title" => $model->getTitle(),
            "slug" => $model->getSlug(),
            "introduction" => $model->getIntroduction(),
            "body" => $model->getBody(),
            "conclusion" => $model->getConclusion(),
            "categoryId" => $model->getCategoryId(),
            "authorId" => $model->getAuthorId(),
            "updaterId" => $model->getUpdaterId(),
            "published" => $model->getPublished(),
            "dateCreated" => $model->getDateCreated(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function delete($id) {
        $stepMapper = new PageStepMapper($this->db);
        $stepMapper->deleteAllUnderPage($id);
        $sql = "DELETE FROM page WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id
        ]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
    }
}
