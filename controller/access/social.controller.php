<?php

function githubLogin($userModel){
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


function getConfig($social) {
    $config = $social == 'github' ? [
        'callback' => CALLBACK,
        'keys' => ['id' => GITHUB_ID, 'secret' => GITHUB_SECRET],
    ] : [];
    return $config;
}

function iniciSessio($userId, $username){
    $_SESSION['user_id'] = $userId;
    $_SESSION['user'] = $username;
}


function getDadesGithub($github){
    return [
        'gitId' => $github->getUserProfile()->identifier,
        'gitEmail' => $github->getUserProfile()->email,
        'gitToken' => $github->getAccessToken()['access_token']
    ];
}


function usuariNou($userModel, $userEmail, $userToken, $userSocialId, $social){

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

    if ($user && !$userModel->comprovarSocial( 'token', $userToken)) {
        $userModel->updateSocialToken($userId, $userToken);
    }

    return $user;
}