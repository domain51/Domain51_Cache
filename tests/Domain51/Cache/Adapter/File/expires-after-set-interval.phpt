--TEST--
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once '_setup.inc';

$base_dir = dirname(__FILE__) . '/cache';
$options = array(
    'base_dir' => $base_dir,
    'expire' => 2,
);
$cache = new Domain51_Cache_Adapter_File($options);
$cache->foo = 'bar';
$cache->save();
assert('isset($cache->foo)');
unset($cache);

$cache = new Domain51_Cache_Adapter_File($options);
assert('isset($cache->foo)');
unset($cache);

// wait for cache to expire
sleep(2);
$cache = new Domain51_Cache_Adapter_File($options);
assert('!isset($cache->foo)');

?>
===DONE===
--CLEAN--
<?php require_once '_cleanup.inc'; ?>
--EXPECT--
===DONE===