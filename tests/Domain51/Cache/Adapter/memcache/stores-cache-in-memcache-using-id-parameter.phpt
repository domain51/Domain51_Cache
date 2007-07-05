--TEST--
If an 'id' option is passed in, Domain51_Cache_Adapter_memcache will store its cached data at that
variable.  If nothing is supplied, it will store the data in 'cache'.
--SKIPIF--
<?php require dirname(__FILE__) . '/_skipif.inc'; ?>
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

// sanity check
$memcache = new Memcache();
$memcache->connect('localhost');
$memcache->delete('cache');
$memcache->delete('some_custom_id');
sleep(1);

assert('$memcache->get("cache") === false');

$options = array(
    'hostname' => 'localhost',
);
$cache = new Domain51_Cache_Adapter_memcache($options);
$cache->foo = "bar";
$cache->save();

assert('$memcache->get("cache") !== false');

// sanity check
assert('$memcache->get("some_custom_id") === false');

$options['id'] = 'some_custom_id';
$cache = new Domain51_Cache_Adapter_memcache($options);
$cache->foo = 'bar';
$cache->save();

assert('$memcache->get("some_custom_id") !== false');

?>
===DONE===
--CLEAN--
<?php require dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===