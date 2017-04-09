<?php

namespace App\ModelMapper;

class SiteDetailMapper extends BaseMapper
{
    public function read() {
        $sql = "SELECT title, tagline, dateModified FROM sitedetail";
        $stmt = $this->db->query($sql);
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
