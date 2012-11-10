<?php

//$yt_videoid = 'Hk3tURx8a2Q';
$yt_videoid = $argv[1];

$base_url = "http://img.youtube.com/vi/%s/%u.jpg"; // TODO: implement this via API instead of uri substitution
$cvec = [];

foreach([1,2,3] as $i){
    // get thumb
    $url = sprintf($base_url, $yt_videoid, $i);
    $ch = curl_init($url);
    $fn = "/tmp/" . $yt_videoid . "_" . $i;
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
foreach(array_keys($cvec) as $i){
    print "$i diffs: ";
    for($j = 1; $j < count($cvec); $j++){
        $d = puzzle_vector_normalized_distance($cvec[$i],$cvec[($i + $j) % count($cvec)]);
        print "(vs ".($i + $j) % count($cvec).")";
        print " $d ";
        $cdiff[] = $d;
    }
    print "\n";
}

$sum = array_sum($cdiff);
if ($sum < 2){
  echo "Static video ($sum)\n";
} else {
  echo "Music video ($sum)\n";
}

exit();

// Compute the distance between both signatures
//$d = puzzle_vector_normalized_distance($cvec1, $cvec2);
//die();

// Are pictures similar?
if ($d < PUZZLE_CVEC_SIMILARITY_LOWER_THRESHOLD) {
  echo "Pictures are looking similar\n";
} else {
  echo "Pictures are different, distance=$d\n";
}
