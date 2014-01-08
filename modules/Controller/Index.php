<?php
/**
 * Class Controller_Index
 */
trait Controller_Index
{
    /**
     * @param array $request
     * @return array
     * @onEvent 'index/index'
     * @context request params
     */
    public function indexInIndex($request = [])
    {
        $this->addLayoutTitle('Главная страница');
        $this->addKeyword('Главная страница');
        $this->pageTitle = 'Jeyroik 0.0.1';

        return $request;
    }
}
