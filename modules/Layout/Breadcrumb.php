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
        $this->crumbs .= '<li><a href="' . $link .'">' . $name . '</a> <span class="divider">/</span></li>';
    }

    /**
     * @event pre dispatch
     */
    public function setGeneralCrumbs()
    {
        if(isset($this->onLoad['layout']['breadcrumb']) && !empty($this->onLoad['layout']['breadcrumb']))
        {
            foreach($this->onLoad['layout']['breadcrumb'] as $name => $link)
                $this->addCrumb($name, $link);
        }
    }

    /**
     * @event post dispatch
     */
    public function prepareCrumbs()
    {
        $this->crumbs = '<ul class="breadcrumb">' . $this->crumbs . '</ul>';
    }
}
