<?php
require_once 'lib/MH/Classifier.php';

function classify($yt_videoid){
    $c = new MH\YTThumbClassifier($yt_videoid);
    $sum = $c->distanceSum();
    $thresh_count = $c->distanceThreshCount();

    if ($sum < 2){
        echo "Static video (sum: $sum thresh count: $thresh_count)\n";
    } else {
        echo "Music video (sum: $sum thresh count: $thresh_count)\n";
    }
}
