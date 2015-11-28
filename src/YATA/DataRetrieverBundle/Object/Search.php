<?php
namespace YATA\DataRetrieverBundle\Object;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    /**
     * @var String Twitter searchParams
     * @Assert\NotBlank()
     */
    private $searchParams;

    /**
     * @var String Tweet language
     */
    private $lang;
    
    /**
     * @var String Tweet Local
     */
    private $locale;
    
    /**
     * @var String Tweet ResultType
     */
    private $resultType;
    
    /**
     * @var String Tweet Count
     */
    private $count;
    
    /**
     * @var String Tweet IncludeEntities
     */
    private $includeEntities;

    
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
    public function getLocale()
    {
        return $this->locale;
    }
    
    /**
     * @param String $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
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
     * @param Integer count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }
    
    /**
     * @return Integer
     */
    public function getIncludeEntities()
    {
        return $this->includeEntities;
    }
    
    /**
     * @param Boolean includeEntities
     */
    public function setIncludeEntities($includeEntities)
    {
        $this->includeEntities = $includeEntities;
    }
    
    

}