<?php
/**
 * Class Jeyroik_Mode
 *
 * General actions for different modes
 */
trait Jeyroik_Mode
{
    /**
     * @onEvent the end
     * @context no
     */
    public function modeAction()
    {
        if($this->onLoad['system']['mode'] == 'debug')
        {
            echo '<pre>';
            print_r($this);
        }
    }
}
