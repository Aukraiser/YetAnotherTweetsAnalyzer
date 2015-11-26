<?php
namespace YATA\DataRetrieverBundle\Object;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    /**
     * @var String Twitter username
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $username;

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



}