<?php

if (!extension_loaded('memcache') && !@dl('memcache.so')) {
    echo "skip - memcache extension not available";
}
