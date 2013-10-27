<?php

function classify($yt_videoid){
    $base_url = "http://img.youtube.com/vi/%s/%u.jpg"; // TODO: implement this via API instead of uri substitution
    $cvec = [];

    foreach([0,1,2,3] as $i){
        // get thumb
        $url = sprintf($base_url, $yt_videoid, $i);
        $ch = curl_init($url);
        $fn = "/tmp/" . $yt_videoid . "_" . $i . ".jpg";
        $fp = fopen($fn, "w");
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        // calculate vectors
        $cvec[] = puzzle_fill_cvec_from_file($fn);
        unlink($fn);
    }

    // n-way compare
    $cdiff = [];
    $cthresh = [];
    foreach(array_keys($cvec) as $i){
        for($j = 1; $j + $i < count($cvec); $j++){
            print "$i: ";
            $d = puzzle_vector_normalized_distance($cvec[$i],$cvec[($i + $j)]);
            print "(vs ".($i + $j).")";
            print " $d ";
            $cdiff[] = $d;
            $cthresh[] = ($d > PUZZLE_CVEC_SIMILARITY_THRESHOLD ? 1 : 0);
            print "\n";
        }
    }

    $sum = array_sum($cdiff);
    $thresh_sum = array_sum($cthresh);
    if ($sum < 2){
        echo "Static video (sum: $sum thresh_sum: $thresh_sum)\n";
    } else {
        echo "Music video (sum: $sum thresh_sum: $thresh_sum)\n";
    }

    return $sum;
}
