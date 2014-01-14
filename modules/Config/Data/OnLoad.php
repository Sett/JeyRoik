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

        "layout" =>
        [
            "extension" => "phtml",

            "title"     => "Jeyroik",
            "separator" => " - ",

            "css" => ["bootstrap"],// will be: bootstrap.css
            "js"  => ["bootstrap"],
            "keywords" => ["фреймворк", "php"],
            "meta" =>
            [
                "viewport" => "width=device-width, initial-scale=1.0",
                "description" => "PHP фреймворк, построенный на трейтах",
                [
                    "http-equiv" => "content-type",
                    "content"    => "text/html; charset=utf-8"
                ]
            ]
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

        "store" =>
        [
            "engine" => "db",

            "file" =>
            [
                "name" => "records.json"
            ],

            "db" =>
            [
                "host" => "localhost",
                "user" => "phpastra",
                "password" => "phpastra",
                "db name"  => "test-ocwebastra",
                "table name" => "test_results"
            ]
        ],
    ];
}
