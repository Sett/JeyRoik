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
    
    
    /**
     * @param string $name for sub-levels: <level>:<name>
     * @return mixed
     */
    public function __get($name)
    {
        $parts = explode(':', $name);
        $root = $this->onLoad;

        foreach($parts as $part)
        {
            if(isset($root[$part]))
                $root = $root[$part];
            else
                break;
        }

        return $root;
    }
    
    /**
     * @param string $object same as __get($name)
     * @param string $typeFunc function for validating default value
     * @return mixed
     */
    public function getDefault($object = '', $typeFunc = 'is_string')
    {
        $default = $this->$object;
        
        if(is_callable($typeFunc) && $typeFunc($default))
            return $default;
            
        return null;
    }
}
