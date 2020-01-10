<?php

namespace App\Helpers;

use GuzzleHttp\Client;


/**
 * Helper class that handles any specific Kobo-API related stuff.
 */
class KoboHelper
{

    /**
     * getClient - function to setup a new GuzzleHTTP client for interacting with the Kobotools API
     * @return GuzzleHTTP Client A client, with the authorisation from the stored Access Token and the url for the Kobotools API.
     */
    public static function getClient ()
    {

        $auth = [config('services.kobo.username'), config('services.kobo.password')];

        $client = new Client([
            'base_uri' => config('services.kobo.endpoint'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'debug' => true,
            'auth' => $auth,
        ]);

        return $client;
    }

    /**
     * getOldClient - function to setup a new GuzzleHTTP client for interacting with the OLD Kobotools API
     * @return GuzzleHTTP Client A client, with the authorisation from the stored Access Token and the url for the Kobotools API.
     */
    public static function getOldClient ()
    {

        $auth = [config('services.kobo.username'), config('services.kobo.password')];

        $client = new Client([
            'base_uri' => config('services.kobo.old_endpoint'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'debug' => true,
            'auth' => $auth,
        ]);

        return $client;
    }




}

