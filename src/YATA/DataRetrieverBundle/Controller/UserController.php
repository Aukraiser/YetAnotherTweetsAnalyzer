<?php

namespace YATA\DataRetrieverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function indexAction(Request $request)
    {
        $users = $this->getUsers();
        return $this->render('YATADataRetrieverBundle:User:index.html.twig', array('users' => $users));
    }
    
    public function userAction($id)
    {
        $user = $this->user($id);
        return $this->render('YATADataRetrieverBundle:User:user.html.twig', array('user' => $user));
    }
    
    private function user($id)
    {
        $user = $this->get('doctrine_mongodb')
                ->getRepository('YATADataRetrieverBundle:User')
                ->find($id);
        return $user;
    }
    
    private function getUsers()
    {
        //Get the EntityManager
        $users = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('YATADataRetrieverBundle:User')
            ->findAll();         
        return $users;
    }
    
    
}