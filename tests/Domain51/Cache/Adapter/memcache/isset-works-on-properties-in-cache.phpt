--TEST--
Calling isset() on a property of the adapter will return true if the value is present in the cache.
--SKIPIF--
<?php
// todo: make this work with Windows too
if (!extension_loaded('memcache') && !@dl('memcache.so')) echo "skip - memcache extension not available";
?>
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$options = array(
    'hostname' => 'localhost',
);
$cache = new Domain51_Cache_Adapter_memcache($options);
assert('!isset($cache->foo)');
$cache->foo = 'bar';
assert('isset($cache->foo)');
$cache->save();
unset($cache);

$cache = new Domain51_Cache_Adapter_memcache($options);
assert('isset($cache->foo)');

?>
===DONE===
--CLEAN--
<?php require_once dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===