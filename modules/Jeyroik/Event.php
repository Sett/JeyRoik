<?php
/**
 * Class Event
 */
trait Jeyroik_Event
{
    /**
     * event => mixed result
     * @var array
     */
    public $eventResult = [];

    /**
     * Contain all raised events, their listeners and results
     * @var array
     */
    public $eventLog = [];

    /**
     * @param string $name
     * @param mixed $context
     * @return $this
     */
    public function rise($name = '', $context = null)
    {
        $eventLog = [
            'name' => $name,
            'context' => $context,
            'listeners' => []
        ];

        $this->eventResult[$name] = $context;// По умолчанию, результат события - его контекст

        // проверяем, есть ли слушатели
        if(isset($this->onLoad['event'][$name]) && !empty($this->onLoad['event'][$name]))
        {
            foreach($this->onLoad['event'][$name] as $listener)
            {
                if(method_exists($this, $listener))
                {
                    if($result = $this->$listener($context))// Если есть какой-то результат
                        $this->eventResult[$name] = $result;

                    $eventLog['listeners'][] = ['listener' => $listener, 'result' => $this->eventResult[$name]];
                }
                else
                    $eventLog['listeners'][] = ['name' => $listener, 'missed' => true];
            }
        }
        else
            $this->eventResult[$name] = $context;

        $this->eventLog[] = $eventLog;
        return $this;
    }

    /**
     * @param string $event
     * @return string
     */
    public function getEventResult($event = '')
    {
        return isset($this->eventResult[$event]) ? $this->eventResult[$event] : '';
    }

    /**
     * @param string $event
     * @param string $listener
     * @return $this
     */
    public function listen($event = '', $listener = '')
    {
        if(!isset($this->onLoad['event'][$event]))
            $this->onLoad['event'][$event] = [];

        $this->onLoad['event'][$event][] = $listener;

        return $this;
    }
}
