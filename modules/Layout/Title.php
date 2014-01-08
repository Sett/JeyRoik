<?php
/**
 * Class Layout_Title
 */
trait Layout_Title
{
    /**
     * @var string
     */
    public $title = '';

    /**
     * @var string
     */
    public $pageTitle = '';

    /**
     * @var string
     */
    public $titleSeparator = ' - ';

    /**
     * Set layout title and "title separator"
     * @event 'pre dispatch'
     */
    public function setLayoutTitle()
    {
        $this->title = $this->onLoad['layout']['title'];
        $this->titleSeparator = $this->onLoad['layout']['separator'];
    }

    /**
     * @param string $additional
     * @param bool $prepend
     */
    public function addLayoutTitle($additional = '', $prepend = false)
    {
        $prepend
            ? $this->title = $additional . $this->titleSeparator . $this->title
            : $this->title .= $this->titleSeparator . $additional;
    }
}
