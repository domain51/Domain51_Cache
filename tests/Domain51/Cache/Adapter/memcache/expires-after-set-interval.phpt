--TEST--
If the 'expire' option is set, the cache will expire after that interval in seconds has elapsed
--SKIPIF--
<?php require dirname(__FILE__) . '/_skipif.inc'; ?>
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$options = array(
    'hostname' => 'localhost',
    'expire' => 2,
);
$cache = new Domain51_Cache_Adapter_memcache($options);
$cache->foo = 'bar';
$cache->save();
assert('isset($cache->foo)');
unset($cache);

sleep(3);
$cache = new Domain51_Cache_Adapter_memcache($options);
assert('!isset($cache->foo)');

?>
===DONE===
--EXPECT--
===DONE===