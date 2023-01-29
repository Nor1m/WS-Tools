<?php

return [
    'tools' => [

        'server_response' => [
            'title' => 'tools.server_response.title',
            'icon' => 'mdi mdi-database-check',
            'show_in_menu' => true,
            'category' => 'other',
            'max_curl_requests' => 15,
            'curl_redirects_codes' => [301,302,303],
            'max_url_len' => 30,
            'view_path' => 'panel.tools.server.parts.server-response-items'
        ]

    ],

    'time' => [
        'very_slow' => 5,
        'slow' => 1,
        'normal' => 0.7,
        'fast' => 0.2,
    ]
];