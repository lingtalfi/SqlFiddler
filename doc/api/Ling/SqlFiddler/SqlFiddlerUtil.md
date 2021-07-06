[Back to the Ling/SqlFiddler api](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler.md)



The SqlFiddlerUtil class
================
2021-07-06 --> 2021-07-06






Introduction
============

The SqlFiddlerUtil class.



Class synopsis
==============


class <span class="pl-k">SqlFiddlerUtil</span>  {

- Properties
    - private string [$searchExpression](#property-searchExpression) ;
    - private string [$searchExpressionMarkerName](#property-searchExpressionMarkerName) ;
    - private array [$orderByMap](#property-orderByMap) ;
    - private array [$pageLengthMap](#property-pageLengthMap) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/__construct.md)() : void
    - public [setSearchExpression](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/setSearchExpression.md)(string $searchExpression, string $markerName) : [SqlFiddlerUtil](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil.md)
    - public [setOrderByMap](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/setOrderByMap.md)(array $orderByMap) : [SqlFiddlerUtil](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil.md)
    - public [setPageLengthMap](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/setPageLengthMap.md)(array $pageLengthMap) : [SqlFiddlerUtil](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil.md)
    - public [getSearchExpression](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getSearchExpression.md)(?string $userExpression = null, ?array &$markers = []) : string
    - public [getOrderBy](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getOrderBy.md)(?string $userChoice = null) : string
    - public [getPageOffset](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getPageOffset.md)(?string $userPage = null) : int
    - public [getPageLength](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getPageLength.md)(?string $userPageLength = null) : int

}




Properties
=============

- <span id="property-searchExpression"><b>searchExpression</b></span>

    This property holds the searchExpression for this instance.
    
    

- <span id="property-searchExpressionMarkerName"><b>searchExpressionMarkerName</b></span>

    This property holds the searchExpressionMarkerName for this instance.
    
    

- <span id="property-orderByMap"><b>orderByMap</b></span>

    This property holds the orderByMap for this instance.
    You must define the default value using the _default key.
    
    

- <span id="property-pageLengthMap"><b>pageLengthMap</b></span>

    This property holds the pageLengthMap for this instance.
    
    



Methods
==============

- [SqlFiddlerUtil::__construct](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/__construct.md) &ndash; Builds the SqlFiddlerUtil instance.
- [SqlFiddlerUtil::setSearchExpression](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/setSearchExpression.md) &ndash; Sets the searchExpression.
- [SqlFiddlerUtil::setOrderByMap](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/setOrderByMap.md) &ndash; Sets the orderByMap.
- [SqlFiddlerUtil::setPageLengthMap](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/setPageLengthMap.md) &ndash; Sets the pageLengthMap.
- [SqlFiddlerUtil::getSearchExpression](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getSearchExpression.md) &ndash; Returns the "search" snippet to insert in your query.
- [SqlFiddlerUtil::getOrderBy](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getOrderBy.md) &ndash; Returns the "order by" snippet to insert in your query.
- [SqlFiddlerUtil::getPageOffset](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getPageOffset.md) &ndash; Returns the page offset to insert in your query.
- [SqlFiddlerUtil::getPageLength](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/SqlFiddlerUtil/getPageLength.md) &ndash; Returns the "page length" to insert in your query.





Location
=============
Ling\SqlFiddler\SqlFiddlerUtil<br>
See the source code of [Ling\SqlFiddler\SqlFiddlerUtil](https://github.com/lingtalfi/SqlFiddler/blob/master/SqlFiddlerUtil.php)



SeeAlso
==============
Previous class: [SqlFiddlerException](https://github.com/lingtalfi/SqlFiddler/blob/master/doc/api/Ling/SqlFiddler/Exception/SqlFiddlerException.md)<br>