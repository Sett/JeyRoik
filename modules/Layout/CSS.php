<?php
/**
 * Class Layout_CSS
 */
trait Layout_CSS
{
    /**
     * @var string
     */
    public $css = '';

    /**
     * @param string $cssPath
     */
    public function addCss($cssPath = '')
    {
        $this->css .=
            "\n\t<link rel=\"stylesheet\" type=\"text/css\" href=\"" . "/css/" . $cssPath . ".css\" media=\"screen\"/>";
    }

    /**
     * Set general CSS
     * @onEvent pre dispatch
     * @context uri path
     */
    public function setGeneralCss()
    {
        if(isset($this->onLoad['layout']['css']))
        {
            if(!empty($this->onLoad['layout']['css']))
            {
                foreach($this->onLoad['layout']['css'] as $css)
                    $this->addCss($css);
            }
        }
    }
}
