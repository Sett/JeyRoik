<?php

trait Layout_JS
{
    public $js = '';

    /**
     * @param string $jsPath
     */
    public function addJs($jsPath = '')
    {
        $this->js .=
            "\n\t" . '<script type="text/javascript" src="/js/' . $jsPath . '.js"></script>';
    }

    /**
     * Set general JS
     * @onEvent pre dispatch
     * @context uri path
     */
    public function setGeneralJs()
    {
        if(isset($this->onLoad['layout']['js']))
        {
            if(!empty($this->onLoad['layout']['js']))
            {
                foreach($this->onLoad['layout']['js'] as $js)
                    $this->addJs($js);
            }
        }
    }
}
