<?php

namespace MASNathan\Pagination;

/**
 * Pagination core class
 *
 * It's responsible by generating the required page numbers based on the setted configs
 *
 * @package MASNathan
 * @subpackage Pagination
 * @author André Filipe <andre.r.flip@gmail.com>
 * @link https://github.com/masnathan/pagination GitHub repo
 * @license MIT
 * @version 1.0.0
 */
class Pagination
{
    /**
     * Pagination raw string
     * @var string
     */
    private $paginationString;

    /**
     * Array with all the pages
     * @var array
     */
    private $paginationArray;

    /**
     * Current page
     * @var integer
     */
    protected $currentPage;

    /**
     * Total number of pages
     * @var integer
     */
    protected $totalPages;

    /**
     * Total number of boundary pages
     * @var integer
     */
    protected $boundariesQuantity;

    /**
     * Around quantity
     * @var integer
     */
    protected $aroundQuantity;

    /**
     * Sets up the pagination class and it's base configurations
     * @param integer $totalPages  Total number of pages
     * @param integer $boundaries  Total number of boundary pages
     * @param integer $around      Around quantity
     * @param integer $currentPage Current page
     */
    public function __construct($totalPages, $boundaries, $around, $currentPage = 1)
    {
        if (!is_int($totalPages)) {
            throw new \InvalidArgumentException("Invalid Argument Type - totalPages must be integer.");
        }
        if (!is_int($boundaries)) {
            throw new \InvalidArgumentException("Invalid Argument Type - boundaries must be integer.");
        }
        if (!is_int($around)) {
            throw new \InvalidArgumentException("Invalid Argument Type - around must be integer.");
        }
        if (!is_int($currentPage)) {
            throw new \InvalidArgumentException("Invalid Argument Type - currentPage must be integer.");
        }
        if ($currentPage > $totalPages) {
            throw new \InvalidArgumentException("The current page ($currentPage) must be lower than the total number of pages ($totalPages)");
        }
        $this->totalPages         = $totalPages;
        $this->boundariesQuantity = $boundaries;
        $this->aroundQuantity     = $around;
        $this->currentPage        = $currentPage;
    }

    /**
     * If casted to string returns the pagination raw string
     * @return string
     */
    public function __toString()
    {
        if ($this->paginationString === null) {
            $this->generate();
        }

        return $this->paginationString;
    }

    /**
     * Generates the pagination structure
     * @return Pagination
     */
    public function generate()
    {
        $temporaryString = '';
        for ($pageNumber = 1; $pageNumber <= $this->totalPages; $pageNumber++) {
            if (($pageNumber <= $this->boundariesQuantity && $pageNumber < $this->currentPage) ||
                ($pageNumber > $this->totalPages - $this->boundariesQuantity && $pageNumber > $this->currentPage) ||
                ($pageNumber >= $this->currentPage - $this->aroundQuantity && $pageNumber <= $this->currentPage + $this->aroundQuantity)) {
                $temporaryString .= $pageNumber . " ";
            } else {
                $temporaryString .= " ";
            }
        }

        $this->paginationString = preg_replace('/\s\s+/', ' ... ', trim($temporaryString));
        $this->paginationArray = explode(' ', $this->paginationString);
        return $this;
    }

    /**
     * Returns the previous page
     * @return integer|null
     */
    public function getPreviousPage()
    {
        $previousPage = $this->currentPage - 1;
        return $previousPage ? $previousPage : null;
    }

    /**
     * Returns the current page
     * @return integer
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * Returns the next page
     * @return integer|null
     */
    public function getNextPage()
    {
        $nextPage = $this->currentPage + 1;
        return $nextPage <= $this->totalPages ? $nextPage : null;
    }

    /**
     * Returns all the pages as an array
     * @return array
     */
    public function getPages()
    {
        if (!$this->paginationString && !$this->paginationArray) {
            $this->generate();
        }

        return $this->paginationArray;
    }
}
