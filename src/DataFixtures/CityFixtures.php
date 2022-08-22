<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class CityFixtures extends Fixture
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $cities = [
            [
                "name" => "Barcelone",
                "image" => "https://images.unsplash.com/photo-1630219694734-fe47ab76b15e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1052&q=80",
                "country" => "Espagne",
                "description" => "Cosmopolite, ardente, radieuse et jouissant d'un patrimoine culturel unique, Barcelone est l'une des villes les plus plébiscitées par les français. Choisir Barcelone c'est vivre près de la mer, jouir d'un climat doux et d'une qualité de vie inestimable.",
                "slug" => "barcelone",
            ],
            [
                "name" => "Berlin",
                "image" => "https://images.unsplash.com/photo-1587330979470-3595ac045ab0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "country" => "Allemagne",
                "description" => "La capitale allemande est née au XIIIe siècle. Le Mémorial de l’Holocauste et les pans restants du mur de Berlin, sur lesquels des graffitis ont été peints, témoignent de son passé tumultueux. Divisée en deux pendant la guerre froide, la ville a adopté la porte de Brandebourg du XVIIIe siècle comme symbole de sa réunification. La ville est aussi réputée pour sa scène artistique, sa culture underground et ses monuments modernes",
                "slug" => "berlin",
            ],
            [
                "name" => "Le Cap",
                "image" => "https://images.unsplash.com/photo-1609024894319-4f497f8c991c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1236&q=80",
                "country" => "Afrique du Sud",
                "description" => "Le Cap est une ville portuaire située sur la côte sud-ouest de l’Afrique du Sud, sur une péninsule dominée par l’imposante montagne Table Mountain mais aussi les collines de Signal Hill et Lion’s Head. La ville doit également sa renommée à Robben Island, la prison devenue musée, dans laquelle Nelson Mandela, mais aussi le très beau Cap de bonne espérance.",
                "slug" => "le-cap",
            ],
            [
                "name" => "Londres",
                "image" => "https://images.unsplash.com/photo-1533929736458-ca588d08c8be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80",
                "country" => "Royaume-Uni",
                "description" => "Londres est une ville chargée d’histoire, où le médiéval et le style victorien cohabitent avec un monde moderne riche et dynamique. La tour de Londres et l’abbaye de Westminster avoisinent les pubs et les marchés locaux, et des rituels usés par le temps comme la relève de la garde ont lieu pendant que les usagers se précipitent pour prendre le métro. C’est une ville où vous pouvez se promener et se divertir et, lorsque vous êtes fatigué : prenez une tasse de thé.",
                "slug" => "londres",
            ],
            [
                "name" => "Los Angeles",
                "image" => "https://upload.wikimedia.org/wikipedia/commons/6/69/Los_Angeles_with_Mount_Baldy.jpg",
                "country" => "États-Unis",
                "description" => "Los Angeles, souvent abrégé en L.A., est la deuxième ville des États-Unis en nombre d'habitants après New York. Située dans le Sud de l'État de Californie, sur la côte du Pacifique, la ville est le siège du comté de Los Angeles. La population de la ville est de 3 898 747 habitants, alors qu'elle n'est que de 11 500 en 1887. Los Angeles, en espagnol, signifie « les anges ». En anglais, ses habitants sont appelés Angelenos. Los Angeles est souvent désignée comme la capitale mondiale du divertissement à travers ses imposantes industries cinématographiques et télévisuelles, ainsi que musicales et artistiques.",
                "slug" => "los-angeles",
            ],
            [
                "name" => "Rome",
                "image" => "https://images.unsplash.com/photo-1515542622106-78bda8ba0e5b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "country" => "Italie",
                "description" => "Capitale de l'Italie, Rome est une grande ville cosmopolite dont l'art, l'architecture et la culture de presque 3 000 ans rayonnent dans le monde entier. Ses ruines telles que celles du Forum Romain et du Colisée évoquent la puissance de l'ancien Empire romain. Siège de l'Église catholique romaine, la Cité du Vatican compte la basilique Saint-Pierre et les musées du Vatican où se trouvent des chefs-d'œuvre tels que la fresque de la chapelle Sixtine, peinte par Michel-Ange.",
                "slug" => "rome",
            ],
        
        ];

        $citiesObjArray = [];
        foreach ($cities as $currentCity) {
            
            $cityObj = new City();
            $cityObj->setName($currentCity['name']);
            $cityObj->setImage($currentCity['image']);
            $cityObj->setCountry($currentCity['country']);
            $cityObj->setDescription($currentCity['description']);
            $cityObj->setSlug($this->slugger->slug(strtolower($currentCity['name'])));

            //* to link cities to posts
            // $citiesObjArray[md5($currentCity['name'])] = $cityObj;
            $manager->persist($cityObj);

            //* reference to link fixtures files
            $this->addReference($currentCity['name'], $cityObj);
 
        }

        $manager->flush();

        
    }
}
