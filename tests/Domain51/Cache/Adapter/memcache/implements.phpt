--TEST--
Domain51_Cache_Adapter_memcache implements Domain51_Cache_Adapter
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache/Adapter/memcache.php';

$reflection = new ReflectionClass('Domain51_Cache_Adapter_memcache');
assert('$reflection->implementsInterface("Domain51_Cache_Adapter")');

?>
===DONE===
--EXPECT--
===DONE===
