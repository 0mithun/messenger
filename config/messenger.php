<?php

/** @noinspection SpellCheckingInspection */

use RTippin\Messenger\Brokers\BroadcastBroker;
use RTippin\Messenger\Brokers\JanusBroker;
use RTippin\Messenger\Brokers\NullBroadcastBroker;
use RTippin\Messenger\Brokers\NullPushNotificationBroker;
use RTippin\Messenger\Brokers\NullVideoBroker;
use RTippin\Messenger\Brokers\PushNotificationBroker;

return [

    /*
    |--------------------------------------------------------------------------
    | MessengerSystem Providers Configuration
    |--------------------------------------------------------------------------
    |
    | List every model you wish to use within this messenger system
    | The name provided will be the alias used for that class for
    | everything including upload folder names, channel names, etc
    |
    | *PLEASE NOTE: Once you choose an alias, you should not change it
    | unless you plan to move the uploads/directory names around yourself
    |
    | *Each provider you list must implement our MessengerProvider contract
    | RTippin\Messenger\Contracts\MessengerProvider
    |
    | *Searchable expects provider to implement the matching contract. see:
    | RTippin\Messenger\Contracts\Searchable
    |
    | *Provider interactions give fine grain control over how your provider can interact with other providers, should you have
    | multiple. A provider always has full permission for interactions between itself, e.g : User to User. To allow full
    | interactions between other providers, simply mark each value as TRUE. For no other interactions, mark NULL or FALSE.
    | To specify which and how each provider can interact with one another, declare each providers alias string, multiple
    | separated by the PIPE, e.g : 'company', 'company|teacher', etc.
    |
    |   'providers' => [                                    //List all providers in your app
    |       'user' => [                                     //alias given to your provider
    |           'model' => App\Models\User::class,          //Path to the provider's model
    |           'searchable' => true,                       //Provider implements/is searchable - true|false
    |           'friendable' => true,                       //Provider is friendable - true|false
    |           'devices' => true,                          //Provider has tokens for push notifications - true|false
    |           'provider_interactions' => [                //What your provider can do with other providers
    |               'can_message' => 'company',             //Able to start new threads with other listed providers - true|false|null|string
    |               'can_search' => 'teacher|company',      //Able to search other listed providers - true|false|null|string
    |               'can_friend' => null,                   //Able to send friend request to  other listed providers - true|false|null|string
    |           ]
    |       ],
    |   ],
    */
    'providers' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Filesystem settings for provider avatars and thread files
    |--------------------------------------------------------------------------
    |
    | For each option below, please seleck the filesystem disk and leading
    | directory you wish you use.
    |
    | ** DO NOT HAVE A LEADING OR TRAILING FORWARD SLASH **
    |
    | *The avatar is where we will store a providers uploaded image. By default,
    | this will store into the storage_path('app/public/images/{alias}/{id}'),
    | given laravels default 'public' disk followed by 'images' directory
    |
    | *The threads option is where a thread avatar, image messages, and document
    | messages will be stored. You should not use the public directory as we
    | will process all files securely though the backend on request.
    |
    | //Thread files
    |
    | **Avatar - {disk}/{directory}/{threadID}/avatar
    | **Images - {disk}/{directory}/{threadID}/images
    | **Documents - {disk}/{directory}/{threadID}/documents
    |
    */
    'storage' => [
        'avatars' => [
            'disk' => 'public',
            'directory' => 'images'
        ],
        'threads' => [
            'disk' => 'messenger',
            'directory' => 'threads'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Messenger routing config
    |--------------------------------------------------------------------------
    |
    | You may choose to load our built in routes, or disable to setup your own.
    | The built in routing has all policy mappings and controllers already
    | setup. Our built in middleware 'messenger.provider' simple takes the
    | authenticated user via the request and sets them as the current
    | messenger provider. You are free to use your own custom middleware
    | to set your provider, and add any other middleware you may want,
    | such as 'auth:api' etc.
    |
    | *For the broadcasting channels to register, you must have already
    | setup/defined your laravel apps broadcast driver
    |
    */
    'routing' => [
        // All web based view/template routes
        'web' => [
            'enabled' => true,
            'domain' => null,
            'prefix' => 'messenger',
            'middleware' => ['auth', 'messenger.provider']
        ],
        // Single route for viewing provider avatar image
        'provider_avatar' => [
            'enabled' => true,
            'domain' => null,
            'prefix' => 'images',
            'middleware' => ['cache.headers:public, max-age=86400;']
        ],
        // All messenger API routes used to return json
        'api' => [
            'enabled' => true,
            'domain' => null,
            'prefix' => 'api/v1/messenger',
            'middleware' => ['api', 'auth', 'messenger.provider:required'],
            // The group invite GET via code is separated so that you may let
            // guest users load information on the invite without being
            // logged in, should you choose
            'invite_public_middleware' => ['api', 'messenger.provider'],
        ],
        // Broadcasting routes and channels that will be used by your driver
        // (pusher, socket, etc) for authenticating private and presence
        // channels
        'channels' => [
            'enabled' => false,
            'domain' => null,
            'prefix' => 'api',
            'middleware' => ['api', 'messenger.provider'],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature/Service drivers
    |--------------------------------------------------------------------------
    |
    | Broadcast Driver must implement BroadcastDriver contract.
    | Video Driver must implement VideoDriver contract.
    |
    */
    'drivers' => [
        'broadcasting' => [
            'default' => BroadcastBroker::class,
            'null' => NullBroadcastBroker::class
        ],
        'push_notifications' => [
            'default' => PushNotificationBroker::class,
            'null' => NullPushNotificationBroker::class
        ],
        'calling' => [
            'janus' => JanusBroker::class,
            'null' => NullVideoBroker::class
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Broadcasting driver
    |--------------------------------------------------------------------------
    |
    | Disable all socket broadcasting by using the 'null' driver or select a
    | driver alias from the above listed drivers. You may also create your
    | own or extend the ones already included.
    |
    | *Please note that by default, if you disable / use null broadcast
    | driver, the push notification driver will not be called
    |
    */
    'broadcasting' => [
        'driver' => env('MESSENGER_BROADCASTING_DRIVER', 'default'),

    ],

    /*
    |--------------------------------------------------------------------------
    | Push Notifications driver
    |--------------------------------------------------------------------------
    |
    | Disable all push notifications by using the 'null' driver or select
    | a driver alias from the above listed drivers. You may also create
    | your own or extend the ones already included.
    |
    */
    'push_notifications' => [
        'driver' => env('MESSENGER_PUSH_NOTIFICATION_DRIVER', 'null'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Calling and drivers
    |--------------------------------------------------------------------------
    |
    | Enable or disable the calling feature
    |
    | Driver must implement VideoDriver contract. You may select a driver alias
    | from the above calling drivers. You may also create your own or extend
    | the ones already included.
    |
    */
    'calling' => [
        'enabled' => env('MESSENGER_CALLING_ENABLED', false),
        'driver' => env('MESSENGER_CALLING_DRIVER', 'null')
    ],

    /*
    |--------------------------------------------------------------------------
    | General file toggles to enable / disable features
    |--------------------------------------------------------------------------
    |
    */
    'files' => [
        'message_documents' => [
            'upload' => env('MESSENGER_MESSAGE_DOCUMENT_UPLOAD', true),
            'download' => env('MESSENGER_MESSAGE_DOCUMENT_DOWNLOAD', true)
        ],
        'message_images' => [
            'upload' => env('MESSENGER_MESSAGE_IMAGE_UPLOAD', true)
        ],
        'thread_avatars' => [
            'upload' => env('MESSENGER_THREAD_AVATAR_UPLOAD', true)
        ],
        'provider_avatars' => [
            'upload' => env('MESSENGER_PROVIDER_AVATAR_UPLOAD', true),
            'removal' => env('MESSENGER_PROVIDER_AVATAR_REMOVAL', true)
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Thread invitations
    |--------------------------------------------------------------------------
    |
    | Enable or disable thread invites. You may also set the max active
    | invites each thread may have at any given time. 0 for unlimited
    |
    */
    'invites' => [
        'enabled' => env('MESSENGER_INVITES_ENABLED', true),
        'max_per_thread' => env('MESSENGER_INVITES_THREAD_MAX', 3)
    ],

    /*
    |--------------------------------------------------------------------------
    | Knock knock!! 👊
    |--------------------------------------------------------------------------
    |
    | Enable or disable knocks, and set the timeout limit (in minutes)
    |
    */
    'knocks' => [
        'enabled' => env('MESSENGER_KNOCKS_ENABLED', true),
        'timeout' => env('MESSENGER_KNOCKS_TIMEOUT', 5)
    ],

    /*
    |--------------------------------------------------------------------------
    | Provider online/away status
    |--------------------------------------------------------------------------
    |
    | Enable or disable showing online/away states, and set the lifetime the
    | status will live in cache (in minutes)
    |
    */
    'online_status' => [
        'enabled' => env('MESSENGER_ONLINE_STATUS_ENABLED', true),
        'lifetime' => env('MESSENGER_ONLINE_STATUS_LIFETIME', 4)
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource collection results limit
    |--------------------------------------------------------------------------
    |
    | Here you can define the default query limits for resource collections
    |
    */
    'collections' => [
        'search' => [
            'page_count' => 25
        ],
        'threads' => [
            'index_count' => 100,
            'page_count' => 25
        ],
        'participants' => [
            'index_count' => 500,
            'page_count' => 50
        ],
        'messages' => [
            'index_count' => 40,
            'page_count' => 25
        ],
        'calls' => [
            'index_count' => 25,
            'page_count' => 25
        ]
    ]
];
