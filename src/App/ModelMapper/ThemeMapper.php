<?php

namespace App\ModelMapper;

use App\Model\Theme;
use App\ModelMapper\BaseMapper;

class ThemeMapper extends BaseMapper
{
    public function read() {
        $sql = "SELECT colorScheme, bannerImage, backgroundImage, dateModified FROM theme";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(); 
        if($result) {
            return new Theme($stmt->fetch());
        }
    }

    public function update(Theme $model) {
        $sql = "UPDATE theme SET colorScheme = :colorScheme, bannerImage = :bannerImage, backgroundImage = :backgroundImage, dateModified = :dateModified";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "colorScheme" => $model->getColorScheme(),
            "bannerImage" => $model->getBannerImage(),
            "backgroundImage" => $model->getBackgroundImage(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
}
