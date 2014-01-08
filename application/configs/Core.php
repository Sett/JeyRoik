<?php
return
    [
        "path" =>
        [
            "class" => "modules/lib/",
            "trait" => "modules/"
        ],

        "traits" =>
        [
            "Jeyroik_Base",
            "Jeyroik_Error",
            "Jeyroik_Event",
            "Jeyroik_Mode",
            "View",
            [
                "name" => "Layout",

                "traits" =>
                [
                    "Title",
                    "Meta",
                    "Keywords",
                    "JS",
                    "CSS"
                ]
            ],
            "Dispatcher",
            "Config_Data_OnLoad",// load config for tp
            "Controller_Index",
            "Controller_Docs"
        ]
    ];
