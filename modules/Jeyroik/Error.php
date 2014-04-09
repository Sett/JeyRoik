<?php
/**
 * Class Jeyroik_Error
 */
trait Jeyroik_Error
{
    /**
     * @var array
     */
    public $errors = [];

    /**
     * @var array
     */
    public $errorLevel = ['debug' => 0, 'notice' => 1, 'warning' => 2, 'fatal' => 3];

    /**
     * @param string $message
     * @param mixed $context
     * @param string $level
     * @return bool|string
     */
    public function addError($message = '', $context = null, $level = 'notice')
    {
        if(isset($this->errorLevel[$level]))
        {
            $this->rise($level . 'Error', [$message, $context]);// additional action by level
            
            $errorHash = sha1($message . json_encode($context));
            $this->errors[$errorHash] = [
                'message' => $message,
                'context' => $context,
                'level'   => $level
            ];

            return $errorHash;
        }

        return false;
    }

    /**
     * @onEvent the end
     * @context no
     */
    public function dumpErrors()
    {
        if(!empty($this->errors))
        {
            $f = fopen(__DIR__ . '/../' . $this->onLoad['paths']['jeyroik log'], "a+t");
            fputs($f, "\n[" . date('Y-m-d H:i:s') . "]\n\t= Dump errors =\n\t" . json_encode($this->errors) . "\n");
            fclose($f);
        }
    }
}
