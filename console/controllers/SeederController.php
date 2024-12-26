<?php

namespace console\controllers;

use common\components\importsample\SampleData;
use yii\console\Controller;

class SeederController extends Controller
{
    public function actionIndex()
    {
		SampleData::importAllSampleData();
    }


}
