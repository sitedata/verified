<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\verified\Module;
use humhub\modules\verified\models\ConfigureForm;
use humhub\modules\content\widgets\ContainerProfileHeader;
use humhub\modules\user\models\User;

use Yii;

class ContainerProfileHeaderOverwrite extends ContainerProfileHeader
{	
	public $verifiedIcon;
	
	public function init()
	{
	    parent::init();
		
		$verifiedUser = Yii::$app->getModule('verified')->getVerifyUser();
		
		if (in_array($this->container->guid, $verifiedUser)) {
		    $this->verifiedIcon = ' ' . Yii::$app->getModule('verified')->getIcon();
		}
	}
	
	    public function run()
    {
        return $this->render('containerProfileHeader', [
            'options' => $this->getOptions(),
            'container' => $this->container,
            'canEdit' => $this->canEdit,
            'title' => $this->title,
            'subTitle' => $this->subTitle,
            'classPrefix' => $this->classPrefix,
            'coverCropUrl' => $this->coverCropUrl,
            'imageCropUrl' => $this->imageCropUrl,
            'imageDeleteUrl' => $this->imageDeleteUrl,
            'coverDeleteUrl' => $this->coverDeleteUrl,
            'imageUploadUrl' => $this->imageUploadUrl,
            'coverUploadUrl' => $this->coverUploadUrl,
            'imageUploadName' => $this->imageUploadName,
            'coverUploadName' => $this->coverUploadName,
            'headerControlView' => $this->headerControlView,
			'verifiedIcon' => $this->verifiedIcon
        ]);
    }
	
	public function getViewPath() {
		return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
	}
}
