<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config_db')->insert([
            'config_id' => 1,
            'config_name' => "configName1",
            'config_json' => '{
    "Mirror": {
        "title": "Spiegel der Evolution",
        "masks": [
            "ersteMaske"
        ],
        "layers": {
            "Webcam": {
                "width": 100,
                "width_type": "%",
                "height": 100,
                "height_type": "%",
                "priority": 0,
                "components": {
                    "staticbackground": {
                        "priority": 1,
                        "source": {
                            "type": "texture",
                            "id": "data\/testbackground.png"
                        },
                        "size": {
                            "width": 100,
                            "width_type": "%",
                            "height": 100,
                            "height_type": "%"
                        },
                        "position": {
                            "x": "center",
                            "x_type": "literal",
                            "y": "center",
                            "y_type": "literal"
                        }
                    }
                }
            }
        },
        "camerasource": {
            "id": 0,
            "width": 640,
            "height": 480,
            "rotation": 0,
            "mirror_x": false,
            "mirror_y": false
        },
        "window": {
            "width": "1",
            "height": "1",
            "fullscreen": false,
            "hideCursor": false
        },
        "connection": {
            "endpoint": "http:\/\/217.70.170.39\/api",
            "interval": "120",
            "socialSharingUploadPath": "https:\/\/www.zoom-erlebniswelt.de\/spiegel_der_evolution\/upload.php"
        }
    }
}',
        ]);

        DB::table('config_db')->insert([
            'config_id' => 2,
            'config_name' => "ZweiteConfig",
            'config_json' => '{
    "Mirror": {
        "title": "Spiegel der Evolution",
        "masks": [
            "zweiteMaske"
        ],
        "layers": {
            "Webcam": {
                "width": 100,
                "width_type": "%",
                "height": 100,
                "height_type": "%",
                "priority": 0,
                "components": {
                    "staticbackground": {
                        "priority": 1,
                        "source": {
                            "type": "texture",
                            "id": "data\/testbackground.png"
                        },
                        "size": {
                            "width": 100,
                            "width_type": "%",
                            "height": 100,
                            "height_type": "%"
                        },
                        "position": {
                            "x": "center",
                            "x_type": "literal",
                            "y": "center",
                            "y_type": "literal"
                        }
                    }
                }
            }
        },
        "camerasource": {
            "id": 0,
            "width": 640,
            "height": 480,
            "rotation": 0,
            "mirror_x": false,
            "mirror_y": false
        },
        "window": {
            "width": "1",
            "height": "1",
            "fullscreen": false,
            "hideCursor": true
        },
        "connection": {
            "endpoint": "http:\/\/217.70.170.39\/api",
            "interval": "120",
            "socialSharingUploadPath": "https:\/\/www.zoom-erlebniswelt.de\/spiegel_der_evolution\/upload.php"
        }
    }
}',
        ]);
    }
}
