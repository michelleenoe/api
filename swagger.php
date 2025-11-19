<?php

header("Content-Type: application/json");

// Basic API metadata
$openapi = [
    "openapi" => "3.1.0",
    "info" => [
        "title" => "Forward API",
        "version" => "1.0.0"
    ],
    "servers" => [
        ["url" => "https://" . $_SERVER['HTTP_HOST']]
    ],
    "paths" => [
        "/users" => [
            "get" => [
                "summary" => "List all users",
                "responses" => [
                    "200" => [
                        "description" => "OK"
                    ]
                ]
            ]
        ],
        "/posts" => [
            "get" => [
                "summary" => "List all posts",
                "responses" => [
                    "200" => ["description" => "OK"]
                ]
            ]
        ],
        "/persons" => [
            "get" => [
                "summary" => "List all persons",
                "responses" => [
                    "200" => ["description" => "OK"]
                ]
            ]
        ]
    ]
];

echo json_encode($openapi, JSON_PRETTY_PRINT);