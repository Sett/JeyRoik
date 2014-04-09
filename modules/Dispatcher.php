<?php
/**
 * Class Dispatcher
 */
trait Dispatcher
{
    /**
     * @var string
     */
    public $controller = '';

    /**
     * @var string
     */
    public $action = '';
    
    /**
     * @param string $path
     * @onEvent on load
     * @context request uri
     */
    public function dispatch($path = '')
    {
        $path = $this->rise('pre dispatch', $path)->getEventResult('pre dispatch');

        preg_match_all('/\w+/i', $path, $request);

        $request = isset($request[0]) ? $request[0] : [];// нашли чего-нибудь

        $this->controller = (isset($request[0]) && $request[0]) 
                            ? $request[0] 
                            : $this->getDefault('dispatch:default:controller', 'is_string');
        $this->action     = (isset($request[1]) && $request[1]) 
                            ? $request[1] 
                            : $this->getDefault('dispatch:default:action', 'is_string');
        
        $this->view = $this->controller . '/' . $this->action;

        $this->rise($this->controller . '/' . $this->action, $request)
             ->rise('post dispatch',
                    [
                        'data' => $this->getEventResult($this->controller . '/' . $this->action)
                    ]);
    }
}
