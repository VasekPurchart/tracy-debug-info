[Tracy BlueScreen](https://tracy.nette.org) panel for Exception::__debugInfo
============================================================================

**Original BlueScreen**

[![Original BlueScreen](https://github.com/nella/tracy-debug-info/blob/master/build/example-ClassicException.png)](https://github.com/nella/tracy-debug-info/blob/master/build/example-ClassicException.html)

**Better (with panel) BlueScreen**

[![Better BlueScreen](https://github.com/nella/tracy-debug-info/blob/master/build/example-BetterException.png)](https://github.com/nella/tracy-debug-info/blob/master/build/example-BetterException.html)

Requirements
------------
- Tracy >=2.3.0 (2.3.x support will be removed on 31 Jan 2017)
- PHP >=5.5.0 (5.4.x support will be removed on 10 Jul 2016)

Installation
------------

```
composer require nella/tracy-debug-info
```

Usage
------

```php

\Nella\Tracy\DebugInfoPanel::register(\Tracy\Debugger::getBlueScreen());

```

Your exception must implement `Nella\Tracy\DebugInfoException` interface. There is helper trail `Nella\Tracy\DebugInfoExceptionTrait` with implemented `__debugInfo` method.


```php

class YourException extends \Exception implements \Nella\Tracy\DebugInfoException
{

	use \Nella\Tracy\DebugInfoExceptionTrait;

}

```

License
-------
Tracy BlueScreen panel for Exception::__debugInfo is licensed under the MIT License - see the LICENSE file for details
