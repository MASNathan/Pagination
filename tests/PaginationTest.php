<?php

namespace MASNathan\Pagination\Test;

use MASNathan\Pagination\Pagination;

/**
 * @coversDefaultClass \MASNathan\Pagination\Pagination
 */
class PaginationTest extends \PHPUnit_Framework_TestCase
{

    public function invalidArgumentProvider()
    {
        return array(
            array(null, 1, 1, 1),
            array('test', 1, 1, 1),
            array(1.2, 1, 1, 1),
            array(1, null, 1, 1),
            array(1, 'test', 1, 1),
            array(1, 1.2, 1, 1),
            array(1, 1, null, 1),
            array(1, 1, 'test', 1),
            array(1, 1, 1.2, 1),
            array(1, 1, 1, null),
            array(1, 1, 1, 'test'),
            array(1, 1, 1, 1.2),
            array(1, 1, 1, 100),
        );
    }

    /**
     * @dataProvider invalidArgumentProvider
     * @expectedException InvalidArgumentException
     */
    public function testInitExceptions($totalPages, $boundaries, $around, $currentPage)
    {
        $pager = new Pagination($totalPages, $boundaries, $around, $currentPage);
    }

    public function constructorProvider()
    {
        return array(
            //array(10, 0, 0, 9, '... 9 ...'),
            array(10, 1, 0, 9, '1 ... 9 10'),
            array(15, 1, 0, 9, '1 ... 9 ... 15'),
            array(15, 1, 2, 8, '1 ... 6 7 8 9 10 ... 15'),
            array(15, 2, 0, 9, '1 2 ... 9 ... 14 15'),
            array(10, 1, 2, 9, '1 ... 7 8 9 10'),
            array(15, 1, 0, 1, '1 ... 15'),
            array(15, 1, 2, 1, '1 2 3 ... 15'),
            array(15, 3, 0, 2, '1 2 ... 13 14 15'),
            array(15, 3, 1, 2, '1 2 3 ... 13 14 15'),
            array(15, 3, 0, 14, '1 2 3 ... 14 15'),
            array(15, 3, 1, 14, '1 2 3 ... 13 14 15'),
        );
    }

    /**
     * @dataProvider constructorProvider
     */
    public function testGenerate($totalPages, $boundaries, $around, $currentPage, $expected)
    {
        $pager = new Pagination($totalPages, $boundaries, $around, $currentPage);
        $this->assertEquals((string) $pager, $expected);
    }

    /**
     * @dataProvider constructorProvider
     */
    public function testGetPages($totalPages, $boundaries, $around, $currentPage, $expected)
    {
        $pager = new Pagination($totalPages, $boundaries, $around, $currentPage);
        $this->assertEquals(implode(' ', $pager->getPages()), $expected);
    }

    public function pageGetterProvider()
    {
        return array(
            array(10, null, 1, 2),
            array(10, 1, 2, 3),
            array(10, 9, 10, null),
            array(10, 8, 9, 10),
            array(10, 4, 5, 6),
            array(1, null, 1, null),
        );
    }

    /**
     * @dataProvider pageGetterProvider
     */
    public function testGetters($totalPages, $previousPage, $currentPage, $nextPage)
    {
        $pager = new Pagination($totalPages, 0, 0, $currentPage);
        $this->assertEquals($pager->getPreviousPage(), $previousPage);
        $this->assertEquals($pager->getCurrentPage(), $currentPage);
        $this->assertEquals($pager->getNextPage(), $nextPage);
    }
}
