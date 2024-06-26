<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    use MainTrait;
    public function actionIndex()
    {
        return $this->render('index');
    }
}
