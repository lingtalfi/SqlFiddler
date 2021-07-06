<?php


namespace Ling\SqlFiddler;

use Ling\SqlFiddler\Exception\SqlFiddlerException;

/**
 * The SqlFiddlerUtil class.
 */
class SqlFiddlerUtil
{


    /**
     * This property holds the searchExpression for this instance.
     * @var string
     */
    private string $searchExpression;

    /**
     * This property holds the searchExpressionMarkerName for this instance.
     * @var string
     */
    private string $searchExpressionMarkerName;

    /**
     * This property holds the searchExpressionMode for this instance.
     * @var string
     */
    private string $searchExpressionMode;

    /**
     * This property holds the orderByMap for this instance.
     * You must define the default value using the _default key.
     * @var array
     */
    private array $orderByMap;

    /**
     * This property holds the pageLengthMap for this instance.
     * @var array
     */
    private array $pageLengthMap;


    /**
     * Builds the SqlFiddlerUtil instance.
     */
    public function __construct()
    {
        $this->searchExpression = '1';
        $this->searchExpressionMarkerName = '';
        $this->searchExpressionMode = '%%';
        $this->orderByMap = [];
        $this->pageLengthMap = [];
    }


    /**
     * Sets the searchExpression.
     *
     *
     * The markerName will be injected in the markers automatically when you call the getSearchExpression method.
     *
     *
     *
     * The injected value is decorated, depending on the search mode, which can be one of the followings:
     *
     * - %%: %like%
     * - %like%: %like%
     *
     * - %: %like
     * - %like: %like
     * - %s: %like
     *
     * - s%: like%
     * - like%: like%
     *
     * - none: (the value of the marker is exactly what you pass to the getSearchExpression)
     * - n: alias of none
     *
     *
     * The default value is %%, assuming that you search using the %like% mode.
     *
     *
     *
     *
     *
     * Note: by default, for all "like" modes (i.e. a mode containing %), we escape the % and _ chars from the value, assuming that you are using mysql (those are special search symbols in mysql),
     * and assuming that your search value don't use those wildcards.
     *
     *
     *
     *
     * @param string $searchExpression
     * @param string $markerName
     * @param string $searchMode
     *
     *
     * @return $this
     */
    public function setSearchExpression(string $searchExpression, string $markerName, string $searchMode = '%%'): static
    {
        $this->searchExpression = $searchExpression;
        $this->searchExpressionMarkerName = $markerName;
        $this->searchExpressionMode = $searchMode;
        return $this;
    }

    /**
     * Sets the orderByMap.
     *
     * @param array $orderByMap
     * @return $this
     */
    public function setOrderByMap(array $orderByMap): static
    {
        $this->orderByMap = $orderByMap;
        return $this;
    }

    /**
     * Sets the pageLengthMap.
     *
     * @param array $pageLengthMap
     * @return $this
     */
    public function setPageLengthMap(array $pageLengthMap): static
    {
        $this->pageLengthMap = $pageLengthMap;
        return $this;
    }


    /**
     * Returns the "search" snippet to insert in your query.
     *
     * If the user expression is null (or empty string when trimmed), 1 is returned by default, so that you can do "WHERE 1" in your query.
     *
     * The markers array is filled with the appropriate marker that you defined when calling the setSearchExpression method.
     *
     *
     *
     * @param string|null $userExpression
     * @param array $markers
     * @return string
     */
    public function getSearchExpression(string $userExpression = null, array &$markers = []): string
    {
        $defaultReturn = "1";
        if (null === $userExpression) {
            return $defaultReturn;
        }
        if ('' === trim($userExpression)) {
            return $defaultReturn;
        }

        switch ($this->searchExpressionMode) {
            case "%%":
            case "%like%":
            case "%s%":
                $userExpression = '%' . addcslashes($userExpression, '%_') . '%';
                break;
            case "%":
            case "%like":
            case "%s":
                $userExpression = '%' . addcslashes($userExpression, '%_');
                break;
            case "s%":
            case "like%":
                $userExpression = addcslashes($userExpression, '%_') . '%';
                break;
            case "n":
            case "none":
                break;
            default:
                throw new SqlFiddlerException("Unknown searchMode: $this->searchExpressionMode.");
                break;
        }

        $markers[':' . $this->searchExpressionMarkerName] = $userExpression;
        return $this->searchExpression;
    }


    /**
     * Returns the "order by" snippet to insert in your query.
     * If userChoice is null, the "_default" value from the orderBy map is returned.
     *
     * Throws an exception if no value matches the given userChoice.
     *
     * @param string|null $userChoice
     * @return string
     * @throws \Exception
     */
    public function getOrderBy(string $userChoice = null): string
    {
        if (null === $userChoice) {
            $userChoice = "_default";
        }
        if (true === array_key_exists($userChoice, $this->orderByMap)) {
            return $this->orderByMap[$userChoice];
        }
        throw new SqlFiddlerException("No value found in the orderBy map for user choice $userChoice.");
    }


    /**
     * Returns the page offset to insert in your query.
     *
     * In Mysql, this corresponds to the offset component of the limit clause.
     *
     * If the given page is null, 0 is returned by default.
     * Otherwise, it returns the given page number minus 1.
     *
     * If the result is below 0, it returns 0.
     *
     *
     * @param string|null $userPage
     * @return int
     */
    public function getPageOffset(string $userPage = null): int
    {
        if (null === $userPage) {
            return 0;
        }
        $userPage = (int)$userPage;
        $userPage--;
        if ($userPage < 0) {
            $userPage = 0;
        }
        return $userPage;
    }

    /**
     * Returns the "page length" to insert in your query.
     *
     * In Mysql, this corresponds to the row_count component of the limit clause.
     *
     * If userPageLength is null, the "_default" value from the pageLength map is returned.
     *
     * Throws an exception if no value matches the given userPageLength.
     *
     *
     *
     * @param string|null $userPageLength
     * @return int
     */
    public function getPageLength(string $userPageLength = null): int
    {
        if (null === $userPageLength) {
            $userPageLength = "_default";
        }
        if (true === array_key_exists($userPageLength, $this->pageLengthMap)) {
            return (int)$this->pageLengthMap[$userPageLength];
        }
        throw new SqlFiddlerException("No value found in the pageLengthMap map for user choice $userPageLength.");
    }

}