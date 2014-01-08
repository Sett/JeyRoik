<?php
/**
 * Class Dispatcher
 */
trait Dispatcher
{
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

        $controller = (isset($request[0]) && $request[0]) ? $request[0] : 'index';
        $action     = (isset($request[1]) && $request[1]) ? $request[1] : 'index';

        $this->rise($controller . '/' . $action, $request)
             ->rise('post dispatch',
                    [
                        'view' => $controller . '/' . $action,
                        'data' => $this->getEventResult($controller . '/' . $action)
                    ]);
    }
}
