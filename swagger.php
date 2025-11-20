<?php

header("Content-Type: application/json");

// OpenAPI schema definition
$openapi = [
    "openapi" => "3.1.0",
    "info" => [
        "title" => "Forward API",
        "version" => "1.0.0",
        "description" => "Documentation for the Forward API (users, login, persons, posts)"
    ],
    "servers" => [
        ["url" => "https://" . $_SERVER["HTTP_HOST"]],
        ["url" => "http://localhost:3000"]
    ],
    "paths" => [

        "/" => [
            "get" => [
                "summary" => "Root health check",
                "responses" => [
                    "200" => ["description" => "API OK"]
                ]
            ]
        ],

        "/api" => [
            "get" => [
                "summary" => "API healthcheck",
                "responses" => [
                    "200" => ["description" => "OK"]
                ]
            ]
        ],

        "/api/login" => [
            "post" => [
                "summary" => "Authenticate user",
                "requestBody" => [
                    "required" => true,
                    "content" => [
                        "application/json" => [
                            "schema" => [
                                "type" => "object",
                                "properties" => [
                                    "email" => ["type" => "string"],
                                    "password" => ["type" => "string"]
                                ],
                                "required" => ["email", "password"]
                            ]
                        ]
                    ]
                ],
                "responses" => [
                    "200" => [
                        "description" => "Successful login",
                        "content" => [
                            "application/json" => ["schema" => ["$ref" => "#/components/schemas/User"]]
                        ]
                    ],
                    "401" => ["description" => "Invalid credentials"]
                ]
            ]
        ],

        "/api/users" => [
            "get" => [
                "summary" => "Get all users",
                "responses" => [
                    "200" => [
                        "description" => "List of users",
                        "content" => [
                            "application/json" => [
                                "schema" => [
                                    "type" => "array",
                                    "items" => ["$ref" => "#/components/schemas/User"]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],

        "/api/persons" => [
            "get" => [
                "summary" => "Get all persons",
                "responses" => [
                    "200" => [
                        "description" => "List of persons",
                        "content" => [
                            "application/json" => [
                                "schema" => [
                                    "type" => "array",
                                    "items" => ["$ref" => "#/components/schemas/Person"]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],

        "/api/posts" => [
            "get" => [
                "summary" => "Get all posts",
                "responses" => [
                    "200" => [
                        "description" => "List of posts",
                        "content" => [
                            "application/json" => [
                                "schema" => [
                                    "type" => "array",
                                    "items" => ["$ref" => "#/components/schemas/Post"]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
    ],

    "components" => [
        "schemas" => [

            "User" => [
                "type" => "object",
                "properties" => [
                    "user_pk" => ["type" => "string"],
                    "user_username" => ["type" => "string"],
                    "user_email" => ["type" => "string"],
                    "user_full_name" => ["type" => "string"]
                ]
            ],

            "Person" => [
                "type" => "object",
                "properties" => [
                    "person_pk" => ["type" => "integer"],
                    "person_username" => ["type" => "string"],
                    "person_first_name" => ["type" => "string"]
                ]
            ],

            "Post" => [
                "type" => "object",
                "properties" => [
                    "post_pk" => ["type" => "string"],
                    "post_message" => ["type" => "string"],
                    "post_image_path" => ["type" => "string"],
                    "post_user_fk" => ["type" => "string"]
                ]
            ]
        ]
    ]
];

echo json_encode($openapi, JSON_PRETTY_PRINT);