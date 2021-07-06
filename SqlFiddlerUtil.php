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
        $this->orderByMap = [];
        $this->pageLengthMap = [];
    }


    /**
     * Sets the searchExpression.
     *
     * @param string $searchExpression
     * @param string $markerName
     * @return $this
     */
    public function setSearchExpression(string $searchExpression, string $markerName): static
    {
        $this->searchExpression = $searchExpression;
        $this->searchExpressionMarkerName = $markerName;
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