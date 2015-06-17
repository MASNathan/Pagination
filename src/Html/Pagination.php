<?php

namespace MASNathan\Pagination\Html;

use MASNathan\Pagination\Pagination as BasePagination;

class Pagination extends BasePagination
{
    /**
     * Html code to wrap all the items
     * @var string
     */
    protected $wrapperHtml;
    
    /**
     * Html code for the regular item
     * @var string
     */
    protected $itemHtml;
    
    /**
     * Html code for the active item
     * @var string
     */
    protected $activeItemHtml;
    
    /**
     * Html code for the disabled item
     * @var string
     */
    protected $disabledItemHtml;
    
    /**
     * Page url template
     * @var string
     */
    protected $pageUrl;
    
    /**
     * Next page text
     * @var string
     */
    protected $nextLabel;

    /**
     * Previous page text
     * @var string
     */
    protected $previousLabel;

    /**
     * Sets up the pagination class and it's base configurations
     * @param integer $totalPages  Total number of pages
     * @param integer $boundaries  Total number of boundary pages
     * @param integer $around      Around quantity
     * @param integer $currentPage Current page
     */
    public function __construct($totalPages, $boundaries, $around, $currentPage = 1)
    {
        parent::__construct($totalPages, $boundaries, $around, $currentPage);
        
        $this->setup();
    }

    /**
     * If casted to string returns the pagination html
     * @return string
     */
    public function __toString()
    {
        return $this->draw();
    }

    /**
     * Draws the pagination (generates the html)
     * @return string
     */
    public function draw()
    {
        $itemsString = '';
        if ($this->getPreviousPage() !== null) {
            $pageUrl = sprintf($this->pageUrl, $this->getPreviousPage());
            $itemsString .= sprintf($this->itemHtml, $pageUrl, $this->previousLabel);
        }
        foreach ($this->getPages() as $pageNumber) {
            if ($this->getCurrentPage() == $pageNumber) {
                $itemsString .= sprintf($this->activeItemHtml, $pageNumber);
            } elseif (!is_numeric($pageNumber)) {
                $itemsString .= sprintf($this->disabledItemHtml, $pageNumber);
            } else {
                $pageUrl = sprintf($this->pageUrl, $pageNumber);
                $itemsString .= sprintf($this->itemHtml, $pageUrl, $pageNumber);
            }
        }
        if ($this->getNextPage() !== null) {
            $pageUrl = sprintf($this->pageUrl, $this->getNextPage());
            $itemsString .= sprintf($this->itemHtml, $pageUrl, $this->nextLabel);
        }

        return sprintf($this->wrapper, $itemsString);
    }

    /**
     * Initial setup configs
     * @return void
     */
    public function setup()
    {
        $this->setPreviousLabel('Next');
        $this->setNextLabel('Previous');
    }

    /**
     * Sets the html code to wrap all the items
     * @param string $htmlString Html code to wrap all the items
     * @return void
     */
    public function setWrapperHtml($htmlString)
    {
        $formatValidationString = sprintf($htmlString, 'this is a validation');
        if ($formatValidationString == $htmlString) {
            throw new \InvalidArgumentException("Invalid HTML wrapper string, must be a valid format string for sprintf() with 1 argument");
        }

        $this->wrapper = $htmlString;
    }

    /**
     * Sets the html code for the regular item
     * @param string $htmlString Html code for the regular item
     * @return void
     */
    public function setItemHtml($htmlString)
    {
        $formatValidationString = sprintf($htmlString, 1, 1);
        if ($formatValidationString == $htmlString) {
            throw new \InvalidArgumentException("Invalid HTML item wrapper string, must be a valid format string for sprintf() with 2 arguments");
        }

        $this->itemHtml = $htmlString;
    }

    /**
     * Sets the html code for the active item
     * @param string $htmlString Html code for the active item
     * @return void
     */
    public function setActiveItemHtml($htmlString)
    {
        $formatValidationString = sprintf($htmlString, 1);
        if ($formatValidationString == $htmlString) {
            throw new \InvalidArgumentException("Invalid HTML string for active item, must be a valid format string for sprintf() with 1 argument");
        }

        $this->activeItemHtml = $htmlString;
    }

    /**
     * Sets the html code for the disabled item
     * @param string $htmlString Html code for the disabled item
     * @return void
     */
    public function setDisabledItemHtml($htmlString)
    {
        $formatValidationString = sprintf($htmlString, 1);
        if ($formatValidationString == $htmlString) {
            throw new \InvalidArgumentException("Invalid HTML string for disabled item, must be a valid format string for sprintf() with 1 argument");
        }

        $this->disabledItemHtml = $htmlString;
    }

    /**
     * Sets the next page label text
     * @param string $htmlString Previous page text
     * @return void
     */
    public function setPreviousLabel($string)
    {
        $this->previousLabel = $string;
    }

    /**
     * Sets the previous page label text
     * @param string $htmlString Next page text
     * @return void
     */
    public function setNextLabel($string)
    {
        $this->nextLabel = $string;
    }

    /**
     * Sets the page url template
     * @param string $htmlString Page url template
     * @return void
     */
    public function setPageUrl($pageUrl)
    {
        $formatValidationString = sprintf($pageUrl, 1);
        if ($formatValidationString == $pageUrl) {
            throw new \InvalidArgumentException("Invalid url string, must be a valid format string for sprintf() with 1 argument, to replace with the page number");
        }

        $this->pageUrl = $pageUrl;
    }
}
