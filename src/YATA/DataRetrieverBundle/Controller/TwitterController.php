<?php

namespace YATA\DataRetrieverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use YATA\DataRetrieverBundle\Object\Search;

class TwitterController extends Controller
{

    public function indexAction()
    {
        $search = new Search();
        $form = $this->createFormBuilder($search)
            ->setAction($this->generateUrl('yata_data_retriever_tweet'))
            ->setMethod('POST')
            ->add('username', 'text')
            ->add('send', 'submit', array('label' => 'Get Tweets'))
            ->getForm();

        return $this->render('YATADataRetrieverBundle:Default:index.html.twig', array('form' => $form->createView()));
    }

    public function get_tweets($form)
    {
      $form = json_encode($form);
      #$test = system("ruby ../API/TweetsRetriever.rb");
      $test = system("ruby ../src/YATA/DataRetrieverBundle/API/TweetsRetriever.rb");
      return ($test);
    }

    public function tweetAction(Request $request)
    {

        if ($request->getMethod() == 'POST')
        {
            $form = $request->request->get('form');
            $tweet = $this->get_tweets($form);
            return $this->render('YATADataRetrieverBundle:Default:tweet.html.twig',
                array('username' => $form["username"],
                      'tweet' => $tweet)
            );
        }

        return $this->redirect($this->generateUrl('yata_data_retriever_homepage'));
    }
}
