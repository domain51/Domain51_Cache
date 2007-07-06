--TEST--
Domain51_Cache::factory() returns an object implementing Domain51_Cache_Adapter.
--FILE--
<?php
//BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../src/' . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../support/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache.php';

$adapter = Domain51_Cache::factory('NullForTesting');
assert('$adapter instanceof Domain51_Cache_Adapter');
assert('$adapter instanceof Domain51_Cache_Adapter_NullForTesting');

try {
    Domain51_Cache::factory('DoesNotImplement');
    trigger_error('exception not thrown');
} catch (Domain51_Cache_Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    Domain51_Cache::factory('UnknownAndUnknowable');
    trigger_error('exception not thrown');
} catch (Domain51_Cache_Exception $e) {
    echo $e->getMessage() . "\n";
}

?>
===DONE===
--EXPECT--
Requested adapter [Doesnotimplement] does not implement Domain51_Cache_Adapter
Requested adapter [Unknownandunknowable] does not exist
===DONE===