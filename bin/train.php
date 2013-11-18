#!/usr/local/bin/php
<?php

// once per class
foreach($yt_videoids){
    $analyzer = new MH\YTThumbAnalyzer($yt_videoid);
    $dimensions = $analyzer->dimensions();
}

function createModel($file){
    $svm = new SVM();
    $model = $svm->train([
        $Classifier::ARTWORK => [],
        $Classifier::VIDEO => []
        ]);
    $model->save($file);
}
