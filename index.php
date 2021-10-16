<?php

$request = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/search' :
        require __DIR__ . '/controllers/SearchController.php';
        break;
    case '/admin' :
        require __DIR__ . '/controllers/AdminLoginPageController.php';
        break;
    case '/admin/login' :
        require __DIR__ . '/controllers/AdminLoginController.php';
        break;
    case '/admin/logout' :
        require __DIR__ . '/controllers/AdminLogoutController.php';
        break;
    case '/admin/home' :
        require __DIR__ . '/controllers/AdminHomePageController.php';
        break;
    case '/admin/data/all' :
        require __DIR__ . '/controllers/AdminGetDataController.php';
        break;
    case '/admin/data/store' :
        require __DIR__ . '/controllers/AdminStoreDataController.php';
        break;
    case '/admin/data/delete' :
        require __DIR__ . '/controllers/AdminDeleteDataController.php';
        break;
    case '/admin/data/delete/multiple' :
        require __DIR__ . '/controllers/AdminMultipleDeleteDataController.php';
        break;
    case '/admin/data/update' :
        require __DIR__ . '/controllers/AdminUpdateDataController.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
