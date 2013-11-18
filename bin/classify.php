#!/usr/local/bin/php
<?php

function classify($yt_videoid){
    $model = new SVMModel('models/std.svm');
    $analyzer = new MH\YTThumbAnalyzer($yt_videoid);
    $dimensions = $analyzer->dimensions();

    $class = $model->predict($data);

    if($class === -1){
        //return STATIC;
    } elseif($class === 1){
        return MOTION;
    } else {
        // throw new Exception()...
    }
}

$yt_videoid = $argv[1];
print classify($yt_videoid);
