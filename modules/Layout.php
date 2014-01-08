<?php
/**
 * Class Layout
 */
trait Layout
{
    /**
     * @var string
     */
    public $layout = '';

    /**
     * @return mixed|string
     */
    public function setLayout()
    {
        $layoutPath = __DIR__ . '/' . $this->onLoad['paths']['layouts'] .
            'layout.' . $this->onLoad['layout']['extension'];

        $this->layout = is_file($layoutPath) ? include_once $layoutPath : 'content';

        return $this->layout;
    }

    /**
     *
     */
    public function getViewContent()
    {
        $this->view ? include_once $this->view : '';
    }
}
