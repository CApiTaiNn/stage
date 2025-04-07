<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    $article = [
        [
            'title' => 'Laravel 10',
            'content' => 'Laravel 10 is the latest version of the Laravel framework.',
        ],
        [
            'title' => 'PHP 8.2',
            'content' => 'PHP 8.2 is the latest version of the PHP programming language.',
        ],
        [
            'title' => 'Vue 3',
            'content' => 'Vue 3 is the latest version of the Vue.js framework.',
        ],
        [
            'title' => 'React 18',
            'content' => 'React 18 is the latest version of the React library.',
        ],
    ];
    return view('login', [
        'article' => $article
    ]);
});
