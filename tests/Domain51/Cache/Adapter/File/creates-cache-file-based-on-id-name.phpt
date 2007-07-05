--TEST--
When saving a cache, the name of the 'id' option is used as the cache name.  If not present,
"cache-file" is used as the name.
--FILE--
<?php
//BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache/Adapter/File.php';

$cache_dir = dirname(__FILE__) . '/cache';
mkdir($cache_dir);
chmod($cache_dir, 0777);

$options = array(
    'base_dir' => $cache_dir,
);
$cache = new Domain51_Cache_Adapter_File($options);
$cache->save();
assert('file_exists($cache_dir . \'/cache-file\')');
unset($cache);

$random_id = 'id_' . rand(100, 200);
$options['id'] = $random_id;
$cache = new Domain51_Cache_Adapter_File($options);
$cache->save();
$expected_cache = "{$cache_dir}/{$random_id}";
assert('file_exists($expected_cache)');


?>
===DONE===
--CLEAN--
<?php require_once '_cleanup.inc'; ?>
--EXPECT--
===DONE===