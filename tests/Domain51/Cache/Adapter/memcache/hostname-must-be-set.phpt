--TEST--
Domain51_Cache_Adapter_memcache must be instantiated with a 'hostname' option
--SKIPIF--
<?php
// todo: make this work with Windows too
if (!extension_loaded('memcache') && !@dl('memcache.so')) echo "skip - memcache extension not available";
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
    new Domain51_Cache_Adapter_memcache();
    trigger_error('exception not caught');
} catch (Domain51_Cache_Adapter_memcache_Exception $e) {
    $expected = "hostname option must be present";
    assert('$expected == $e->getMessage()');
}
?>
===DONE===
--EXPECT--
===DONE===
