--TEST--
Domain51_Cache_Adapter_File loads data from the specified file makes it available via properties
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
);
$cache = new Domain51_Cache_Adapter_File($options);
assert('!isset($cache->foo)');
unset($cache);

$random = rand(100, 200);
file_put_contents(
    $base_dir . '/cache-file',
    serialize(
        array(
            'foo' => 'bar',
            'random' => $random,
        )
    )
);

$cache = new Domain51_Cache_Adapter_File($options);
assert('isset($cache->foo)');
assert('$cache->random == $random');

?>
===DONE===
--CLEAN--
<?php require_once '_cleanup.inc'; ?>
--EXPECT--
===DONE===
