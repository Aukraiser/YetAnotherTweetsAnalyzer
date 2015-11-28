<?php
namespace YATA\DataretrieverBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

class User
{
    private $id;
    private $userId;
    private $name;
    private $screenName;
    private $location;
    private $description;
    private $url;
    private $protected;
    private $followersCount;
    private $friendsCount;
    private $listedCount;
    private $createdAt;
    private $lang;
    
    
}