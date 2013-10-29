<?php

function classify($yt_videoid){
    list($sum, $thresh_sum) = analyze($yt_videoid);

    if ($sum < 2){
        echo "Static video (sum: $sum thresh_sum: $thresh_sum)\n";
    } else {
        echo "Music video (sum: $sum thresh_sum: $thresh_sum)\n";
    }
}
