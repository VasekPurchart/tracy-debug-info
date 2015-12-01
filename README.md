[Tracy BlueScreen](https://tracy.nette.org) panel for Exception::__debugInfo
============================================================================

[![Build Status](https://img.shields.io/travis/nella/tracy-debug-info/master.svg?style=flat-square)](https://travis-ci.org/nella/tracy-debug-info)
[![Code Coverage](https://img.shields.io/coveralls/nella/tracy-debug-info.svg?style=flat-square)](https://coveralls.io/r/nella/tracy-debug-info)
[![SensioLabsInsight Status](https://img.shields.io/sensiolabs/i/d554e964-b3b4-40d1-be3c-c396eb697e78.svg?style=flat-square)](https://insight.sensiolabs.com/projects/d554e964-b3b4-40d1-be3c-c396eb697e78)
[![Latest Stable Version](https://img.shields.io/packagist/v/nella/tracy-debug-info.svg?style=flat-square)](https://packagist.org/packages/nella/tracy-debug-info)
[![Composer Downloads](https://img.shields.io/packagist/dt/nella/tracy-debug-info.svg?style=flat-square)](https://packagist.org/packages/nella/tracy-debug-info)
[![Dependency Status](https://img.shields.io/versioneye/d/user/projects/565a5c9a036c32003a000011.svg?style=flat-square)](https://www.versioneye.com/user/projects/565a5c9a036c32003a000011)
[![HHVM Status](https://img.shields.io/hhvm/nella/tracy-debug-info.svg?style=flat-square)](http://hhvm.h4cc.de/package/nella/tracy-debug-info)

**Original BlueScreen**

[![Original BlueScreen](https://github.com/nella/tracy-debug-info/blob/master/build/example-ClassicException.png)](https://cdn.rawgit.com/nella/tracy-debug-info/master/build/example-ClassicException.html)

**Better (with panel) BlueScreen**

[![Better BlueScreen](https://github.com/nella/tracy-debug-info/blob/master/build/example-BetterException.png)](https://cdn.rawgit.com/nella/tracy-debug-info/master/build/example-BetterException.html)

Requirements
------------
- Tracy >=2.3.0 (2.3.x support will be removed on 31 Jan 2017)
- PHP >=5.5.0 (5.5.x support will be removed on 10 Jul 2016)

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

Your exception must implement `Nella\Tracy\DebugInfoException` interface. There is a helper trait `Nella\Tracy\DebugInfoExceptionTrait` with implemented `__debugInfo` method.


```php

class YourException extends \Exception implements \Nella\Tracy\DebugInfoException
{

	use \Nella\Tracy\DebugInfoExceptionTrait;

}

```

License
-------
Tracy BlueScreen panel for Exception::__debugInfo is licensed under the MIT License - see the LICENSE file for details
