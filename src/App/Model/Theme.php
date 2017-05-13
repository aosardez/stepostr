<?php

namespace App\Model;

class Theme
{
	protected $name;
    protected $showSiteName;
    protected $showBannerImage;
    protected $bannerImagePath;
    protected $showBackgroundImage;
    protected $backgroundImagePath;
    protected $dateModified;

	public function __construct(array $data) {
        $this->name = $data['name'] ?? null;
        $this->showSiteName = $data['showSiteName'] ?? 0;
        $this->showBannerImage = $data['showBannerImage'] ?? 0;
        $this->bannerImagePath = $data['bannerImagePath'] ?? null;
        $this->showBackgroundImage = $data['showBackgroundImage'] ?? 0;
        $this->backgroundImagePath = $data['backgroundImagePath'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getShowSiteName() {
        return $this->showSiteName;
    }

    public function setShowSiteName($showSiteName) {
        $this->showSiteName = $showSiteName;
    }

    public function getShowBannerImage() {
        return $this->showBannerImage;
    }

    public function setShowBannerImage($showBannerImage) {
        $this->showBannerImage = $showBannerImage;
    }

    public function getBannerImagePath() {
        return $this->bannerImagePath;
    }

    public function setBannerImagePath($bannerImagePath) {
        $this->bannerImagePath = $bannerImagePath;
    }

    public function getShowBackgroundImage() {
        return $this->showBackgroundImage;
    }

    public function setShowBackgroundImage($showBackgroundImage) {
        $this->showBackgroundImage = $showBackgroundImage;
    }

    public function getBackgroundImagePath() {
        return $this->backgroundImagePath;
    }

    public function setBackgroundImagePath($backgroundImagePath) {
        $this->backgroundImagePath = $backgroundImagePath;
    }

    public function getDateModified() {
        return $this->dateModified;
    }

    public function setDateModified($dateModified) {
        $this->dateModified = $dateModified;
    }
}