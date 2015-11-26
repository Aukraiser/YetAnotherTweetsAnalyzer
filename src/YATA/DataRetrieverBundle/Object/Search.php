<?php
namespace YATA\DataRetrieverBundle\Object;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    /**
     * @var String Twitter username
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var String Keywords to search for
     */
    private $keywords;

    /**
     * @var String Hashtags to search for
     */
    private $hashtags;

    /**
     * @var String Tweet language
     */
    private $lang;

    /**
     * @var String Country location of the tweet
     */
    private $country;

    /**
     * @return String
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param String $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return String
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param String $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return mixed
     */
    public function getHashtags()
    {
        return $this->hashtags;
    }

    /**
     * @param mixed $hashtags
     */
    public function setHashtags($hashtags)
    {
        $this->hashtags = $hashtags;
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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param String $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

}