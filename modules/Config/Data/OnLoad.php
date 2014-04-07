<?php
/**
 * Class Config_Data_OnLoad
 */
trait Config_Data_OnLoad
{
    /**
     * @var array
     */
    public $onLoad = [

        "paths" => // from the core - /modules/
        [
            "views"   => "../application/views/",
            "layouts" => "../application/views/layouts/",
            "jeyroik log" => "../public/log.txt"
        ],

        "view" =>
        [
            "extension" => 'phtml'
        ],

        "layout" =>// I think, some of this parameters should be stored somewhere else: db, json
        [// because this data is often changing. Further I have marked parameters, that I think should store in the db
            "extension" => "phtml",

            "title"     => "Jeyroik",
            "separator" => " - ",

            "css" => ["bootstrap"],// will be: bootstrap.css
            "js"  => ["bootstrap"],
            "keywords" => ["фреймворк", "php"],// mbiadb
            "meta" =>
            [
                "viewport" => "width=device-width, initial-scale=1.0",
                "description" => "PHP фреймворк, построенный на трейтах",// mbiadb
                [
                    "http-equiv" => "content-type",
                    "content"    => "text/html; charset=utf-8"
                ]
            ],
            "disable" => []// disable layout for actions
        ],

        "talk" => "on",

        "log" =>
        [
            "file" => "log.txt",
            "on"   => 1
        ],

        "event" =>
        [
            /**
             * @group General events
             * @risingIn Jeyroik_Base::__construct()
             * @context uri path
             */
            "on load" => ["dispatch"],
                /**
                 * @group Dispatching
                 * @risingIn Dispatcher::dispatch()
                 * @context uri path
                 */
                "pre dispatch"   =>
                [
                    "setLayoutTitle",
                    "setGeneralCss",
                    "setGeneralJs",
                    "setGeneralKeywords",
                    "setGeneralMeta",
                    "setGeneralCrumbs"
                ],
                /**
                 * @group Dispatching
                 * @risingIn Dispatcher::dispatch()
                 * @context
                 * [
                 *  'data' => resultOf @group Controller/Action
                 * ]
                 */
                "post dispatch"  => ["closeKeywords", "constructView", "setLayout"],
            /**
             * @group General events
             * @risingIn Jeyroik_Base::__construct()
             * @context no
             */
            "the end"        => ["dumpErrors", "modeAction"],

            /**
             * @group Controller/Action
             * @risingIn Dispatcher::dispatch()
             * @context request params
             */

            // Index Controller

            "index/index" => ["indexInIndex"],

            // Docs Controller

            "docs/traits" => ["traitsInDocs"],
            "docs/events" => ["eventsInDocs"],
            "docs/roles"  => ["rolesInDocs"],
            "docs/extend" => ["extendInDocs"],
            "docs/mvc"    => ["mvcInDocs"],

            // Auth Controller

            "auth/" => ["indexInAuth"]
        ],

        "system" =>
        [
            "title"   => "Jeyroik",
            "version" => "0.0.1",
            "author"  => "Se#",
            "mode"    => "release",
            "log"     =>
            [
                "engine" => "db",
                "db" =>
                [
                    "host" => "localhost",
                    "user" => "phpastra",
                    "password" => "phpastra",
                    "db name"  => "test-ocwebastra",
                    "table name" => "test_log"
                ]
            ]
        ],
        
        'error' => 
        [
            'fatal' => 
            [
                'mail' => ['to' => 'admin@domain']
            ]
        ],

        'storage' => 
        [
            'system' => 
            [
                'path'   => '/modules/Config/Data/'
            ],
            
            'site' => 
            [
                'type'   => 'json',
                'path'   => '/application/configs/site/'
            ],
            
            'content' => 
            [
                'engine' => 'db',
                'type'   => 'Mysql',
                'path'   => 
                [
                    'db' => 'db_name',
                    'host' => 'localhost',
                    'user' => 'user_name',
                    'password' => 'password'
                ]
            ]
        ]
    ];
    
    /**
     * Merge role config with the onLoad config
     */
    public function mergeOnLoad()
    {
        if(is_file('../application/configs/roles/' . __CLASS__ . '.php'))// m.b. /configs/onload/<role>.json/php ?
        {
            $cfg = include '../application/configs/roles/' . __CLASS__ . '.php';
            $this->onLoad = array_replace_recursive($this->onLoad, $cfg);
        }
    }
}
