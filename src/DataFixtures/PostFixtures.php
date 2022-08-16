<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Post;
use DateTimeImmutable;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $categories = [
            "Gastronomie",
            "Culture",
            "Sorties",
            "Activités",
            "Evénements",
            "Co-Working"
        ];

        $categoryObjArray = [];
        foreach ($categories as $currentCategory) {
            $categoryObj = new Category();
            $categoryObj->setName($currentCategory);

            //* to be able to link categories to posts
            $categoryObjArray[md5($currentCategory)] = $categoryObj;
            $manager->persist($categoryObj);

        }

        $posts = [
            [
                "title" => "Mayer, délicieuse boulangerie française",
                "content" => "Le pain français vous manque? On a trouvé la boulangerie qui va vous faire du bien au coeur et aux papilles. On retrouve la qualité française du pain tradition mais aussi les brioches feuilletées, les croissants et autres pâtisseries d'une qualité irréprochable ! Nous y allons une fois pas semaine car les prix sont quand même élevés. Mais bon, qui dit qualité française dit prix français. Vous pouvez y aller les yeux fermés !",
                "date" => "",
                "address" => "Carrer Del Diluvi 11, 08012 Barcelona",
                "image" => "https://images.unsplash.com/photo-1530610476181-d83430b64dcd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Xurreria, les meilleurs churros de Barcelone",
                "content" => "Pour les gourmands: les meilleurs churros sont là, option chocolat ou pas. Mon conseil: n'en prenez pas beaucoup c'est gras et vous n'aurez pas faim avant un petit moment.",
                "date" => "",
                "address" => "Carrer dels Banys Nous, 8, 08002 Barcelona",
                "image" => "https://images.unsplash.com/photo-1581911823256-694b27332788?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1331&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Baluard, boulangerie de tradition parisienne",
                "content" => "Enfin des croissants à base de beurre à Barcelone ! très bons pains de campagne aussi, de temps en temps ça fait du bien !",
                "date" => "",
                "address" => "Carrer del Baluard, 38, 08003 Barcelona",
                "image" => "https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1172&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Musée des Sciences Naturelles",
                "content" => "Super moment avec les enfants ! Pour les petits comme les grands, succès assuré !",
                "date" => "",
                "address" => "Plaza Leonardo Da Vinci, 4-5, 08019 Barcelona",
                "image" => "https://images.unsplash.com/photo-1590342360434-7539d8289cd0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Culture",
                ],
            ],
            [
                "title" => "Nau Bostik espace culturel",
                "content" => "Une ancienne usine transformée en espace culturel réunissant créateurs, associations et collectifs qui composent le tissu culturel et social du quartier de la Sagrera. Il y a aussi un espace de coworking pensé pour les professionnels de la culture et de l'art.",
                "date" => "",
                "address" => "Carrer Ferran Turné, 1-11, 08027, Barcelona",
                "image" => "https://images.unsplash.com/photo-1562874662-050427780b20?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Culture",
                ],
            ],
            [
                "title" => "Sortie en famille au Parc Güell",
                "content" => "Entrée payante mais ça vaut le coup croyez-moi. En famille comme entre amis ou en amoureux, vous allez adorer vous promener entre les mosaïques de Gaudi, déambuler entre les colonnes de la salle Hypostyle, vous reposer un instant sur le célèbre banc recouvert de mosaïques avec derrière vous une vue à couper le souffle sur Barcelone. A chaque fois que des amis français viennent nous visiter, nous leur faisons découvrir cet endroit incroyable et nous passons tous un très bon moment.",
                "date" => "",
                "address" => "08024 Barcelona",
                "image" => "https://images.unsplash.com/photo-1593368858664-a7fe556ab936?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Sorties",
                ],
            ],
            [
                "title" => "Boire un verre au Bar-Terraza Ayre Rossellón",
                "content" => "Si vous voulez boire un verre avec vue sur la Sagrada Familia et la mer en second plan, venez au dernier étage de cet hôtel ! Le personnel est accueillant, les cocktails sont délicieux et l'ambiance cool avec musique lounge et food truck proposé certains soirs. Pensez à réserver pour être sûr de ne pas finir debout toute la soirée. ",
                "date" => "",
                "address" => "Carrer del Rosselló, 390, 08025 Barcelona",
                "image" => "https://images.unsplash.com/photo-1621275471769-e6aa344546d5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1173&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Sorties",
                ],
            ],
            [
                "title" => "Un cinéma en plein air sur la colline de Montjuïc !",
                "content" => "Tout l'été, ils projettent des films cultes (Pulp Fiction, Grease, Licorice Pizza, West Side Story, The Big Lebowski et tant d'autres). Prenez un drap pour vous installer, ramenez un pique-nique et votre meilleure bouteille de vin et passez une soirée inoubliable ! Vous pourrez aussi acheter à manger sur place.",
                "date" => "",
                "address" => "Jardins del Castell de Montjuïc",
                "image" => "https://images.unsplash.com/photo-1527979809431-ea3d5c0c01c9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1209&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Activités",
                ],
            ],
            [
                "title" => "Frizzant - espace yoga restaurant et bien-être",
                "content" => "Un lieu unique qui dispense des sessions de yoga de tout type, et propose un espace restaurant avec options végétariennes, vegan, gluten free et protein friendly. Faîtes un cours d'essai, vous allez adorer !",
                "date" => "",
                "address" => "Gran Via de les Corts Catalanes, 692 Barcelona",
                "image" => "https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1220&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Activités",
                ],
            ],
            [
                "title" => "Allons boire un verre au Xiringuito Bambú ce samedi vers 18h !",
                "content" => "Pour ceux qui aiment la bonne musique et boire des cocktails sur la plage, rejoignez-nous ce samedi pour prendre l'apéro et se rencontrer entre français ! Si vous venez plus tôt, vous pourrez même louer un hamac et si vous venez en famille, ils ont un espace baby-friendly  ",
                "date" => "2022-09-10",
                "address" => "Ronda Litoral s/n, 08005 Barcelona",
                "image" => "https://images.unsplash.com/photo-1560359614-870d1a7ea91d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Evénements",
                ],
            ],
            [
                "title" => "Une journée en famille à Sitges à 30mn de Barcelone en train",
                "content" => "Nous vous proposons de venir passer une journée visite de Sitges en famille ! C'est une magnifique petite ville au bord de l'eau, située à 30mn de Barcelone, les plages sont très jolies et c'est très agréable de déambuler dans ses rues. Pour ceux qui ne connaissent pas, venez passer la journée avec nous !",
                "date" => "2022-09-03",
                "address" => "08870 Sitges",
                "image" => "https://images.unsplash.com/photo-1599484206596-adc1a429c2a0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1232&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Evénements",
                ],
            ],
            [
                "title" => "Cafeteria del museo marítimo",
                "content" => "Pour travailler tranquille, je recommande la cafétéria du museo marítimo, il y a un bon wifi et le café est à 1€20. Très bel espace intérieur et jolie cour tranquille!",
                "date" => "",
                "address" => "Av. de les Drassanes, s/n, 08001 Barcelona",
                "image" => "https://images.unsplash.com/photo-1527192491265-7e15c55b1ed2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Barcelone",
                "categories" => [
                    "Co-Working",
                ],
            ],
            [
                "title" => "Mustafa's Gemüse Kebap",
                "content" => "Petit kiosque proposant de généreux kebabs au poulet très appréciés, accompagnés de légumes grillés. S'armer de patience, la file d'attente est souvent très longue !",
                "date" => "",
                "address" => "Mehringdamm 32, 10961 Berlin",
                "image" => "https://media0.faz.net/ppmedia/aktuell/stil/essen-trinken/3501693546/1.5946904/format_top1_breit/woran-liegt-es-dass-menschen.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Berlin",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "East Side Gallery",
                "content" => "C’était autrefois le Mur de Berlin. C’est aujourd’hui la plus longue galerie à ciel ouvert du monde. 1,3 km incroyables pour découvrir ou redécouvrir l’art et l’histoire du Mur de Berlin.",
                "date" => "",
                "address" => "Mühlenstraße 3-100, 10243 Berlin",
                "image" => "https://images.unsplash.com/photo-1642764984363-a1d85a10b834?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1146&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Berlin",
                "categories" => [
                    "Culture",
                ],
            ],
            [
                "title" => "Bier Festival Berliner Oktoberfest",
                "content" => "Tout comme sa rivale Munich, Berlin organise, elle aussi, la fête de la bière. Le Berliner Oktoberfest se tient annuellement de fin septembre à mi-octobre. Pendant cette manifestation, de grandes tentes sont installées au centre-ville. Les participants boivent à volonté de la bière allemande accompagnée de plats traditionnels.",
                "date" => "2022-09-23",
                "address" => "",
                "image" => "https://images.unsplash.com/photo-1545684361-65ed79b47ea1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Berlin",
                "categories" => [
                    "Evénements",
                ],
            ],
            [
                "title" => "Buste de Néfertiti",
                "content" => "Visite en groupe et explications artistiques et historiques sur le Buste de Néfertiti au Neues Museum. Par la célèbre Egyptologue Ankela Mergel. ",
                "date" => "2022-11-19",
                "address" => "Bodestraße 1-3, 10178 Berlin",
                "image" => "https://img.lemde.fr/2011/01/24/64/0/3336/1668/664/0/75/0/ill_1469666_9031_606233.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Berlin",
                "categories" => [
                    "Activités",
                    "Culture",
                ],
            ],
            [
                "title" => "KAOS Berlin",
                "content" => "Venez partager des espaces, des outils et des connaissances pour créer des symbioses insolites et grandir ensemble. Cet espace se situe dans un ancien hangar modernisé mais qui a conservé son aspect industriel, le tout dans le respect des normes environnementales.",
                "date" => "",
                "address" => "Wilhelminenhofstraße 92, 12459 Berlin",
                "image" => "https://kaosberlin.de/wp-content/uploads/slider/cache/5125dcabbc39dcafa65310bef15bbcc7/Copyright_by_David_Dollmann_Copyright_by_David_Dollmann_2017.12.06-Kaos-Hallenbilder-Mehrfachbelichtung2519.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Berlin",
                "categories" => [
                    "Co-Working",
                ],
            ],
            [
                "title" => "Konnopke’s Imbiss",
                "content" => "Premier snack à proposer la célèbre et très berlinoise Currywurst à Berlin-Est, dès 1960! Situé sous les rails de la station de métro aérien “Eberswalder Straße”, Konnopke’s Imbiss vaut le détour ! ",
                "date" => "",
                "address" => "Schönhauser Allee 44b, 10435 Berlin",
                "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Berlin_Konnopke%E2%80%99s_Imbi%C3%9F.jpg/1280px-Berlin_Konnopke%E2%80%99s_Imbi%C3%9F.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Berlin",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Club der Visionaere",
                "content" => "Bar en bord de rivière avec terrasse en bois, musique électronique et fêtes le dimanche après-midi.",
                "date" => "",
                "address" => "Am Flutgraben, 12435 Berlin",
                "image" => "https://www.visitberlin.de/system/files/styles/visitberlin_bleed_header_visitberlin_desktop_1x/private/image/Kanufahrt_Am_Flutgraben_Foto_Philip_Koschel%20%284%29_web.jpg.webp?h=1c9b88c9&itok=8f5Mu-DM",
                "status" => "",
                "created_at" => "",
                "city" => "Berlin",
                "categories" => [
                    "Sorties",
                ],
            ],
            [
                "title" => "Mzansi - Le restaurant typique Africain",
                "content" => "Dans un quartier du township Langa ce petit restaurant nous invite a vivre une expérience unique: Le buffet a volonté délicieux. La musique live. Un artiste du quartier et ses peintures. Le récit de Mama. Le tout dans une ambiance plus que conviviale. Très agréable soirée en perspective avec des personnes venus des quatres coins du monde.",
                "date" => "",
                "address" => "45 Harlem Avenue Langa, Le Cap 7455 Afrique du Sud",
                "image" => "https://images.unsplash.com/photo-1589442305595-62647c1514f9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=725&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Le Cap",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Theatre on the Bay",
                "content" => "Magnifiquement situé sur la plage de Camps Bay, le bâtiment néoclassique accueille des spectacles intimistes souvent humoristiques de stand up, mais aussi des pièces d'auteurs et même du théâtre de bistrot.",
                "date" => "",
                "address" => "Link Street, Camps Bay, Cape Town, 8005, Afrique du Sud",
                "image" => "https://images.unsplash.com/photo-1503095396549-807759245b35?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Le Cap",
                "categories" => [
                    "Culture",
                ],
            ],
            [
                "title" => "Pique-nique au Jardin botanique national Kirstenbosch",
                "content" => "Référencé comme l’un des plus beaux jardins botaniques au monde, Kirstenbosch est une source de promenade éternelle. Les découvertes s’y multiplient à l’abri du vent, et les pique-niques sur gazon y sont autorisés. ",
                "date" => "2022-09-10",
                "address" => "Rhodes Dr, Newlands, Cape Town, 7735, Afrique du Sud",
                "image" => "https://images.unsplash.com/photo-1589473292043-49e8ecf57389?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Le Cap",
                "categories" => [
                    "Sorties",
                ],
            ],
            [
                "title" => "Escalade en famille",
                "content" => "Je vous donne rendez-vous à 10h au CityRock pour une journée en famille sur un thème un peu plus sportif que d'habitude :) On part sur de l'escalade mais ceux qui le souhaitent peuvent aussi profiter des cours de Yoga. Je vous propose de nous réunir au restaurant \"The Ute & Yeti\" pour un dejeuner convivial entre deux activités :) J'espère vous voir nombreux :) Enjoy !",
                "date" => "2022-10-08",
                "address" => "Milner St, Paarden Eiland, Cape Town, 7405, Afrique du Sud",
                "image" => "https://images.unsplash.com/photo-1509398484917-2a5b6439feef?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1167&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Le Cap",
                "categories" => [
                    "Activités",
                ],
            ],
            [
                "title" => "Festival Peace, Love & Beats",
                "content" => "A partir de 14h au Woodstock Brewery Taproom Observatory. Un mini festival multi-genres d'une journée pour la bonne cause ! Rejoignez-nous pour célébrer et promouvoir l'égalité des sexes à travers une journée remplie de bonne musique, de bonne nourriture, de bonnes personnes et de bonnes vibrations ! Tous les bénéfices de l'événement iront à des associations caritatives contre la violence basée sur le genre, par l'intermédiaire de l'ONG : Women Making Change International.",
                "date" => "2022-09-17",
                "address" => "252 Albert Road, Woodstock 7925 Afrique du Sud",
                "image" => "https://www.webtickets.co.za/admin/images/peacelovenbeats/banner_PL&B_Webtickets_Cover_20220808_172737.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Le Cap",
                "categories" => [
                    "Evénements",
                ],
            ],
            [
                "title" => "Workshop17 Watershed",
                "content" => "Le Cap est la plaque tournante cosmopolite de l'Afrique et l'emblématique Waterfront est l'endroit où le monde se rencontre. Soyez au cœur de tout à Workshop17 Watershed - au-dessus d'un marché artisanal organisé dans un entrepôt magnifiquement converti avec vue sur le port jusqu'à Table Mountain.",
                "date" => "",
                "address" => "Watershed, 17 Dock Rd, Victoria & Alfred Waterfront, Cape Town, 8002, Afrique du Sud",
                "image" => "https://images.unsplash.com/photo-1582005450386-52b25f82d9bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Le Cap",
                "categories" => [
                    "Co-Working",
                ],
            ],
            [
                "title" => "La meilleur boulangerie de Londres",
                "content" => "Surement de loin la boulangerie française la plus réputée de Londres, cette boulangerie familiale venant du sud de la France a toujours su éveiller nos papilles avec leurs incroyables pains et pâtisseries depuis 1948. Leurs produits sont préparés devant les clients pour que tu puisses observer leur travail. Le but est que tu ressentes à travers le goût et le visuel l’amour que porte les boulangers à créer leurs pains. ",
                "date" => "",
                "address" => "279 Grays Inn Rd au Nord de Londres",
                "image" => "https://images.unsplash.com/photo-1586443327882-6a63805ca1fb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Londres",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "London Tea Party",
                "content" => "La fameuse Tea party à l'Anglaise, comme on se l'imagine dans les films et les livres. Ils accentuent très certainement le style British pour coller au stéréotype, mais c'est ça qu'on aime aussi dans les Tea party, non? Leurs gâteaux ne sont pas top (c'est Anglais, quoi...) mais leurs thés sont excellents!",
                "date" => "2022-09-09",
                "address" => "The Savoy, The Strand, London WC2R 0EU",
                "image" => "https://images.unsplash.com/photo-1544787219-7f47ccb76574?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=721&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Londres",
                "categories" => [
                    "Sorties",
                    "Gastronomie",
                    "Activités",
                ],
            ],
            [
                "title" => "L’exposition Harry Potter aux studios Warner Bros.",
                "content" => "Si vous êtes fan des aventures de Harry Potter, rendez-vous dans les studios de la Warner Bros. Vous arpenterez les décors et découvrirez tous les secrets des tournages. Passionnant !",
                "date" => "",
                "address" => "Warner Bros. Studio Tour London, Studio Tour Dr, Leavesden, Watford WD25 7LR",
                "image" => "https://images.unsplash.com/photo-1575887339850-1acc9d8daf3e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fGhhcnJ5JTIwcG90dGVyfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60",
                "status" => "",
                "created_at" => "",
                "city" => "Londres",
                "categories" => [
                    "Culture",
                    "Sorties",
                ],
            ],
            [
                "title" => "Yoga ensemble",
                "content" => "Viens pratiquer le Hatha yoga au Hyde Park (devant le lac), ça se passe les jeudis 19h à 20h15. ",
                "date" => "",
                "address" => "Hyde Park",
                "image" => "https://images.unsplash.com/photo-1588286840104-8957b019727f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Londres",
                "categories" => [
                    "Activités",
                ],
            ],
            [
                "title" => "Halloween at The French House",
                "content" => "A l'occasion d'Halloween, j'ai décidé de réunir une assemblée de sorcières, de démons et de monstres le 31 octobre à 20 h 30.
                Il y aura plein de bonnes choses à déguster : mousseline d'escargot sur lit de pattes d'araignées, omelettes d'oeufs de fourmis, gâteaux de pissenlits aux cloportes, le tout arrosé d'un jus de crapauds millésimé. Connaissant ton amour de la gastronomie, j'ai pensé que cela pouvait t\'intéresser. Ca te fera une bonne occasion de sortir de ton cercueil !",
                "date" => "2022-10-31",
                "address" => "49 Dean Street, Londres W1D 5BG",
                "image" => "https://images.unsplash.com/photo-1572006234180-72c98e5f7f5e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Londres",
                "categories" => [
                    "Sorties",
                    "Activités",
                    "Evénements",
                ],
            ],
            [
                "title" => "Jeux d’évasion: 'Sherlock : The Game is Now'",
                "content" => "La sortie de « Sherlock : The Game is Now » fut un événement dans le monde des jeux d’évasion grandeur nature. Produit dérivé officiel de la série « Sherlock », cet escape game londonien est devenu, en décembre 2018, le premier à exploiter une licence de manière pérenne.",
                "date" => "",
                "address" => "Shepherd's Bush Green, London W12 8PP",
                "image" => "https://images.unsplash.com/photo-1621502822601-b84996c82b79?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=736&q=80 ",
                "status" => "",
                "created_at" => "",
                "city" => "Londres",
                "categories" => [
                    "Sorties",
                    "Activités"
                ],
            ],
            [
                "title" => "Campus London",
                "content" => "Vous avez toujours rêvé de travailler chez Google ? Eh bien maintenant vous pouvez. Google Campus n'a peut-être pas de toboggan, mais il propose des espaces de coworking conçus par Jump Studios, équipés d'un comptoir d'accueil recouvert de Lego et d'un 'mur d'inspiration'. Des conférenciers experts, des événements de mise en réseau et le mentorat du personnel de Google aident les entreprises naissantes à se développer. Idéal pour: les startups technologiques avec un faible pour Lego",
                "date" => "",
                "address" => "4-5 Bonhill Street, London EC2A 4BX",
                "image" => "https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Londres",
                "categories" => [
                    "Co-Working",
                ],
            ],
            [
                "title" => "Pitchoun! Boulangerie - Patisserie",
                "content" => "Pitchoun! est une boulangerie, une pâtisserie et un restaurant français raffinés, situés dans le quartier du centre-ville de Los Angeles et de Beverly Grove, une entreprise familiale et artisanale. Sont proposés des pains frais artisanaux et des pâtisseries et gâteaux maison, mais aussi un éventail de salades et sandwichs sains, de plats chauds et de soupes, et bien plus encore. Tout est fait maison tous les jours, à partir de levain maison et d'ingrédients biologiques ou locaux.",
                "date" => "",
                "address" => "545 S Olive St, Los Angeles, CA 90013-1006",
                "image" => "https://media-cdn.tripadvisor.com/media/photo-s/14/42/a0/ae/la-terrasse.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Le petit Paris",
                "content" => "Le Petit Paris est la vision des restaurateurs cannois David et Fanny Rolland. Le restaurant de 400 places offre une expérience culinaire de brasserie par excellence au cœur historique du centre-ville de Los Angeles. Sous la direction des chefs Baptiste Grellier et Jérémie Cazes, le Petit Paris propose un brunch, un déjeuner et un dîner et possède un magasin de détail, 'La Boutique', qui présente des produits de spécialité français exclusifs et des œuvres d'art de certains des artistes les plus remarquables de France.",
                "date" => "",
                "address" => "418 S Spring St, Los Angeles, CA 90013-2002",
                "image" => "https://www.discoverlosangeles.com/sites/default/files/business/le-petit-paris/h_2000-crm-la-46171922_1929656237109965_2599323978589798400_o0-74c7b8a45056a36_74c7b9c1-5056-a36f-235e917b6b88abbf.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Observatoire Griffith",
                "content" => "Situé sur la face sud du Mont Hollywood dans le Griffith Park à 300 mètres d'altitude, c'est un endroit apprécié des touristes et des habitants de la ville pour ses expositions scientifiques, son planétarium et le panorama qu'il donne sur toute la région allant du centre-ville de Los Angeles jusqu'à la baie de Santa Monica et l'océan Pacifique.",
                "date" => "",
                "address" => "2800 East Observatory Road, Los Angeles, CA 90027",
                "image" => "https://images.unsplash.com/photo-1566864717473-2f0daf8979e5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2532&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Culture"
                ],
            ],
            [
                "title" => "Match de Baseball Los Angeles Dodgers vs Miami Marlins",
                "content" => "Venez assister au match opposant les LA Dodgers aux Miami Marlins dans le mythique stade Dodgers stadium ",
                "date" => "2022-08-25",
                "address" => "1000 Vin Scully Ave, Los Angeles, CA 90012",
                "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Dodger_Stadium.jpg/1200px-Dodger_Stadium.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Sorties"
                ],
            ],
            [
                "title" => "Union Cowork",
                "content" => "Union Cowork offre un espace unique et confortable pour développer des relations. Que ce soit entre collègues ou entre nouvelles connaissances, nous concevons nos espaces pour favoriser une conversation détendue et progressive.",
                "date" => "",
                "address" => "1325 Palmetto St, Los Angeles, CA 90013",
                "image" => "https://unioncowork.com/wp-content/uploads/2019/12/Copy-of-Union_1_HiRes-4-min.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Co-Working"
                ],
            ],
            [
                "title" => "Cours de surf",
                "content" => "Profitez de leçons de surf privée avec un moniteur professionnel sur la célèbre plage de Venice. Apprenez à surfer sur les vagues dans cette classe privée, idéale pour les débutants ou les surfeurs de niveau intermédiaire supérieur.",
                "date" => "",
                "address" => "Marina Del Rey, Los Angeles, CA 90292",
                "image" => "https://images.unsplash.com/photo-1502680390469-be75c86b636f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Activités",
                ],
            ],
            [
                "title" => "Visite de Hollywood et des maisons des stars en bus",
                "content" => "Découvrez les sites touristiques d'Hollywood au cours de cette visite en minibus, qui vous permet de profiter d'une vue imprenable au fur et à mesure. Voyager avec un guide à bord, vous passerez par des attractions telles que le Dolby Theatre, Hollywood Sign, Rodeo Drive et les studios de cinéma. De plus, jetez un coup d'œil à certaines des demeures où des stars du passé et du présent ont vécu.",
                "date" => "",
                "address" => "6720 Hollywood Blvd, Los Angeles, CA 90028",
                "image" => "https://images.unsplash.com/photo-1581390114939-946f9a890a7f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2531&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Activités",
                ],
            ],
            [
                "title" => "Festival de Coachella",
                "content" => "Le Coachella Valley Music and Arts Festival, plus communément appelé « Festival de Coachella » ou « Coachella », est un événement initié par le groupe de musique Pearl Jam et organisé, depuis 1999, par Paul Tollett et sa société Goldenvoice. Le festival se déroule chaque année pendant six jours, sur deux fois trois jours, généralement les troisième et quatrième week-ends d'avril, à Indio, près de Los Angeles, en Californie.",
                "date" => "2023-04-14",
                "address" => "Indio, California",
                "image" => "https://www.losangelesoffroad.com/wp-content/uploads/2019/02/Coachella-festival.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Los Angeles",
                "categories" => [
                    "Evénements",
                    "Sorties",
                ],
            ],
            [
                "title" => "Giolitti",
                "content" => "",
                "date" => "",
                "address" => "Via degli Uffici del Vicario, 40, 00186 Roma",
                "image" => "https://images.unsplash.com/photo-1567206563064-6f60f40a2b57?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80",
                "status" => "",
                "created_at" => "",
                "city" => "Rome",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Forum Romain",
                "content" => "Situé entre le Colisée et le Circus Maximus, le Forum est le site archéologique le plus important de Rome. Bâti sur le Mont Palatin, le Forum est la place principale de la Rome antique.",
                "date" => "",
                "address" => "Via della Salara Vecchia, 5/6, 00186 Roma",
                "image" => "https://upload.wikimedia.org/wikipedia/commons/6/6a/Foro_Romano_Musei_Capitolini_Roma.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Rome",
                "categories" => [
                    "Culture",
                    "Sorties",
                ],
            ],
            [
                "title" => "Natale di Roma",
                "content" => "Le 21 avril, Rome fête son anniversaire (2776 ans !) en grandes pompes ! L'événement donne lieu a un impressionnant défilé auquel prennent part environ 2 000 personnes arborant de superbes déguisements historiques, centurions en armure et peau de bête, vestales et enfants romains. Plusieurs reconstitutions de batailles et autres rituels sont joués pour l'occasion et la journée se termine par un spectacle de sons et lumières sur les forums impériaux et un feu d'artifice sur le Colisée.",
                "date" => "2022-04-21",
                "address" => "",
                "image" => "https://images.rove.me/w_740,q_85/asqpclxdz0wrzv3zcykm/rome-natale-di-roma-or-romes-birthday.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Rome",
                "categories" => [
                    "Evénements",
                ],
            ],
            [
                "title" => "Trattoria Vecchia Roma",
                "content" => "Depuis 1916 cette trattoria et pizzeria à l'ambiance intimiste, aux murs bordeaux décorés de fresques et d'arches en briques apparentes sert des plats typiques de la cuisine italienne et romaine",
                "date" => "",
                "address" => "Via Ferruccio, 12/b/c, 00185 Roma",
                "image" => "https://xdaysiny.com/wp-content/uploads/2019/09/Trattoria-Vecchia-Roma-Rome-best-Restaurant.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Rome",
                "categories" => [
                    "Gastronomie",
                ],
            ],
            [
                "title" => "Visite de la Chapelle Sixtine entre néo expats",
                "content" => "Le plafond impressionnant de la Chapelle Sixtine (XVème siècle) a été peint par Michel-Ange au XVIème siècle et représente l’histoire de la création et du déluge. Les murs sont tout aussi remarquables avec les peintures sur la vie de Jésus faites par Ghirlandaio, Botticelli, Perugino et Pinturicchio.",
                "date" => "2022-10-05",
                "address" => " 00120 Vatican City",
                "image" => "https://upload.wikimedia.org/wikipedia/commons/7/73/God2-Sistine_Chapel.png",
                "status" => "",
                "created_at" => "",
                "city" => "Rome",
                "categories" => [
                    "Activités",
                ],
            ],
            [
                "title" => "Millepiani Coworking",
                "content" => "Millepiani est le gagnant du prix Rome's Best Cowork, décerné par Coworker.com ! C'est un open space de 400 mètres carrés, qui comprend un espace événementiel (100 places et écran de projection), une salle de réunion (15 places avec écran plasma), et plusieurs bureaux pour startups et coworkers.",
                "date" => "",
                "address" => "Via Nicolo Odero, 13, 00154 Roma",
                "image" => "https://coworkingmap.org/wp-content/uploads/2016/12/a-millepiani1L-705x467.jpg",
                "status" => "",
                "created_at" => "",
                "city" => "Rome",
                "categories" => [
                    "Co-Working",
                ],
            ],
            [
                "title" => "Match de l'AS Roma au Stadio Olimpico",
                "content" => "Venez assister au premier match de la saison, AS Roma - Cremonese au mythique Stadio Olimpico avec les premiers pas de la nouvelle recrue star Paolo Dybala",
                "date" => "2022-08-22",
                "address" => "Viale dei Gladiatori, 00135 Roma",
                "image" => "https://assets.goal.com/v3/assets/bltcc7a7ffd2fbf71f5/blt9d46c72d1c8d443b/60db4959ed93bb0fb198477e/a9d2077244811ea3de761399f5e55e1f920fdafc.png?quality=80&width=1000&format=pjpg&auto=webp",
                "status" => "",
                "created_at" => "",
                "city" => "Rome",
                "categories" => [
                    "Sorties",
                    "Evénements",
                ],
            ]
        ];

        //=============================POST
        $postObjArray = [];
        foreach ($posts as $currentPost) 
        {
           $postObj = new Post();

           $postObj->setTitle($currentPost["title"]);
           $postObj->setContent($currentPost["content"]);
           $postObj->setDate(new DateTimeImmutable($currentPost["date"]));
           $postObj->setAddress($currentPost["address"]);
           $postObj->setImage($currentPost["image"]);
           $postObj->setStatus(1);
           $postObj->setCreatedAt(new DateTimeImmutable);
           
           foreach ($currentPost["categories"] as $currentCategoryName) {

                $currentCategoryObj = $categoryObjArray[md5($currentCategoryName)];
                $postObj->addCategory($currentCategoryObj);
           }

           $citiesObjArray = $this->getReference('city-list');
           $cityObj = $citiesObjArray[md5($currentPost["city"])];
           $postObj->setCity($cityObj);

        }

    } 
}

