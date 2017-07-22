<?php

$boilerplate = [
    "Mirror" => [
        "title" => $title,
        "masks" => $masks,
        "layers" => [
            "Webcam" => [
                "width" => 100,
                "width_type" => "%",
                "height" => 100,
                "height_type" => "%",
                "priority" => 0,
                "components" => [
                    "staticbackground" => [
                        "priority" => 1,
                        "source" => [
                            "type" => "texture",
                            "id" => "data/testbackground.png"
                        ],
                        "size" => [
                            "width" => 100,
                            "width_type" => "%",
                            "height" => 100,
                            "height_type" => "%"
                        ],
                        "position" => [
                            "x" => "center",
                            "x_type" => "literal",
                            "y" => "center",
                            "y_type" => "literal",
                        ]
                    ]
                ]
            ]
        ],
        "camerasource" => [
            "id" => 0,
            "width" => 640,
            "height" => 480,
            "rotation" => 0,
            "mirror_x" => false,
            "mirror_y" => false
        ],
        "window" => [
            "width" => $windowWidth, //360
            "height" => $windowHeight, //640
            "fullscreen" => $windowFullscreen, //false
            "hideCursor" => $windowHideCursor // false
        ],
        "connection" => [
            "endpoint" => "http://217.70.170.39/api",
            "interval" => $heartbeatInterval,
            "socialSharingUploadPath" => $socialSharingUploadPath
        ]
    ]
];

return json_encode($boilerplate, JSON_PRETTY_PRINT);