<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$swagger = [
    "openapi" => "3.0.0",
    "info" => [
        "title" => "FWD Backend API",
        "version" => "1.0.0",
        "description" => "REST API for managing users, posts and person records in the FWD exam project."
    ],

    "servers" => [
        [
            "url" => "https://michelleenoe.com",
            "description" => "Production server"
        ]
    ],

    "paths" => [

        "/api/users" => [

            "get" => [
                "summary" => "Retrieve all users",
                "tags" => ["Users"],
                "responses" => [
                    "200" => [
                        "description" => "List of users",
                        "content" => [
                            "application/json" => [
                                "schema" => [
                                    "type" => "array",
                                    "items" => [ "\$ref" => "#/components/schemas/User" ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],

            "post" => [
                "summary" => "Create a new user",
                "tags" => ["Users"],
                "requestBody" => [
                    "required" => true,
                    "content" => [
                        "application/json" => [
                            "schema" => [ "\$ref" => "#/components/schemas/UserCreateInput" ]
                        ]
                    ]
                ],
                "responses" => [
                    "201" => [ "description" => "User created successfully" ],
                    "400" => [ "description" => "Missing or invalid fields" ]
                ]
            ],

            "put" => [
                "summary" => "Update an existing user",
                "tags" => ["Users"],
                "requestBody" => [
                    "required" => true,
                    "content" => [
                        "application/json" => [
                            "schema" => [ "\$ref" => "#/components/schemas/UserUpdateInput" ]
                        ]
                    ]
                ],
                "responses" => [
                    "200" => [ "description" => "User updated" ],
                    "400" => [ "description" => "Missing fields" ]
                ]
            ],

            "delete" => [
                "summary" => "Delete a user",
                "tags" => ["Users"],
                "requestBody" => [
                    "required" => true,
                    "content" => [
                        "application/json" => [
                            "schema" => [ "\$ref" => "#/components/schemas/UserDeleteInput" ]
                        ]
                    ]
                ],
                "responses" => [
                    "200" => [ "description" => "User deleted" ],
                    "400" => [ "description" => "Missing primary key" ]
                ]
            ]
        ],


        "/api/posts" => [
            "get" => [
                "summary" => "Retrieve all posts",
                "tags" => ["Posts"],
                "responses" => [
                    "200" => [
                        "description" => "List of posts",
                        "content" => [
                            "application/json" => [
                                "schema" => [
                                    "type" => "array",
                                    "items" => [ "\$ref" => "#/components/schemas/Post" ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],

            "post" => [
                "summary" => "Create a post",
                "tags" => ["Posts"],
                "requestBody" => [
                    "required" => true,
                    "content" => [
                        "application/json" => [
                            "schema" => [ "\$ref" => "#/components/schemas/PostCreateInput" ]
                        ]
                    ]
                ],
                "responses" => [
                    "201" => [ "description" => "Post created" ],
                    "400" => [ "description" => "Missing fields" ]
                ]
            ]
        ],


        "/api/person" => [
            "get" => [
                "summary" => "Retrieve all person records",
                "tags" => ["Person"],
                "responses" => [
                    "200" => [
                        "description" => "List of person entries",
                        "content" => [
                            "application/json" => [
                                "schema" => [
                                    "type" => "array",
                                    "items" => [ "\$ref" => "#/components/schemas/Person" ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]

    ],


    "components" => [
        "schemas" => [

            "User" => [
                "type" => "object",
                "properties" => [
                    "user_pk"       => ["type" => "string"],
                    "user_username" => ["type" => "string"],
                    "user_email"    => ["type" => "string"],
                    "user_full_name"=> ["type" => "string"]
                ]
            ],

            "UserCreateInput" => [
                "type" => "object",
                "required" => ["username", "email", "password"],
                "properties" => [
                    "username"  => ["type" => "string"],
                    "email"     => ["type" => "string"],
                    "password"  => ["type" => "string"],
                    "full_name" => ["type" => "string"]
                ]
            ],

            "UserUpdateInput" => [
                "type" => "object",
                "required" => ["user_pk"],
                "properties" => [
                    "user_pk"       => ["type" => "string"],
                    "user_full_name"=> ["type" => "string"]
                ]
            ],

            "UserDeleteInput" => [
                "type" => "object",
                "required" => ["user_pk"],
                "properties" => [
                    "user_pk" => ["type" => "string"]
                ]
            ],

            "Post" => [
                "type" => "object",
                "properties" => [
                    "post_pk"        => ["type" => "string"],
                    "post_message"   => ["type" => "string"],
                    "post_image_path"=> ["type" => "string"],
                    "post_user_fk"   => ["type" => "string"]
                ]
            ],

            "PostCreateInput" => [
                "type" => "object",
                "required" => ["post_message", "post_image_path", "post_user_fk"],
                "properties" => [
                    "post_message"    => ["type" => "string"],
                    "post_image_path" => ["type" => "string"],
                    "post_user_fk"    => ["type" => "string"]
                ]
            ],

            "Person" => [
                "type" => "object",
                "properties" => [
                    "person_pk"       => ["type" => "integer"],
                    "person_username" => ["type" => "string"],
                    "person_first_name"=> ["type" => "string"]
                ]
            ]
        ]
    ]
];

echo json_encode($swagger, JSON_PRETTY_PRINT);
