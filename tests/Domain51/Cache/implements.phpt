--TEST--
Domain51_Cache implements Domain51_Cache_Adapter interface
--FILE--
<?php
//BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../src/' . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../support/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache.php';

$reflection = new ReflectionClass('Domain51_Cache');
assert('$reflection->implementsInterface("Domain51_Cache_Adapter")');

?>
===DONE===
--EXPECT--
===DONE===