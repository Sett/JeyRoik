<?php
/**
 * Class Jeyroik_Mode
 *
 * General actions for different modes
 */
trait Jeyroik_Mode
{
    /**
     *
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
