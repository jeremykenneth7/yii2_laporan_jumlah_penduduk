<?php

namespace app\controllers;

use Yii;
use yii\web\ForbiddenHttpException;

trait MainTrait
{
    use \jeemce\controllers\AppMainTrait;

    public function canOr403($perm)
    {
        $this->as403(!Yii::$app->user->can($perm));
    }

    public function as403(bool $bool, $message = null)
    {
        if ($bool) {
            throw new ForbiddenHttpException($message ?: Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
}
