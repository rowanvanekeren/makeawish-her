<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Pusher Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

   /* 'connections' => [

        'main' => [
            'auth_key' => '384bb2566e2643e8be0e',
            'secret' => '556123d722598505f0dd',
            'app_id' => '277118',
            'options' => [
                'cluster' => 'eu'
            ],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ],*/
    'connections' => [

        'main' => [
            'auth_key' => '7d5f75a6e8d507102cdb',
            'secret' => '680b97afa854d0a9fbb9',
            'app_id' => '275644',
            'options' => [
                'cluster' => 'eu'
            ],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ],

        'alternative' => [
            'auth_key' => 'your-auth-key',
            'secret' => 'your-secret',
            'app_id' => 'your-app-id',
            'options' => [],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ],

    ],

];
