--TEST--
Domain51_Cache_Adapter_File requires a base_dir option
--FILE--
<?php
//BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache/Adapter/File.php';

try {
    new Domain51_Cache_Adapter_File();
    trigger_error('exception not caught');
} catch (Domain51_Cache_Adapter_File_Exception $e) {
    echo $e->getMessage() . "\n";
}

?>
===DONE===
--EXPECT--
Domain51_Cache_Adapter_File reqiures 'base_dir' option
===DONE===