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

    public function tweetAction(Request $request)
    {

        if ($request->getMethod() == 'POST')
        {
            $form = $request->request->get('form');
            return $this->render('YATADataRetrieverBundle:Default:tweet.html.twig',
                array('username' => $form["username"])
            );
        }

        return $this->redirect($this->generateUrl('yata_data_retriever_homepage'));
    }
}