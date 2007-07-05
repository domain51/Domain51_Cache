--TEST--
Calling unset() on a property stored by Domain51_Cache_Adapter_File causes it to be removed from
the cache upon the next Domain51_Cache_Adapter_File::save()
--FILE--
<?php
//BEGIN REMOVE
set_include_path(dirname(__FILE__) . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache/Adapter/File.php';
require_once '_setup.inc';

$base_dir = dirname(__FILE__) . '/cache';
$options = array(
    'base_dir' => $base_dir,
);
$cache = new Domain51_Cache_Adapter_File($options);
$cache->foo = 'bar';
assert('isset($cache->foo)');
$cache->save();
assert('isset($cache->foo)');
unset($cache);

$cache = new Domain51_Cache_Adapter_File($options);
assert('isset($cache->foo)');
unset($cache->foo);
assert('!isset($cache->foo)');
$cache->save();
assert('!isset($cache->foo)');
unset($cache);

$cache = new Domain51_Cache_Adapter_File($options);
assert('!isset($cache->foo)');

?>
===DONE===
--CLEAN--
<?php require_once '_cleanup.inc'; ?>
--EXPECT--
===DONE===