<?php
/**
 * Class Layout_Meta
 */
trait Layout_Meta
{
    /**
     * @var string
     */
    public $meta = '';

    /**
     * @param string $name
     * @param string $content
     * @param string $firstAttr
     * @param string $secondAttr
     * @return $this
     */
    public function addMeta($name = '', $content = '', $firstAttr = 'name', $secondAttr = 'content')
    {
        $this->meta .= "\n\t" . '<meta ' . $firstAttr . '="' . $name . '" ' . $secondAttr . '="' . $content . '" />';

        //return $this;
    }

    /**
     * @onEvent pre dispatch
     * @context uri path
     */
    public function setGeneralMeta()
    {
        if(isset($this->onLoad['layout']['meta']) && !empty($this->onLoad['layout']['meta']))
        {
            foreach($this->onLoad['layout']['meta'] as $name => $content)
            {
                if(is_string($content))
                    $this->addMeta($name, $content);
                elseif(is_array($content))
                {
                    list($attr1, $attr2) = array_keys($content);
                    list($value1, $value2) = array_values($content);

                    $this->addMeta($value1, $value2, $attr1, $attr2);
                }
            }
        }
    }
}
