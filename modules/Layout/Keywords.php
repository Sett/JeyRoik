<?php
/**
 * Class Layout_Keywords
 * @use Layout_Meta
 */
trait Layout_Keywords
{
    /**
     * @var string
     */
    public $keywords = '';

    /**
     * @param string $word
     * @return $this
     */
    public function addKeyword($word = '')
    {
        $this->keywords .= $word . ', ';

        //return $this;
    }

    /**
     * Calls like
     * addKeywords('word1', 'word2', ...);
     * or
     * addKeywords(['word1', 'word2', ...]);
     */
    public function addKeywords()
    {
        $words = func_get_args();

        if((count($words) == 1) && is_array($words[0]))
            $words = $words[0];

        foreach($words as $word)
            $this->addKeyword($word);
    }

    /**
     * @event 'pre dispatch'
     */
    public function setGeneralKeyWords()
    {
        if(isset($this->onLoad['layout']['keywords']))
        {
            if(!empty($this->onLoad['layout']['keywords']))
            {
                foreach($this->onLoad['layout']['keywords'] as $word)
                    $this->addKeyword($word);
            }
        }
    }

    /**
     * @event 'post dispatch'
     */
    public function closeKeywords()
    {
        $this->keywords = $this->addMeta('keywords', $this->keywords . $this->onLoad['system']['title']);
    }
}
