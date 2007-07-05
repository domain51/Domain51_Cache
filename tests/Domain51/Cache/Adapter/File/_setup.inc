<?php

require_once 'Domain51/Cache/Adapter/File.php';

$cache_dir = dirname(__FILE__) . '/cache';
mkdir($cache_dir);
chmod($cache_dir, 0777);
