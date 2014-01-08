<?php
/**
 * Class Layout_Breadcrumb
 */
trait Layout_Breadcrumb
{
    /**
     * @var string
     */
    public $crumbs = '';

    /**
     * @param string $name
     * @param string $link
     */
    public function addCrumb($name = '', $link = '#')
    {
        $this->crumbs .= require $this->onLoad['paths']['layouts'] . 'crumb.phtml';
    }

    /**
     * @onEvent pre dispatch
     * @context uri path
     */
    public function setGeneralCrumbs()
    {
        if(isset($this->onLoad['layout']['breadcrumb']) && !empty($this->onLoad['layout']['breadcrumb']))
        {
            foreach($this->onLoad['layout']['breadcrumb'] as $name => $link)
                $this->addCrumb($name, $link);
        }
    }
}
