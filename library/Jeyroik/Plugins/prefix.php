<?php

return function($config, $prefix)
{
    if(isset($config['traits']))
    {
        foreach($config['traits'] as $index => $trait)
            $config['traits'][$index] = $prefix . '_' . $trait;
    }
    
    return $config;
};
