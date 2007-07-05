--TEST--
When Domain51_Cache_Adapter_memcache::save() is called, all data is persisted to the memcache server
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
$cache->foo = 'bar';
assert('isset($cache->foo)');

$random = rand(100, 200);
$cache->random = $random;
assert('isset($cache->random)');

$cache->save();
unset($cache);

$memcache = new Memcache();
$memcache->connect('localhost');
$expected = array(
    'foo' => 'bar',
    'random' => $random,
);
assert('$expected == $memcache->get("cache")');

?>
===DONE===
--CLEAN--
<?php require_once dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===