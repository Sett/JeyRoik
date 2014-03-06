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
     * @onEvent post dispatch
     * @context [
     *  'data' => resultOf @group Controller/Action
     * ]
     * @param array $request
     * @return string
     */
    public function constructView($request = [])
    {
        $viewPath = __DIR__ . '/'
            . $this->{'paths:views'}
            . $this->view . '.' . $this->{'view:extension'};

        if(file_exists($viewPath))
            $this->view = $viewPath;
        else
        {
            $this->addError('View is not found', $viewPath);
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
