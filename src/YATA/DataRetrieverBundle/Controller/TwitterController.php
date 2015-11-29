<?php

namespace YATA\DataRetrieverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use YATA\DataRetrieverBundle\Document\Search;
use Buzz\Browser;
use Buzz\Client\Curl;
use Twitter\OAuth2\Consumer;
use Twitter\TwitterSearchConverter;
use YATA\DataRetrieverBundle\Document\SearchMetadata;
use YATA\DataRetrieverBundle\Document\User;
use YATA\DataRetrieverBundle\Document\Place;
use YATA\DataRetrieverBundle\Document\Tweet;

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
            ->add('resultType', 'choice', array(
                'choices' => array(
                    'popular' => 'Popular',
                    'recent' => 'Recent',
                    'mixed' => 'Mixed'
                    ),
                    'required' => false
                ))
            ->add('send', 'submit', array('label' => 'Get Tweets', 'attr' => array('class' => 'button')))
            ->getForm();
            
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $data = $form->getData();
            return $this->redirect($this->generateUrl('yata_data_retriever_tweet', array('data' => $form)));
        }

        return $this->render('YATADataRetrieverBundle:Twitter:index.html.twig',
                            array('form' => $form->createView()));
    }

    public function tweetAction(Request $request)
    {
        //Getting form data
        $data = $request->request->get('form');
        
        //Create the Search Object
        $search = new Search();
        $search->setSearchParams($data['searchParams']);
        $search->setLang($data['lang']);
        $search->setResultType($data['resultType']);
        
        $resultsDecode = $this->getTweets($data);
        foreach ($resultsDecode->statuses as $tweet)
        {
            $this->saveTweets($tweet, $search);   
        }
        $this->saveMetadata($resultsDecode->search_metadata, $search);
        
        return $this->render('YATADataRetrieverBundle:Twitter:tweet.html.twig',
                            array('data' => $resultsDecode->statuses));
        
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
        $resultType = $data['resultType'];
        
        //Getting tweets
        $client = new Browser($curl);
        $consumer = new Consumer($client, $consumer_key, $consumer_secret);
        //$consumer->setConverter('/1.1/search/tweets.json', new TwitterSearchConverter());
        $query = $consumer->prepare('/1.1/search/tweets.json',
                                    'GET',
                                    array(
                                        'q' => $searchUrlParams,
                                        'lang' => $lang,
                                        'resultType' => $resultType,

                                    ));
        $results = $consumer->execute($query);
        return $resultsDecode = json_decode(json_encode($results->toArray()));
    }
    
    private function saveSearch($data)
    {
        //Get the EntityManager
        $dm = $this->get('doctrine_mongodb')->getManager();       
        $dm->persist($data);
        $dm->flush();
    }
    
    private function saveTweets($data, $search)
    {
        //Get the EntityManager
        $dm = $this->get('doctrine_mongodb')->getManager();
        
        //Create the Tweet Object
        $tweet = new Tweet();
        $tweet->setCreatedAt($data->created_at);
        $tweet->setTweetId($data->id);
        $tweet->setText($data->text);
        $tweet->setRetweetCount($data->retweet_count);
        $tweet->setFavoriteCount($data->favorite_count);
        $tweet->setLang($data->lang);
        
        //Create the User Object
        $user = new User();
        $user->setUserId($data->user->id);
        $user->setName($data->user->name);
        $user->setScreenName($data->user->screen_name);
        $user->setLocation($data->user->location);
        $user->setDescription($data->user->description);
        $user->setUrl($data->user->url);
        $user->setProtected($data->user->protected);
        $user->setFollowersCount($data->user->followers_count);
        $user->setFriendsCount($data->user->friends_count);
        $user->setListedCount($data->user->listed_count);
        $user->setCreatedAt($data->user->created_at);
        $user->setLang($data->user->lang);
        $tweet->setUser($user);
        $tweet->setSearch($search);
        
        
        //Create the Place Object
        if($data->place != null)
           {
                $place = new Place();
                $place->setPlaceType($data->place->place_type);
                $place->setName($data->place->name);
                $place->setFullName($data->place->full_name);
                $place->setCountryCode($data->place->country_code);
                $place->setCountry($data->place->country);
                $tweet->setPlace($place);
        
           }
        
        $dm->persist($tweet);
        $dm->flush();
    }
    
    private function saveMetadata($data, $search)
    {
        //Get the EntityManager
        $dm = $this->get('doctrine_mongodb')->getManager();
    
        //Create the Metadata Object
        $sm = new SearchMetadata();
        $sm->setCompletedIn($data->completed_in);
        $sm->setMaxId($data->max_id);
        $sm->setMaxIdString($data->max_id_str);
        $sm->setQuery($data->query);
        $sm->setRefreshUrl($data->refresh_url);
        $sm->setCount($data->count);
        $sm->setSinceId($data->since_id);
        $sm->setSinceIdString($data->since_id_str);
        $sm->setSearch($search);
        
        $dm->persist($sm);
        $dm->flush();
    }
    
    
}