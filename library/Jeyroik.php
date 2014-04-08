<?php
require_once 'Jeyroik/Role.php';
require_once 'Jeyroik/Plugins.php';
/**
 * Class Jeroik
 */
class Jeyroik
{
    /**
     * Role mechanizm
     */
    use Jeyroik_Role;
    
    /**
     * Plugins mechanizm
     */
    use Jeyroik_Plugins;

    /**
     * @var string
     */
    public static $role = 'Guest';

    /**
     * From the current directory
     *
     * @var string
     */
    public static $cfgPath = '/../application/configs/';

    /**
     * @param bool $recompileIfExist
     */
    public static function compile($recompileIfExist = false)
    {
        self::getRole();

        $className = self::$role;

        if(!is_file(__DIR__ . '/' . $className . '.php') || $recompileIfExist)
            self::constructClass($className);
    }

    /**
     * @param string $className
     */
    public static function constructClass($className = 'Guest')
    {
        $cfgPath       = __DIR__ . self::$cfgPath;
        $cfg           = self::getConfig($cfgPath . 'Core.php', $cfgPath . 'compile/' . $className . '.php');
        $cfg           = self::usePlugins($cfg, __DIR__ . '/../');
        $traits        = self::getTraits($cfg);
        $traitBasePath = self::getPath('trait', $cfg);
        $classBasePath = self::getPath('class', $cfg);

        $use     = 'use ';
        $require = '';
        $count   = count($traits)-1;

        foreach($traits as $index => $trait)
        {
            $quot = ($count == $index) ? ';' : ', ' . "\n\t\t";
            $sub  = self::subTraits($trait, $traitBasePath, $classBasePath);

            $use     .= $sub['use'] . $quot;
            $require .= $sub['require'];
        }

        $result = "<?php\n\n" . $require . "\nclass " . $className . "\n{\n\t" . $use . "\n}";

        file_put_contents(__DIR__ . '/' . $className . '.php', $result);
    }

    /**
     * @param string $corePath
     * @param string $rolePath
     * @return mixed
     */
    public static function getConfig($corePath = '', $rolePath = '')
    {
        $core = require_once $corePath;
        $role = require_once $rolePath;

        $core['traits'] = array_merge($core['traits'], $role['traits']);

        return $core;
    }

    /**
     * @param string|array $traits
     * @param string $traitBasePath
     * @param string $classBasePath
     * @return string
     */
    public static function subTraits($traits, $traitBasePath = '', $classBasePath = '')
    {
        $use     = '';
        $require = '';

        if(is_array($traits))
        {
            $traits = self::usePlugins($traits, __DIR__ . '/../');
            $traitBasePath = self::getPath('traits', $traits, $traitBasePath);

            $subTraits = self::getTraits($traits);
            $require  .= self::getClasses($traits, $classBasePath);

            $count   = count($subTraits)-1;

            foreach($subTraits as $index => $trait)
            {
                $quot = ($count == $index) ? '' : ', ' . "\n\t\t";
                $sub      = self::subTraits($trait, $traitBasePath);// send a parent in the path
                $use     .= $sub['use'] . $quot;// Name_SubTrait,
                $require .= $sub['require'];
            }
        }
        elseif(is_string($traits))
        {
            $use     = $traits;
            $require = "require_once '" . __DIR__ . '/../' . $traitBasePath . self::convertName($traits) . ".php';\n";
        }

        return ['use' => $use, 'require' => $require];
    }

    /**
     * @param string $what
     * @param array $cfg
     * @param string #defaultPath
     * @return string
     */
    public static function getPath($what = '' , array $cfg = [], $defaultPath = '')
    {
        return isset($cfg['path'][$what]) ? $cfg['path'][$what] : $defaultPath;
    }

    /**
     * @param array $data
     * @return array
     */
    public static function getTraits(array $data)
    {
        return isset($data['traits']) ? $data['traits'] : [];
    }

    /**
     * @param array $data
     * @param string $classBasePath
     * @return string
     */
    public static function getClasses(array $data, $classBasePath)
    {
        $libs = isset($data['class']) ? $data['class'] : [];

        $require = '';

        foreach($libs as $lib)
            $require .= "require_once '" . __DIR__ . '/../' . $classBasePath . $lib . ".php';\n";

        return $require;
    }


    /**
     * @param array $data
     * @return string
     */
    public static function getName(array $data)
    {
        return isset($data['name']) ? $data['name'] : '';
    }

    /**
     * @param int $index
     * @param int $count
     * @return string
     */
    public static function quot($index = 0, $count = 0)
    {
        return ($index == $count) ? ';' . "\n\t" : ', ' . "\n\t";
    }

    /**
     * @param string $name
     * @param string $from
     * @param string $to
     * @return string
     */
    public static function convertName($name = '', $from = '_', $to = '/')
    {
        return (strpos($name, $from) !== false) ? str_replace($from, $to, $name) : $name;
    }

    /**
     * @param string $basePath
     */
    public static function run($basePath = '')
    {
        $request = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

        require_once __DIR__ . '/' . self::$role . '.php';

        $class = self::$role;

        new $class($basePath, $request);
    }
}
