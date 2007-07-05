<?php

// todo: fix for windows
@dl('memcache.so');

$mem = new Memcache();
$mem->connect('localhost');
$mem->delete('cache');
$mem->delete('some_cache_id');