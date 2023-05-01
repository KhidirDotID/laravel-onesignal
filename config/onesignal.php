<?php
return [

    /*
    |-------------------------------------------------------------------------------------------
    | URL - One Signal have different endpoint.
    |-------------------------------------------------------------------------------------------
    |
    */
    'url'    => env('ONE_SIGNAL_URL', 'https://onesignal.com/api/v1/'),

    /*
    |-------------------------------------------------------------------------------------------
    | App Id - One Signal have different App Id for every app.
    |
    | Based on App you are using, you can change the App Id here and specify here
    |-------------------------------------------------------------------------------------------
    |
    */
    'app_id' => env('ONE_SIGNAL_APP_ID'),

    /*
    |-------------------------------------------------------------------------------------------
    | API Key - One Signal have different API Key for every app.
    |
    | Based on App you are using, you can change the API Key here and specify here
    |-------------------------------------------------------------------------------------------
    |
    */
    'api_key' => env('ONE_SIGNAL_API_KEY'),

    /*
    |-------------------------------------------------------------------------------------------
    | mutable_content - Always defaults to true and cannot be turned off. Allows tracking of notification receives
    | and changing of the notification content in app before it is displayed.
    |-------------------------------------------------------------------------------------------
    |
    */
    'mutable_content' => env('ONE_SIGNAL_MUTABLE_CONTENT', true),

    /*
    |-------------------------------------------------------------------------------------------
    | Auth Key - One Signal have Auth Key of account.
    |
    | You can manage apps
    |-------------------------------------------------------------------------------------------
    |
   */
    'auth_key' => env('ONE_SIGNAL_AUTH_KEY')
];
