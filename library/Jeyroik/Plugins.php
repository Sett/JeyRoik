<?php

trait Jeyroik_Plugins
{
    public static $plugins = [];
    
    public static function usePlugins($config, $rootDir = '/')
    {
        $result = $config;
        if(isset($config['plugins']))
        {
            foreach($config['plugins'] as $pluginPath => $pluginData)
            {
                if(!isset(self::$plugins[$pluginPath]))
                {
                    if(is_file($rootDir . $pluginPath))
                    {
                        $plugin = include $rootDir . $pluginPath;
                        if(is_callable($plugin))
                            self::$plugins[$pluginPath] = $plugin;
                    }
                    else
                    {
                        echo '# Plugin "' . $rootDir . $pluginPath . '" is not found #';
                        continue;
                    }
                }
                
                $result = call_user_func(self::$plugins[$pluginPath], $result, $pluginData);
            }
        }
        
        return $result;
    }
}
