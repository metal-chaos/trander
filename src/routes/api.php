<?php

// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ログインユーザー
Route::get('/user', function () {
    return Auth::user();
})->name('user');

// パスワードリセット
Route::post('/reset-password', 'Auth\ForgotPasswordController@sendPasswordResetLink')->name('reset-password');

// パスワード再設定
Route::post('/regenerate-password', 'Auth\ForgotPasswordController@callResetPassword')->name('regenerate-password');

// SNSログイン
Route::get('/social/{social}', 'Auth\LoginController@socialLogin')->name('social-login');
Route::get('/social/callback/{social}', 'Auth\LoginController@socialCallback')->name('social-callback');

// Guzzleモジュールのクラス読み込み
use GuzzleHttp\Client;

Route::get("/data", function () {
    $client = new Client();
    $sourceUrl = "https://opendata.resas-portal.go.jp/api/v1/prefectures";
    $responseData = $client->request("GET", $sourceUrl, array(
        "headers" => array(
            "X-API-KEY" => 'sOVOWs4CXZbBiqrR1lu88W2SsxKgWqg4ssir5M8u',
        ),
    ));
    $responseBody = json_decode($responseData->getBody()->getContents(), true);
    return [
        "status" => "OK",
        "data" => $responseBody,
    ];
});
