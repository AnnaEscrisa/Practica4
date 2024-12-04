<?php

function githubLogin($userModel)
{
    $config = getConfig('github');
    $github = new Hybridauth\Provider\GitHub($config);
    $github->authenticate();

    $dades = getDadesGithub($github);

    //comprovar token a bbdd social_tokens
    $result = comprovarUsuariSocial($userModel, $dades['gitToken'], $dades['gitId']);

    if ($result) {
        $user = $userModel->selectUserById($result['user_fk']);

        iniciSessio($user['id'], $user['user']);
    } else {
        usuariNou($userModel, $dades['gitEmail'], $dades['gitToken'], $dades['gitId'], 'GitHub');
    }

    $apiResponse = $github->apiRequest('gists');
    $github->disconnect();

    buildMessage(success_l1, 'success', 'home', 'myArticles=true');
}


function deviantArtLogin($userModel)
{
    $deviantart = new OAuth2\Client(DEVIANTART_ID, DEVIANTART_SECRET);

    $authUrl = $deviantart->getAuthenticationUrl(
        'https://www.deviantart.com/oauth2/authorize',
        DEVIANT_CALLBACK
    );

    if (!isset($_GET['code'])) {
        // Redirect the user to the DeviantArt authorization page
        header('Location: ' . $authUrl);
        exit;
    }

    $code = $_GET['code'];

    // Get the access token using the authorization code
    $accessToken = $deviantart->getAccessToken(
        'https://www.deviantart.com/oauth2/token',
        'authorization_code',
        [
            'code' => $code,
            'redirect_uri' => DEVIANT_CALLBACK
        ]
    );

    // Use the access token to access the API
    $accessToken = $accessToken['result']['access_token'];
    echo "Access token: " . $accessToken;

    $apiUrl = 'https://www.deviantart.com/api/v1/oauth2/user/whoami';
    $response = file_get_contents($apiUrl . '?access_token=' . $accessToken);
    $data = json_decode($response, true);

    //comprovar token a bbdd social_tokens
    $result = comprovarUsuariSocial($userModel, $accessToken, $data['userid']);
    if ($result) {
        $user = $userModel->selectUserById($result['user_fk']);

        iniciSessio($user['id'], $user['user']);
    } else {
        usuariNou($userModel, '', $accessToken, $data['userid'], 'DeviantArt');
    }

    buildMessage(success_l1, 'success', 'home', 'myArticles=true');

}

function getConfig($social)
{
    $config = $social == 'github' ? [
        'callback' => CALLBACK,
        'keys' => ['id' => GITHUB_ID, 'secret' => GITHUB_SECRET],
    ] : [
        'clientId' => DEVIANTART_ID,
        'clientSecret' => DEVIANTART_SECRET,
        'redirectUri' => DEVIANT_CALLBACK
    ];
    return $config;
}

function iniciSessio($userId, $username)
{
    $_SESSION['user_id'] = $userId;
    $_SESSION['user'] = $username;
    $_SESSION['admin'] = false;
    $_SESSION['social'] = true;
}


function getDadesGithub($github)
{
    return [
        'gitId' => $github->getUserProfile()->identifier,
        'gitEmail' => $github->getUserProfile()->email,
        'gitToken' => $github->getAccessToken()['access_token']
    ];
}


function usuariNou($userModel, $userEmail, $userToken, $userSocialId, $social)
{
    $username = 'user' . uniqid();

    $userModel->inserirSocialUser($username, $userEmail);
    $userId = $userModel->getLastId();
    $userModel->inserirSocialToken($userId, $userToken, $social, $userSocialId);
    iniciSessio($userId, $username);
}

function comprovarUsuariSocial($userModel, $userToken, $userId)
{
    $user = $userModel->comprovarSocial('token', $userToken)
        ?? $userModel->comprovarSocial('social_id', $userId);

    if ($user && !$userModel->comprovarSocial('token', $userToken)) {
        $userModel->updateSocialToken($userId, $userToken);
    }

    return $user;
}