<?php
/**
 * Class Error_Fatal
 */
trait Error_Fatal
{
    /**
     * @param string $message
     * @param array $context
     */
    public function fatalError($message = '', $context = [])
    {
        // send an email
        mail ( $this->onLoad['error']['fatal']['mail']['to'], $message , json_encode($context));
    }
}
