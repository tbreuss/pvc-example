<?php

use Tebe\Pvc\Controller;

class IndexController extends Controller
{
    public function httpMethods()
    {
        return [
            'index' => ['GET'],
            'features' => ['GET'],
            'contact' => ['GET'],
            'post' => ['POST']
        ];
    }

    public function indexAction()
    {
        return $this->render('index');
    }

    public function featuresAction()
    {
        return $this->render('features');
    }

    public function contactAction(int $a, int $b)
    {
        return $this->render('contact');
    }

    public function postAction()
    {
    }
}
