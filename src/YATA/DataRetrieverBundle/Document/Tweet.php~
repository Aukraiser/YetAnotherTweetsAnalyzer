<?php

namespace YATA\DataRetrieverBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use YATA\DataRetrieverBundle\Document\Place;
use YATA\DataRetrieverBundle\Document\User;

/**
 * @MongoDB\Document
 */
class Tweet
{
    /**
     * @MongoDB\Id
     */
    private $id;
    
    /**
     * @MongoDB\Date
     */
    private $createdAt;
    
    /**
     * @MongoDB\Int
     */
    private $tweetId;
    
    /**
     * @MongoDB\String
     */
    private $text;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="User", cascade={"persist"})
     */
    private $user;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="Place", cascade={"persist"})
     */
    private $place;
    
    /**
     * @MongoDB\Int
     */
    private $retweetCount;
    
    /**
     * @MongoDB\Int
     */
    private $favoriteCount;
    
    /**
     * @MongoDB\String
     */
    private $lang;
    
    

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set tweetId
     *
     * @param int $tweetId
     * @return self
     */
    public function setTweetId($tweetId)
    {
        $this->tweetId = $tweetId;
        return $this;
    }

    /**
     * Get tweetId
     *
     * @return int $tweetId
     */
    public function getTweetId()
    {
        return $this->tweetId;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return self
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set place
     *
     * @param Place $place
     * @return self
     */
    public function setPlace(Place $place = null)
    {
        $this->place = $place;
        return $this;
    }

    /**
     * Get place
     *
     * @return Place $place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set retweetCount
     *
     * @param int $retweetCount
     * @return self
     */
    public function setRetweetCount($retweetCount)
    {
        $this->retweetCount = $retweetCount;
        return $this;
    }

    /**
     * Get retweetCount
     *
     * @return int $retweetCount
     */
    public function getRetweetCount()
    {
        return $this->retweetCount;
    }

    /**
     * Set favouriteCount
     *
     * @param int $favouriteCount
     * @return self
     */
    public function setFavoriteCount($favoriteCount)
    {
        $this->favoriteCount = $favoriteCount;
        return $this;
    }

    /**
     * Get favouriteCount
     *
     * @return int $favouriteCount
     */
    public function getFavoriteCount()
    {
        return $this->favouriteCount;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return self
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * Get lang
     *
     * @return string $lang
     */
    public function getLang()
    {
        return $this->lang;
    }
}
