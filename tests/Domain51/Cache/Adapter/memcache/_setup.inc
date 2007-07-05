<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

if (!extension_loaded('memcache')) {
    dl('memcache.so');
}
require_once 'Domain51/Cache/Adapter/memcache.php';