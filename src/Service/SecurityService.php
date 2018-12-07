<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityService {
    
    private $om;
    private $encoder;

    public function __construct(ObjectManager $om, UserRepository $repo, UserPasswordEncoderInterface $encoder){
        $this->om = $om;
        $this->encoder = $encoder;
    }

    public function addUser($user){
        $repo = $this->om->getRepository(User::class); 

        $hash = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);

        $this->om->persist($user);
        $this->om->flush();
    }


}