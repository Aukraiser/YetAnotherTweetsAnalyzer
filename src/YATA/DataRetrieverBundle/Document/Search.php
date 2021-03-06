<?php
namespace YATA\DataRetrieverBundle\Document;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use YATA\DataRetrieverBundle\Document\Tweet;
use YATA\DataRetrieverBundle\Document\SearchMetadata;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\Document
 */
class Search
{
    /**
     * @MongoDB\Id
     */
    private $id;
    
    /**
     * @var String Twitter searchParams
     * @Assert\NotBlank()
     * @MongoDB\String
     */
    private $searchParams;

    /**
     * @var String Tweet language
     * @MongoDB\String
     */
    private $lang;
    
    /**
     * @var String Tweet ResultType
     * @MongoDB\String
     */
    private $resultType;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="SearchMetadata", mappedBy="search")
     */
    private $searchMetadata;
    
    /**
     * @MongoDB\ReferenceMany(targetDocument="Tweet", mappedBy="search")
     */
    private $tweets;
    
    /**
     * @return String
     */
    public function getSearchParams()
    {
        return $this->searchParams;
    }

    /**
     * @param String $searchParams
     */
    public function setSearchParams($searchParams)
    {
        $this->searchParams = $searchParams;
    }

    /**
     * @return String
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param String $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }
    
    /**
     * @return String
     */
    public function getResultType()
    {
        return $this->resultType;
    }
    
    /**
     * @param String resultType
     */
    public function setResultType($resultType)
    {
        $this->resultType = $resultType;
    }
    
    /**
     * @return Integer
     */
    public function getCount()
    {
        return $this->count;
    }
    


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __construct()
    {
        $this->tweets = new ArrayCollection();
    }

    /**
     * Set searchMetadata
     *
     * @param YATA\DataRetrieverBundle\Document\SearchMetadata $searchMetadata
     * @return self
     */
    public function setSearchMetadata(\YATA\DataRetrieverBundle\Document\SearchMetadata $searchMetadata)
    {
        $this->searchMetadata = $searchMetadata;
        return $this;
    }
    
    /**
     * Get searchMetadata
     *
     * @return \Doctrine\Common\Collections\Collection $searchMetadata
     */
    public function getSearchMetadata()
    {
        return $this->searchMetadata;
    }

    /**
     * Add tweet
     *
     * @param YATA\DataRetrieverBundle\Document\Tweet $tweet
     */
    public function addTweet(Tweet $tweet)
    {
        $this->tweets[] = $tweet;
    }

    /**
     * Remove tweet
     *
     * @param YATA\DataRetrieverBundle\Document\Tweet $tweet
     */
    public function removeTweet(Tweet $tweet)
    {
        $this->tweets->removeElement($tweet);
    }

    /**
     * Get tweets
     *
     * @return \Doctrine\Common\Collections\Collection $tweets
     */
    public function getTweets()
    {
        return $this->tweets;
    }

    
}
