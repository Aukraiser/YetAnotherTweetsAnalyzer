<?php
namespace YATADataRetrieverBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

class Tweet
{
    /**
     * MongoDB\Id
     */
    private $id;
    
    private $createdAt;
    private $tweetId;
    private $text;
    private $user;
    private $place;
    private $retweetCount;
    private $favouriteCount;
    private $urls;
    private $lang;
    
    
}