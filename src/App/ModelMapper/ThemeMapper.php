<?php

namespace App\ModelMapper;

use App\Model\Theme;
use App\ModelMapper\BaseMapper;

class ThemeMapper extends BaseMapper
{
    public function read() {
        $sql = "SELECT name, showBannerImage, bannerImagePath, showBackgroundImage, backgroundImagePath, dateModified FROM theme";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(); 
        if($result) {
            return new Theme($stmt->fetch());
        }
    }

    public function update(Theme $model) {
        $sql = "UPDATE theme SET name = :name, showBannerImage = :showBannerImage, bannerImagePath = :bannerImagePath, showBackgroundImage = :showBackgroundImage, backgroundImagePath = :backgroundImagePath, dateModified = :dateModified";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "name" => $model->getName(),
            "showBannerImage" => $model->getShowBannerImage(),
            "bannerImagePath" => $model->getBannerImagePath(),
            "showBackgroundImage" => $model->getShowBackgroundImage(),
            "backgroundImagePath" => $model->getBackgroundImagePath(),
            "dateModified" => $model->getDateModified()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
}
