<?php

namespace MASNathan\Pagination\Html;

class Boostrap extends Pagination
{
    /**
     * Initial setup configs
     * @return void
     */
    public function setup()
    {
        $this->setWrapperHtml('<nav><ul class="pagination pagination-lg">%s</ul></nav>');
        $this->setItemHtml('<li><a href="%s">%s</a></li>');
        $this->setActiveItemHtml('<li class="active"><a href="#">%s</a></li>');
        $this->setDisabledItemHtml('<li class="disabled"><a href="#">%s</a></li>');
        $this->setPreviousLabel('<span aria-hidden="true">&laquo;</span>');
        $this->setNextLabel('<span aria-hidden="true">&raquo;</span>');
    }
}
