<?php

namespace App\Model;

class Theme
{
	protected $name;
    protected $bannerImage;
    protected $backgroundImage;
    protected $dateModified;

	public function __construct(array $data) {
        $this->colorScheme = $data['name'] ?? null;
        $this->bannerImage = $data['bannerImage'] ?? null;
        $this->backgroundImage = $data['backgroundImage'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
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