<?php
/**
 * Class Jeyroik_Base
 */
trait Jeyroik_Base
{
    /**
     * @var string
     */
    public $root = '';

    /**
     * @var array
     */
    public $request = [];

    /**
     * @param string $root
     * @param array $request
     */
    public function __construct($root = '', $request = [])
    {
        $this->root    = $root;
        $this->request = $request;
        $this->rise('on load', $request)->rise('the end');
    }
}
