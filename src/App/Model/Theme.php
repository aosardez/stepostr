<?php

namespace App\Model;

class Theme
{
	protected $name;
    protected $bannerImage;
    protected $backgroundImage;
    protected $dateModified;

	public function __construct(array $data) {
        $this->colorScheme = $data['name'];
        $this->bannerImage = $data['bannerImage'];
        $this->backgroundImage = $data['backgroundImage'];
        $this->dateModified = $data['dateModified'];
    }

    public function getName() {
        return $this->name;
    }

    public function getBannerImage() {
        return $this->bannerImage;
    }

    public function getBackgroundImage() {
        return $this->backgroundImage;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}