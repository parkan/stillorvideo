<?php

namespace MH;

abstract class Classifier {
    private $_distancesAll;
    protected $cvec;

    function distancesAll(){
    // array of distances between available frames
        if(empty($this->distancesAll)){
            $distancesAll = [];
            foreach(array_keys($this->cvec) as $i){
                for($j = 1; $j + $i < count($this->cvec); $j++){
                    $distancesAll[] = puzzle_vector_normalized_distance($this->cvec[$i],$this->cvec[($i + $j)]);
                }
            }
            $this->_distancesAll = $distancesAll;
        }

        return $this->_distancesAll;
    }

    function distanceSum(){
    // sum of differences
        return array_sum($this->distancesAll());
    }

    function distanceVariance(){
    // variance of frame differences
        return stats_variance($this->distancesAll(), true); // 2nd arg must be true for classical variance
    }

    function distanceThreshCount(){
    // count of thresholds exceeded
        $over_thresh = 0;
        foreach($this->distancesAll() as $d){
            $over_thresh += ($d > PUZZLE_CVEC_SIMILARITY_THRESHOLD ? 1 : 0);
        }
        return $over_thresh;
    }
}

class YTThumbClassifier extends Classifier {
    private $base_url = "http://img.youtube.com/vi/%s/%u.jpg"; // TODO: implement this via API instead of uri substitution (?)
    private $yt_videoid;

    function getThumbCvec($i){
        // get thumb
        $url = sprintf($this->base_url, $this->yt_videoid, $i);
        $ch = curl_init($url);
        $fn = "/tmp/" . $this->yt_videoid . "_" . $i . ".jpg";
        $fp = fopen($fn, "w");
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        // calculate vectors
        $this->cvec[] = puzzle_fill_cvec_from_file($fn);
        unlink($fn);
    }

    function __construct($yt_videoid){
        $this->yt_videoid = $yt_videoid;
        $this->cvec = [];
        foreach([0,1,2,3] as $i){
            $this->getThumbCvec($i);
        }
    }
}

class ExtraThumbClassifier extends Classifier {
    function __construct($yt_videoid){
        $this->cvec = [];
        // TODO: $this->getVideo();
        // TODO: while($this->getFrame()){}
        // ...
    }
}
