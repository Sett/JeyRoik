<?php
require_once 'Jeyroik/Role.php';
/**
 * Class Jeroik
 */
class Jeyroik
{
    use Jeyroik_Role;

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
            $name      = self::getName($traits);
            $subTraits = self::getTraits($traits);
            $require  .= self::getClasses($traits, $classBasePath);

            $out      = self::getOutTraits($traits);
            $use     .= $out['use'];
            $require .= $out['require'];

            foreach($subTraits as $trait)
            {
                $sub      = self::subTraits($trait, $traitBasePath . $name . '/');// send a parent in the path
                $use     .= $name . '_' . $sub['use'] . ', ' . "\n\t\t";// Name_SubTrait,
                $require .= $sub['require'];
            }

            $use     .= $name ? $name : '';
            $require .= $name ? "require_once '" . __DIR__ . '/../' . $traitBasePath . self::convertName($name) . ".php';\n" : '';
        }
        elseif(is_string($traits))
        {
            $use     = $traits;
            $require = "require_once '" . __DIR__ . '/../' . $traitBasePath . self::convertName($traits) . ".php';\n";
        }

        return ['use' => $use, 'require' => $require];
    }

    /**
     * @param array $data
     * @return array
     */
    public static function getOutTraits($data)
    {
        $outTraits = isset($data['outTraits']) ? $data['outTraits'] : [];

        $require = '';
        $use = '';

        foreach($outTraits as $trait => $path)
        {
            $require .= "require_once '" . __DIR__ . '/../' . $path . "';\n";
            $use .= $trait . ', ' . "\n\t\t";
        }

        return ['use' => $use, 'require' => $require];
    }

    /**
     * @param string $what
     * @param array $cfg
     * @return string
     */
    public static function getPath($what = '' , array $cfg)
    {
        return isset($cfg['path'][$what]) ? $cfg['path'][$what] : '';
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

    public static function run($basePath = '')
    {
        $request = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

        require_once __DIR__ . '/' . self::$role . '.php';

        $class = self::$role;

        new $class($basePath, $request);
    }
}
