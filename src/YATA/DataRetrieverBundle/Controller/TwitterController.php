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
            ->add('username', 'text', array('required' => false))
            ->add('keywords', 'text', array('required' => false))
            ->add('hashtags', 'text', array('required' => false))
            ->add('lang', 'choice', array(
                'choices' => array(
                    ''      => 'All',
                    'en'    => 'English',
                    'fr'    => 'French',
                    'ar'    => 'Arabic'
                ),
                'required' => false
            ))
            ->add('country', 'text', array('required' => false))
            ->add('send', 'submit', array('label' => 'Get Tweets'))
            ->getForm();

        return $this->render('YATADataRetrieverBundle:Default:index.html.twig', array('form' => $form->createView()));
    }

    public function tweetAction(Request $request)
    {

        if ($request->getMethod() == 'POST')
        {
            $form = $request->request->get('form');
            unset($form['send']);
            unset($form['_token']);
            return $this->render('YATADataRetrieverBundle:Default:tweet.html.twig',
                array('data' => json_encode($form))
            );
        }

        return $this->redirect($this->generateUrl('yata_data_retriever_homepage'));
    }
}