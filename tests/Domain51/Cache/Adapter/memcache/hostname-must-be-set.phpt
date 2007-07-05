--TEST--
Domain51_Cache_Adapter_memcache must be instantiated with a 'hostname' option
--SKIPIF--
<?php require dirname(__FILE__) . '/_skipif.inc'; ?>
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

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
