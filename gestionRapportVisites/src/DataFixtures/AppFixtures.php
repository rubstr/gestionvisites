<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Offrir;
use App\Entity\Inviter;
use App\Entity\Visiteur;
use App\Entity\Praticien;
use App\Entity\Medicament;
use App\Entity\ActiviteCompl;
use App\Entity\RapportVisite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i=0;$i<=10;$i++)
        {
            $medicament = new Medicament();  
            $medicament->setMedDepotLegal($faker->numberBetween(1,1000))
                        ->setDateAjout(new \DateTime())
                        ->setLibelle($faker->word())
                        ->setDescription($faker->sentence());
            $medicaments[$i] = $medicament;
            $manager->persist($medicament);
        }
        
        for($i=0;$i<=10;$i++)
        {
            //Ajout visiteur
            $visiteur = new Visiteur();
            $visiteur->setVisNom($faker->firstName())
            ->setVisPrenom($faker->lastName());
            
            //Ajout praticien
            $praticien = new Praticien();
            $praticien->setPraPrenom($faker->firstName())
            ->setPraNom($faker->lastName());
            
            //Ajout rapport
            $rapport = new RapportVisite();
            $rapport->setPraticien($praticien)
                    ->setVisiteur($visiteur)
                    ->setRapMotif($faker->sentence())
                    ->setRapBilan($faker->paragraph(4))
                    ->setRapDate(new \DateTime());
                    
            //Ajout offre de medicament
            for($k=0;$k<= mt_rand(1,3);$k++)
            {
                $offrir = new Offrir();
                $offrir->setMedicament($medicaments[mt_rand(0,10)])
                ->setOffQte($faker->randomDigit())
                ->setRapportVisite($rapport);
                $manager->persist($offrir);
            }
            
            //Ajout à la BDD
            $manager->persist($praticien);
            $manager->persist($visiteur);
            $manager->persist($rapport);

            // 1/3 chance d'avoir des activité complémentaire
            for($j=0;$j<3;$j++)
            {
                $token = mt_rand(0,2);
                if($token == $j)
                {
                    //Ajout activite
                    $activite = new ActiviteCompl();
                    $activite->setDate(new \DateTime())
                             ->setLieu($faker->city())
                             ->setTheme($faker->word())
                             ->AddVisiteur($visiteur);
                    $manager->persist($activite);

                    //Ajout invitation
                    $invitation = new Inviter();
                    $invitation->setPraticien($praticien)
                               ->setActiviteCompl($activite)
                               ->setSpecialisation($faker->word());
                    $manager->persist($invitation);
                }
            }
            
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}