<?php

namespace MH;

abstract class Analyzer {
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
