<?php

namespace MH;

class Classifier {
    protected $model;

    const VIDEO = 1;
    const ARTWORK = -1;

    function __construct($model){
        $this->model = $model;
    }

    function classify(){
        $analyzer = new MH\YTThumbAnalyzer($yt_videoid);
        $dimensions = $analyzer->dimensions();
        return $this->model->predict($dimensions);
    }

    function isVideo(){
        $class = $this->classify() 
        if($class === self::VIDEO){
            return true;
        } elseif($class === self::ARTWORK){
            return false;
        } else {
            // throw new Exception()...
        } 
    }
}
