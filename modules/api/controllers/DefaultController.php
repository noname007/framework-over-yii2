<?php

namespace app\modules\api\controllers;

use app\modules\api\RetBuilder;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return RetBuilder::buildRestRes("hello world");
    }
}
