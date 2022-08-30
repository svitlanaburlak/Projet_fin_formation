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
                "description" => "Berlin est la sixième ville européenne la plus visitée. Se perdre dans les différents quartiers de Berlin, se balader au gré des nombreux musées de la ville, boire un verre hors des sentiers battus... Habiter Berlin, c'est entrer dans une autre dimension, où se mêle aisément lourd passé et futur artistique.",
                "slug" => "berlin",
            ],
            [
                "name" => "Le Cap",
                "image" => "https://images.unsplash.com/photo-1580060839134-75a5edca2e99?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2071&q=80",
                "country" => "Afrique du Sud",
                "description" => "Le Cap se situe à la pointe sud du continent africain. Elle présente un cadre époustouflant avec des falaises qui plongent à pic dans l’océan Atlantique, des plages merveilleuses, Blaauwberg Beach pour ne citer qu'elle, et le Jardin botanique national de Kirstenbosch à proximité. La Réserve naturelle du Cap de Bonne-Espérance offre des vues imprenables sur la mer, des chemins de randonnée et une faune exceptionnelle. Dans un autre genre, vous pourrez également visiter Robben Island au large du Cap, où Nelson Mandela a été détenu prisonnier pendant 27 ans.",
                "slug" => "le-cap",
            ],
            [
                "name" => "Londres",
                "image" => "https://images.unsplash.com/photo-1533929736458-ca588d08c8be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80",
                "country" => "Royaume-Uni",
                "description" => "Londres est une ville chargée d’histoire, où le médiéval et le style victorien cohabitent avec un monde moderne riche et dynamique. La tour de Londres et l’abbaye de Westminster avoisinent les pubs et les marchés locaux, et des rituels usés par le temps comme la relève de la garde ont lieu pendant que les usagers se précipitent pour prendre le métro. C’est une ville où vous pouvez vous promener et vous divertir et, lorsque vous êtes fatigué : prenez une tasse de thé.",
                "slug" => "londres",
            ],
            [
                "name" => "Los Angeles",
                "image" => "https://upload.wikimedia.org/wikipedia/commons/6/69/Los_Angeles_with_Mount_Baldy.jpg",
                "country" => "États-Unis",
                "description" => "Los Angeles, souvent abrégé en L.A., est la deuxième ville des États-Unis en nombre d'habitants après New York. Située dans le Sud de l'État de Californie, sur la côte du Pacifique. Los Angeles est souvent désignée comme la capitale mondiale du divertissement à travers ses imposantes industries cinématographiques et télévisuelles, ainsi que musicales et artistiques.",
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
