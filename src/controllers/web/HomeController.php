<?php
namespace src\controllers\web;

use src\components\http\web\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function actionIndex(Request $request)
    {
        return $this->render('index.php', [
            'title' => 'Home page'
        ]);
    }
}