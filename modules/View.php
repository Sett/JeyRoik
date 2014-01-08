<?php
/**
 * Class View
 */
trait View
{
    /**
     * @var string
     */
    public $view = '';

    /**
     * @param array $request
     * @return string
     */
    public function constructView($request = [])
    {
        if(isset($request['view']))
        {
            $viewPath = __DIR__ . '/'
                . $this->onLoad['paths']['views']
                . $request['view'] . '.' . $this->onLoad['view']['extension'];

            if(file_exists($viewPath))
                $this->view = $viewPath;
            else
            {
                $this->addError('View is not found', $viewPath);
                $this->view = false;
            }
        }
        else
        {
            $this->addError('Missed view in the request', $request);
            $this->view = false;
        }

        return $this->view;
    }
    
    /**
     * @param $view
     * @param string $context
     */
    public function render($view, $context = '')
    {
        is_file($view) ? require $view : '';
    }
}
