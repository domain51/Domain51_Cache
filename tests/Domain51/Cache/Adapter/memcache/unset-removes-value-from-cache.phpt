--TEST--
unset() can be used to remove values from the cache.  This is only persisted when
Domain51_Cache_Adapter_memcache::save() is called after the unset().
--SKIPIF--
<?php require dirname(__FILE__) . '/_skipif.inc'; ?>
--FILE--
<?php

require dirname(__FILE__) . '/_setup.inc';

$options = array(
    'hostname' => 'localhost',
);
$cache = new Domain51_Cache_Adapter_memcache($options);    
$cache->foo = 'bar';
$cache->save();
assert('isset($cache->foo)');
unset($cache);

// doesn't persist - no save()
$cache = new Domain51_Cache_Adapter_memcache($options);
assert('isset($cache->foo)');
unset($cache->foo);
assert('!isset($cache->foo)');
unset($cache);

// persists - called save()
$cache = new Domain51_Cache_Adapter_memcache($options);
assert('isset($cache->foo)');
unset($cache->foo);
$cache->save();
assert('!isset($cache->foo)');
unset($cache);

$cache = new Domain51_Cache_Adapter_memcache($options);
assert('!isset($cache->foo)');

?>
===DONE===
--CLEAN--
<?php require dirname(__FILE__) . '/_skipif.inc'; ?>
--EXPECT--
===DONE===