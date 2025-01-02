<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->middleware('guest')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->middleware('auth')->withoutMiddleware('guest')->name('logout');
    });

    Route::controller('RegisterController')->middleware(['guest'])->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register');
        Route::post('check-user', 'checkUser')->name('checkUser')->withoutMiddleware('guest');
    });

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });

    Route::controller('ResetPasswordController')->group(function () {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });

    Route::controller('SocialiteController')->group(function () {
        Route::get('social-login/{provider}', 'socialLogin')->name('social.login');
        Route::get('social-login/callback/{provider}', 'callback')->name('social.login.callback');
    });
});

Route::middleware('auth')->name('user.')->group(function () {

    Route::get('user-data', 'User\UserController@userData')->name('data');
    Route::post('user-data-submit', 'User\UserController@userDataSubmit')->name('data.submit');

    //authorization
    Route::middleware('registration.complete')->namespace('User')->controller('AuthorizationController')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('2fa.verify');
    });

    Route::middleware(['check.status', 'registration.complete'])->group(function () {

        Route::namespace('User')->group(function () {

            Route::controller('UserController')->group(function () {
                Route::get('dashboard', 'home')->name('home');
                Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                //KYC
                Route::get('kyc-form', 'kycForm')->name('kyc.form');
                Route::get('kyc-data', 'kycData')->name('kyc.data');
                Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');

                //Report
                Route::any('payment/log', 'depositHistory')->name('deposit.history');
                Route::get('transactions', 'transactions')->name('transactions');

                Route::post('add-device-token', 'addDeviceToken')->name('add.device.token');

                Route::post('subscribe/plan/{id}', 'subscribePlan')->name('subscribe.plan');
                Route::get('referrals', 'referrals')->name('referrals');
            });

            //Profile setting
            Route::controller('ProfileController')->group(function () {
                Route::get('profile-setting', 'profile')->name('profile.setting');
                Route::post('profile-setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
            });

            // Withdraw
            Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw')->group(function () {
                Route::middleware('kyc')->group(function () {
                    Route::get('/', 'withdrawMoney');
                    Route::post('/', 'withdrawStore')->name('.money');
                    Route::get('preview', 'withdrawPreview')->name('.preview');
                    Route::post('preview', 'withdrawSubmit')->name('.submit');
                });
                Route::get('history', 'withdrawLog')->name('.history');
            });

            //extra
            Route::controller('ExtraTaskController')->name('task.')->prefix('task')->group(function () {

                Route::get('counter', 'counter')->name('counter');
                Route::get('letter/togglize', 'letterTogglize')->name('letter.togglize');

                Route::post('archive/store/new/{id?}', 'newArchiveStore')->name('archive.store.new');
                Route::post('store/archive', 'archiveStore')->name('archive.store');
                Route::get('archive/list', 'archive')->name('archive');
                Route::post('store/delete/{id}', 'archiveDelete')->name('archive.delete');

                Route::get('download/{id}', 'download')->name('download');
                Route::post('generate/grammer/checker', 'grammerCheck')->name('grammer.check');

                Route::get('favorite/list', 'favoriteList')->name('favorite.list');
                Route::post('favorite', 'addFavorite')->name('favorite.add');
                Route::post('remove/favorite', 'removeFavorite')->name('favorite.remove');
            });

            // Templates
            Route::controller('TemplateController')->name('template.')->prefix('template')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('list', 'list')->name('list');
                Route::get('from/{code}', 'form')->name('form');
                Route::post('generate/{code}', 'generate')->name('generate');
                Route::post('process', 'process')->name('process');
                Route::get('download/{id}', 'download')->name('download');
                Route::post('generate/grammer/checker', 'grammerCheck')->name('grammer.check');

                Route::get('favorite/list', 'favoriteList')->name('favorite.list');
                Route::post('favorite', 'addFavorite')->name('favorite.add');
                Route::post('remove/favorite', 'removeFavorite')->name('favorite.remove');
            });

            // Code
            Route::controller('CodeController')->name('code.')->prefix('code')->group(function () {
                Route::get('list', 'list')->name('list');
                Route::get('from', 'form')->name('form');
                Route::post('generate', 'generate')->name('generate');
                Route::post('remove/{id}', 'remove')->name('remove');
                Route::get('download/{id}', 'download')->name('download');
            });

            // Image
            Route::controller('ImageController')->name('image.')->prefix('image')->group(function () {
                Route::get('list', 'list')->name('list');
                Route::post('generate', 'generate')->name('generate');
                Route::get('remove/{id}', 'remove')->name('remove');
                Route::get('download/{id}', 'download')->name('download');
            });

            Route::controller('ChatController')->group(function () {
                Route::name('chat.')->prefix('chat')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('list/{code}', 'list')->name('list');
                    Route::get('/{code}/{id?}', 'form')->name('form');
                    Route::post('store/{id?}', 'store')->name('store');
                    Route::post('generate', 'generate')->name('generate');
                    Route::post('remove/{id}', 'remove')->name('remove');
                });

                Route::get('finalcial-advisor/{id?}', 'financialAdvisor')->name('finalcial.advisor');
            });

            Route::controller('TranslateController')->name('translate.')->prefix('translate')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('generate', 'generate')->name('generate');
                Route::get('list', 'list')->name('list');
            });

            // Speech-to-Text
            Route::controller('TranscriptController')->name('transcript.')->prefix('transcript')->group(function () {
                Route::get('form', 'form')->name('form');
                Route::post('generate', 'generate')->name('generate');
                Route::post('remove/{id}', 'remove')->name('remove');
                Route::get('download/{id}', 'download')->name('download');
            });

            Route::controller('DownloadController')->name('download.')->prefix('download')->group(function () {
                Route::post('pdf/content', 'pdfContent')->name('pdf.content');
                Route::post('word/content', 'wordContent')->name('word.content');
            });

            Route::controller('WeatherController')->name('weather.')->prefix('weather')->group(function () {
                Route::get('index', 'index')->name('index');
            });
            Route::controller('SeoController')->name('seo.')->prefix('seo')->group(function () {
                Route::get('index', 'index')->name('index');
                Route::get('form', 'form')->name('form');
                Route::post('generate', 'generate')->name('generate');
                Route::get('download/{id}', 'download')->name('download');
            });
        });

        // Payment
        Route::prefix('deposit')->name('deposit.')->controller('Gateway\PaymentController')->group(function () {
            Route::any('/', 'deposit')->name('index');
            Route::post('insert', 'depositInsert')->name('insert');
            Route::get('confirm', 'depositConfirm')->name('confirm');
            Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
            Route::post('manual', 'manualDepositUpdate')->name('manual.update');
        });
    });
});
