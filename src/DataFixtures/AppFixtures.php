<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Users;
use App\Entity\Compte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct( UserPasswordEncoderInterface $encoder)
    {
       $this->encoder=$encoder;


    }

    public function load(ObjectManager $manager)
    {
        $role1= new Role();
        $role1->setLibelle("ROLE_SUPADMIN");
        $manager->persist($role1);
        
        $role2= new Role();
        $role2->setLibelle("ROLE_ADMIN");
        $manager->persist($role2);

        $role3= new Role();
        $role3->setLibelle("ROLE_CAISSIER");
        $manager->persist($role3);

        $role4= new Role();
        $role4->setLibelle("ROLE_PARTENAIRE");
        $manager->persist($role4);


        $user = new Users();
    
        $user->setUsername( "login");
        $user->setPassword( $this->encoder->encodePassword($user, "passe"));
        $user->setNom("Nom" );
        $user->setActive(true);
        $user->setRole($role1);
  
         $manager->persist($user);
        $manager->flush();


        $compte = new Compte();
    
        $compte->setNumero( "Numero");
        $compte->setSolde("Solde" );
        $compte->setActive(true);
  
         $manager->persist($compte);
        $manager->flush();
    }
}
