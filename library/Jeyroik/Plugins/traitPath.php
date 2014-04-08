<?php

return function($config, $path)
{
    $config['path'] = ['traits' => $path];
    
    return $config;
};
