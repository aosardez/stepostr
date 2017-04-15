<?php

namespace App\ModelMapper;

use App\Model\SiteDetail;
use App\ModelMapper\BaseMapper;

class SiteDetailMapper extends BaseMapper
{
    public function read() {
        $sql = "SELECT title, tagline, dateModified FROM sitedetail";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(); 
        if($result) {
            return new SiteDetail($stmt->fetch());
        }
    }

    public function update(SiteDetail $model) {
        $sql = "UPDATE sitedetail SET title = :title, tagline = :tagline, dateModified = :dateModified";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "title" => $model->getTitle(),
            "tagline" => $model->getTagline(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
}
