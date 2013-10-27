#!/usr/local/bin/php
<?php
require_once('classifier.php');

$yt_videoid = $argv[1];
print classify($yt_videoid);

