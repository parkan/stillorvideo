#!/usr/local/bin/php
<?php

$model = new SVMModel(); // FIXME: load/make model
$c = new MH/Classifier($model);
$yt_videoid = $argv[1];

print classify($yt_videoid);
