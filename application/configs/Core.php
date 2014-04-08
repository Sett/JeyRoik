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
            "Layout",
            [
                "plugins" =>
                [
                    "library/Jeyroik/Plugins/prefix.php" => "Layout",
                ],

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
            [
                "plugins" => 
                [
                    "library/Jeyroik/Plugins/prefix.php" => "Controller",
                    "library/Jeyroik/Plugins/traitPath.php" => "application/"
                ],
                
                "traits" => 
                [
                    "Index",
                    "Docs"
                ]
            ]
        ]
    ];
