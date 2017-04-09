<?php

namespace App\ModelMapper;

use App\Model\PageLookup;
use App\ModelMapper\BaseMapper;

class PageLookupMapper extends BaseMapper
{
    public function readAll() 
    {
        $sql = "SELECT p.id, p.title, p.introduction, c.name AS categoryName, a.displayName AS authorName, u.displayName AS updaterName, p.dateCreated, p.dateModified FROM page p
            LEFT JOIN category c ON p.categoryId = c.id
            LEFT JOIN account a ON p.authorId = a.id
            LEFT JOIN account u ON p.updaterId = u.id
            WHERE p.published = 1
            ORDER BY p.dateCreated DESC";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new PageLookup($row);
        }
        return $results;
    }

    public function readAllByCategory($slug) 
    {
        $sql = "SELECT p.id, p.title, p.introduction, c.name AS categoryName, a.displayName AS authorName, u.displayName AS updaterName, p.dateCreated, p.dateModified FROM page p
            LEFT JOIN category c ON p.categoryId = c.id
            LEFT JOIN account a ON p.authorId = a.id
            LEFT JOIN account u ON p.updaterId = u.id
            WHERE p.published = 1 AND c.slug = :slug
            ORDER BY p.dateCreated DESC";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "slug" => $slug
        ]);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new PageLookup($row);
        }
        return $results;
    }

    public function readAllByKeywords($keywords) 
    {
        $sql = "SELECT DISTINCT p.id, p.title, p.introduction, c.name AS categoryName, a.displayName AS authorName, u.displayName AS updaterName, p.dateCreated, p.dateModified FROM page p
            LEFT JOIN category c ON p.categoryId = c.id
            LEFT JOIN account a ON p.authorId = a.id
            LEFT JOIN account u ON p.updaterId = u.id
            LEFT JOIN pagestep s ON p.id = s.pageId
            WHERE p.published = 1 AND p.title REGEXP :keywords OR p.introduction REGEXP :keywords OR p.body REGEXP :keywords OR p.conclusion REGEXP :keywords OR s.name REGEXP :keywords OR s.body REGEXP :keywords OR c.name REGEXP :keywords OR c.description REGEXP :keywords
            ORDER BY p.dateCreated DESC";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "keywords" => $keywords
        ]);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new PageLookup($row);
        }
        return $results;
    }
}
