<?php

namespace YATA\DataRetrieverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use YATA\DataRetrieverBundle\Object\Search;
use Buzz\Browser;
use Buzz\Client\Curl;
use Twitter\OAuth2\Consumer;
use Twitter\TwitterSearchConverter;

class TwitterController extends Controller
{

    public function indexAction(Request $request)
    {
        $search = new Search();
        $form = $this->createFormBuilder($search)
            ->setAction($this->generateUrl('yata_data_retriever_tweet'))
            ->setMethod('POST')
            ->add('searchParams', 'text', array('required' => true))
            ->add('lang', 'choice', array(
                'choices' => array(
                    ''      => 'All',
                    'en'    => 'English',
                    'fr'    => 'French',
                    'ar'    => 'Arabic'
                ),
                'required' => false
            ))
            ->add('locale', 'text', array('required' => false))
            ->add('resultType', 'choice', array(
                'choices' => array(
                    'popular' => 'Popular',
                    'recent' => 'Recent',
                    'mixed' => 'Mixed'
                    ),
                    'required' => false
                ))
            ->add('count', 'text', array('required' => false))
            ->add('includeEntities', 'text', array('required' => false))
            ->add('send', 'submit', array('label' => 'Get Tweets'))
            ->getForm();
            
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $data = $form->getData();
            return $this->redirect($this->generateUrl('yata_data_retriever_tweet', array('data' => $form)));
        }

        return $this->render('YATADataRetrieverBundle:Default:index.html.twig',
                            array('form' => $form->createView()
                        ));
    }

    public function tweetAction(Request $request)
    {
        //Getting form data
        $data = $request->request->get('form');
        
        $resultsDecode = $this->getTweets($data);
        $this->saveTweets($resultsDecode);
        
        return $this->render('YATADataRetrieverBundle:Default:tweet.html.twig', array('data' => $resultsDecode));
        
        return $this->redirect($this->generateUrl('yata_data_retriever_homepage'));
    }
    
    private function getTweets($data)
    {
        //Creating data to call Twitter API
        $consumer_key = $this->container->getParameter('twitter_app_id');
        $consumer_secret = $this->container->getParameter('twitter_secret');
        $searchUrlParams = "";
        $curl = new Curl();
        $curl->setVerifyPeer(false);
        
        //Getting the search and all the options
        $searchParams = $data['searchParams'];
        $tabSearch = explode(" ", $searchParams);
        foreach ($tabSearch as $elem)
            $searchUrlParams .= $elem;
        $lang = $data['lang'];
        $locale = $data['locale'];
        $resultType = $data['resultType'];
        $count = $data['count'];
        $includeEntities = $data['includeEntities'];
        
        //Getting tweets
        $client = new Browser($curl);
        $consumer = new Consumer($client, $consumer_key, $consumer_secret);
        //$consumer->setConverter('/1.1/search/tweets.json', new TwitterSearchConverter());
        $query = $consumer->prepare('/1.1/search/tweets.json',
                                    'GET',
                                    array(
                                        'q' => $searchUrlParams,
                                        'lang' => $lang,
                                        'locale' => $locale,
                                        'resultType' => $resultType,
                                        'count' => $count,
                                        'includeEntities' => $includeEntities
                                    ));
        $results = $consumer->execute($query);
        return $resultsDecode = bson_decode(bson_encode($results->toArray()));
    }
    
    private function saveTweets($data)
    {
        
    }
    
    
}