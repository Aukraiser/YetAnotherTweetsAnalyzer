<?php

namespace YATA\DataRetrieverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use YATA\DataRetrieverBundle\Document\Search;
use YATA\DataRetrieverBundle\Document\Tweet;

class SearchController extends Controller
{

    public function indexAction(Request $request)
    {
        $searches = $this->getSearches();
        return $this->render('YATADataRetrieverBundle:Search:index.html.twig', array('searches' => $searches));
    }
    
    public function searchAction($id)
    {
        //Get the EntityManager
        $tweets = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('YATADataRetrieverBundle:Tweet')
            ->findBy(array('search.id' => $id));
        return $this->render('YATADataRetrieverBundle:Search:tweets.html.twig', array('tweets' => $tweets));
    }
    
    private function getSearches()
    {
        //Get the EntityManager
        $searches = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('YATADataRetrieverBundle:Search')
            ->findAll();         
        return $searches;
    }
    
    
}