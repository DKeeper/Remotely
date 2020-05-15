<?php

namespace app\widgets\ClientForm\assets;

use yii\web\AssetBundle;

/**
 * Class MainAsset
 */
class MainAsset extends AssetBundle
{
    public $js = [
        'js/source.js',
    ];
    public $depends = [
        \yii\web\YiiAsset::class,
        \yii\bootstrap\BootstrapAsset::class,
        JsonRPCAsset::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'source';

        parent::init();
    }
}
