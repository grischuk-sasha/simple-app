<?php
namespace src\controllers\api;

use src\components\http\api\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function actionIndex(Request $request)
    {
        return ['test'];
    }
}