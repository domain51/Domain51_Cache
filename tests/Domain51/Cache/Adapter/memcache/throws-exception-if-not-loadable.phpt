--TEST--
Domain51_Cache_Adapter_memcache throws an exception when the memcache extension isn't loaded
--SKIPIF--
<?php
if (extension_loaded('memcache')) {
    echo 'skip - memcache extension already loaded in memory by default';
}
?>
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache/Adapter/memcache.php';
try {
    new Domain51_Cache_Adapter_memcache(array('hostname' => 'localhost'));
    trigger_error('exception not caught');
} catch (Domain51_Cache_Adapter_memcache_Exception $e) {
    $expected = 'memcache extension not loaded';
    assert('$expected == $e->getMessage()');
}

// also thrown even if no host is provided
try {
    new Domain51_Cache_Adapter_memcache();
    trigger_error('exception not caught');
} catch (Domain51_Cache_Adapter_memcache_Exception $e) {
    $expected = 'memcache extension not loaded';
    assert('$expected == $e->getMessage()');
}
?>
===DONE===
--EXPECT--
===DONE===