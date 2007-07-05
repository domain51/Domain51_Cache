--TEST--
When Domain51_Cache_Adapter_File::save() is invoked, the values it has in memory are seralized to
its file.
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
$cache->foo = 'bar';

$random = rand(100, 200);
$cache->random = $random;

$cache->save();

$contents = scandir($cache_dir);
assert('count($contents) > 2');

foreach ($contents as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }
    
    $cache_file = $cache_dir . '/' . $file;
    break;
}

assert('filesize($cache_file) > 0');
$cache_contents = file_get_contents($cache_file);
$array = unserialize($cache_contents);
$expected = array(
    'foo' => 'bar',
    'random' => $random,
);
assert('$array == $expected');


?>
===DONE===
--CLEAN--
<?php require_once '_cleanup.inc'; ?>
--EXPECT--
===DONE===