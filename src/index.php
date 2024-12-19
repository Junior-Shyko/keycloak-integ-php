<?php
require dirname(dirname(__DIR__)) . '/html/vendor/autoload.php';

use JuniorShyko\KeycloakIntegPhp\Controller\KeycloakController;

$provider = new Stevenmaguire\OAuth2\Client\Provider\Keycloak([
    'authServerUrl'             => 'http://localhost:8080/',
    'realm'                     => 'secultce',
    'clientId'                  => 'secultce-api',
    'clientSecret'              => 'svfgVC0noUH2twU6BfyNnUrtrtpb4pqy',
    'redirectUri'               => 'http://localhost:9000/src',
    'encryptionAlgorithm'       => 'RS256',
    'encryptionKey'             => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyKY1Dr/W2ThxEFolnuy/0G2PAoAC2ZzMRM37QyI5jO5IbXqGW1Bswale4wQJ02Iv2JM7DmVROMPngALtm+pTIxg8A64XAEDKqJuBHsYN0lwcehAmYYRpJ2Xu4kNcDHcbdHOAWbIJFdgzJWV5TukKwZbx74km790xNMmdAILV9EOLp8tYxOLIb1Rgd7oke66fOa6dYNZAgQmEDnBlabCjalpH4N0wSm/RODmoYCxJLzRtb4uxlKnl39pq5F5mmdQ0LhRUigihFlhfgnV8fML5uTSwYMI9mx0whfZ7bzDhHzatuC6Ug77BUVwRox88AeZhvWTwSDgpTrFiNAaYMkTfHQIDAQAB',
    'version'                   => '24.0'
]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} else {
    dump($_GET['code']);
    // Try to get an access token (using the authorization coe grant)
    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        dump($token);
    } catch (Exception $e) {
        exit('Failed to get access token: '.$e->getMessage());
    }

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
        printf('Hello %s!', $user->getName());

    } catch (Exception $e) {
        exit('Failed to get resource owner: '.$e->getMessage());
    }

    // Use this to interact with an API on the users behalf
    echo $token->getToken();
}
dump($provider);