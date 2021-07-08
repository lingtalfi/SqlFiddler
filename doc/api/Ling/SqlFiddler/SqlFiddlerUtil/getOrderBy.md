[Back to the Ling/SqlFiddler api](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler.md)<br>
[Back to the Ling\SqlFiddler\SqlFiddlerUtil class](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil.md)


SqlFiddlerUtil::getOrderBy
================



SqlFiddlerUtil::getOrderBy — Returns the "order by" snippet to insert in your query.




Description
================


public [SqlFiddlerUtil::getOrderBy](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getOrderBy.md)(?string $userChoice = null) : string




Returns the "order by" snippet to insert in your query.
If userChoice is null, the "_default" value from the orderBy map is returned.

Throws an exception if no value matches the given userChoice.




Parameters
================


- userChoice

    


Return values
================

Returns string.


Exceptions thrown
================

- [Exception](http://php.net/manual/en/class.exception.php).&nbsp;







Source Code
===========
See the source code for method [SqlFiddlerUtil::getOrderBy](https://github.com/lingtalfi/SqlFiddler/blob/master/SqlFiddlerUtil.php#L198-L207)


See Also
================

The [SqlFiddlerUtil](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil.md) class.

Previous method: [getSearchExpression](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getSearchExpression.md)<br>Next method: [getPageOffset](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getPageOffset.md)<br>

