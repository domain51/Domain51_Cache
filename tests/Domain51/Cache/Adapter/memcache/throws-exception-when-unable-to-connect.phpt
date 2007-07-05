--TEST--
Domain51_Cache_Adapter_memcache will throw an exception if it is unable to reach a memcache server
at a given host and/or port.
--SKIPIF--
<?php require dirname(__FILE__) . '/_skipif.inc'; ?>
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

try {
    new Domain51_Cache_Adapter_memcache(array(
        'hostname' => 'some-unknown-and-unknowable-host',
    ));
    trigger_error('exception not caught');
} catch (Domain51_Cache_Adapter_memcache_Exception $e) {
    $expected = "unable to connect to memcache server at some-unknown-and-unknowable-host:11211";
    assert('$expected == $e->getMessage()');
}

try {
    // use low number as these shouldn't have a memcached on them
    $random_port = rand(10, 80);
    new Domain51_Cache_Adapter_memcache(array(
        'hostname' => 'localhost',
        'port' => $random_port,
    ));
    trigger_error('expection not caught');
} catch (Domain51_Cache_Adapter_memcache_Exception $e) {
    $expected = "unable to connect to memcache server at localhost:{$random_port}";
    assert('$expected == $e->getMessage()');
}

?>
===DONE===
--EXPECT--
===DONE===