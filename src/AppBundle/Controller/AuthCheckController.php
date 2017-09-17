<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AuthCheckController extends Controller
{
    public function __construct()
    {
       $this->_checkAuth();
    }


    protected function _checkAuth()
    {
        $request = Request::createFromGlobals();
        $userName = $request->headers->get('X-UserName');
        $password = $request->headers->get('X-Password');
        if (isset($userName) && 'admin' === $userName) {
            if (isset($password) && md5('123456') === md5($password)) {
                return true;
            } else {
                $response = new Response();
                $response->setStatusCode(401);
                $response->send();
                die;
            }
        }
    }
}