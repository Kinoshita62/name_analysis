<?php
// public/index.php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\HomeController;
use App\Controller\ListController;
use App\Controller\SearchController;
use App\Controller\ResultController;
use App\Controller\SaveController;
use App\Controller\DeleteController;

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($path) {
    case '':
    case 'index':  (new HomeController())->index();   break;
    case 'list':   (new ListController())->index();   break;
    case 'search': (new SearchController())->search();break;
    case 'result': (new ResultController())->show();  break;
    case 'save':   (new SaveController())->save();    break;
    case 'delete': (new DeleteController())->delete();break;
    default:
        http_response_code(404);
        echo "ページが見つかりません";
}
