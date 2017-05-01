<?php

namespace App\ModelMapper;

use App\Model\About;
use App\ModelMapper\BaseMapper;

class AboutMapper extends BaseMapper
{
    public function read() {
        $sql = "SELECT body, dateModified FROM about";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(); 
        if($result) {
            return new About($stmt->fetch());
        }
    }

    public function update(About $model) {
        $sql = "UPDATE about SET body = :body, dateModified = :dateModified";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "body" => $model->getBody(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
}
