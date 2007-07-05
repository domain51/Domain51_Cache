--TEST--
Domain51_Cache can be directly instantiated.  When instantiated, it serves as a Proxy object to
the adapter it was configured with.
--FILE--
<?php
//BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../src/' . PATH_SEPARATOR .
                 dirname(__FILE__) . '/../../support/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache.php';

class Domain51_Cache_Adapter_EchoForTesting implements Domain51_Cache_Adapter
{
    public function __construct(array $options = array())
    {
        echo "EchoForTesting :: __construct() invoked with " . var_export($options, true) . "\n";
    }
    
    public function __get($key)
    {
        echo "EchoForTesting :: getting {$key}\n";
    }
    
    public function __set($key, $value)
    {
        echo "EchoForTesting :: setting {$key} == {$value}\n";
    }
    
    public function save()
    {
        echo "EchoForTesting :: save() invoked\n";
    }
}

// sanity check
ob_start();
$echo = new Domain51_Cache_Adapter_EchoForTesting(array());
$echo->test = 'hello world';
$str = $echo->test;
$echo->save();
new Domain51_Cache_Adapter_EchoForTesting(array('foo' => 'bar'));
$buffer = ob_get_clean();

$expected = "EchoForTesting :: __construct() invoked with array (
)
EchoForTesting :: setting test == hello world
EchoForTesting :: getting test
EchoForTesting :: save() invoked
EchoForTesting :: __construct() invoked with array (
  'foo' => 'bar',
)
";
assert('$buffer == $expected');
// end sanity check


$cache = new Domain51_Cache('EchoForTesting', array('foo' => 'bar'));
$cache->foo = 'bar';
$bar = $cache->foo;
$cache->save();

?>
===DONE===
--EXPECT--
EchoForTesting :: __construct() invoked with array (
  'foo' => 'bar',
)
EchoForTesting :: setting foo == bar
EchoForTesting :: getting foo
EchoForTesting :: save() invoked
===DONE===