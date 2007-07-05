--TEST--
Accessing properties will return the value that was stored in the cache by the same key
--SKIPIF--
<?php require dirname(__FILE__) . '/_skipif.inc'; ?>
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$cache = new Domain51_Cache_Adapter_memcache(
    array('hostname' => 'localhost')
);

$cache->foo = 'bar';
$random = rand(100, 200);
$cache->random = $random;
$cache->save();
unset($cache);

$cache = new Domain51_Cache_Adapter_memcache(
    array('hostname' => 'localhost')
);
assert('$cache->foo == "bar"');
assert('$cache->random == $random');

?>
===DONE===
--CLEAN--
<?php require dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===