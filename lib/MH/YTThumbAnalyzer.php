<?php

namespace MH;

class YTThumbAnalyzer extends Analyzer {
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
