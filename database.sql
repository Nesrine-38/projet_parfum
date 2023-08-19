-- Active: 1685437722112@@127.0.0.1@3306@projet_parfum
-- Active: 1685437722112@@127.0.0.1@3306@projet_parfum


DROP TABLE IF EXISTS options_orderItem;

DROP TABLE IF EXISTS orderItem;

DROP TABLE IF EXISTS options;

DROP TABLE IF EXISTS product;

DROP TABLE IF EXISTS orders;

DROP TABLE IF EXISTS shop;

CREATE TABLE
    orders (
        id INT PRIMARY KEY AUTO_INCREMENT,
        createdAt DATE NOT NULL,
        customerName VARCHAR(255) NOT NULL
    );

CREATE TABLE
    shop (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        address VARCHAR(255) NOT NULL
    );

CREATE TABLE
    product (
        id INT PRIMARY KEY AUTO_INCREMENT,
        label VARCHAR(255) NOT NULL,
        basePrice FLOAT NOT NULL,
        description varchar(255),
        picture varchar(255),
        id_shop INT,
        Foreign Key (id_shop) REFERENCES shop(id) ON DELETE CASCADE
    );

CREATE TABLE
    options (
        id INT PRIMARY KEY AUTO_INCREMENT,
        label VARCHAR(255) NOT NULL,
        price float NOT NULL,
        id_product INT,
        Foreign Key (id_product) REFERENCES product(id) ON DELETE CASCADE
    );

CREATE TABLE
    orderitem (
        id INT PRIMARY KEY AUTO_INCREMENT,
        quantity INT NOT NULL,
        itemPrice float NOT NULL,
        id_orders INT,
        id_product INT,
        Foreign Key (id_orders) REFERENCES orders(id) ON DELETE CASCADE,
        Foreign Key (id_product) REFERENCES product(id) ON DELETE CASCADE
    );

CREATE TABLE
    options_orderitem (
        id_options INT,
        id_orderitem INT,
        PRIMARY key (id_options, id_orderitem),
        Foreign Key (id_options) REFERENCES options(id) ON DELETE CASCADE,
        Foreign Key (id_orderitem) REFERENCES orderitem(id) ON DELETE CASCADE
    );

INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        1,
        'NNCM',
        '27 rue de la par
        fumerie perpette-les-bains'
    );
INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        2,
        'Marionnaud-Parfumerie',
        '3 Av. Alsace Lorraine, 38000 Grenoble'
    );

INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        3,
        'Sephora',
        '6 Pl. Victor Hugo, 38000 Grenoble'
    );
INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        4,
        'The Body Shop',
        'ZAC du Parc technologique, 38090 LA VERPILL'
    );

INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        5,
        'Passion Beauté',
        '13 Rue Saint-Jacques, 38000 Grenoble'
    );

INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        6,
        'Lovely D',
        '38 Cr Jean Jaurès, 38000 Grenoble'
    );
INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        7,
        'Occitane en Provence',
        '8 Rue de Bonne, 38000 Grenoble'
    );
INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        8,
        'Channel',
        '12 Pl. Grenette, 38000 Grenoble'
    );
INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        9,
        'CHANEL',
        '12 Pl. Grenette, 38000 Grenoble'
    );
INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        10,
        'Nocibé',
        '128 Grand Place C.C, 38100 Grenoble'
    );
INSERT INTO
    `shop` (`id`, `name`, `address`)
VALUES (
        11,
        'SAGA Cosmetics',
        '15 Grande Rue, 38000 Grenoble'
    );
    
    

INSERT INTO
    `product` (
        `id`,
        `label`,
        `basePrice`,
        `description`,
        `picture`,
        `id_shop`
    )
VALUES (
        1,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        1
    ), (
        2,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        2
    ),
    (
        3,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        3
    ),
        (
        4,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        4
    ),
    (
        5,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        5
    ),
        (
        6,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        6
    ),
    (
        7,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        7
    ),
    (
        8,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        8
    ),
    (
        9,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        9
    ),
    (
        10,
        'Libre',
        130.99,
        'LIBRE s\'ouvre de notes douces de vanille avec des pics frais de lavande. Ensuite s\'explose par de fleurs blanches.',
        'https://www.yslbeauty.fr/dw/image/v2/AAQP_PRD/on/demandware.static/-/Sites-ysl-master-catalog/default/dw1c419af7/square/Fragrance/For-Her/WW-50424YSL_Libre_Eau_de_Parfum/3614272648418_libre_eau_de_parfum_50ml_alt1.jpg?sw=375&sh=375&sm=cut&sfrm=jpg&q=85',
        10
    ),
    (
        11,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        1
    ),
    (
        12,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        2
    ),
        (
        13,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        3
    ),
    (
        14,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        4
    ),
        (
        15,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        5
    ),
     (
        16,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        6
    ),
    (
        17,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        7
    ),
    (
        18,
        'Lady million',
        80.5,
        'parfum pour femme boisé et floral, alliant des fleurs fraîches, mais charnelles, à un patchouli sensuel. Un parfum frais et addictif, séduisant et désarmant !',
        'https://i1.perfumesclub.com/grandewp/29210.webp',
        8
    ),
    (
        19,
        'J\'adore',
        99.52,
        'Les notes de tête sont Poire, Melon, Magnolia, Pêche, Mandarine et Bergamote; les notes de coeur sont Jasmin, Muguet, Tubéreuse, Freesia, Rose, Orchidée, Prune et Violette; les notes de fond sont Musc, Vanille, Mûre et Cèdre.',
        'https://www.sephora.fr/dw/image/v2/BCVW_PRD/on/demandware.static/-/Sites-masterCatalog_Sephora/default/dw4d39833b/images/hi-res/SKU/SKU_6/71393_swatch.jpg?sw=585&sh=585&sm=fit',
        1
    ),
        (
        20,
        'J\'adore',
        99.52,
        'Les notes de tête sont Poire, Melon, Magnolia, Pêche, Mandarine et Bergamote; les notes de coeur sont Jasmin, Muguet, Tubéreuse, Freesia, Rose, Orchidée, Prune et Violette; les notes de fond sont Musc, Vanille, Mûre et Cèdre.',
        'https://www.sephora.fr/dw/image/v2/BCVW_PRD/on/demandware.static/-/Sites-masterCatalog_Sephora/default/dw4d39833b/images/hi-res/SKU/SKU_6/71393_swatch.jpg?sw=585&sh=585&sm=fit',
        9
    ),
      (
        21,
        'J\'adore',
        99.52,
        'Les notes de tête sont Poire, Melon, Magnolia, Pêche, Mandarine et Bergamote; les notes de coeur sont Jasmin, Muguet, Tubéreuse, Freesia, Rose, Orchidée, Prune et Violette; les notes de fond sont Musc, Vanille, Mûre et Cèdre.',
        'https://www.sephora.fr/dw/image/v2/BCVW_PRD/on/demandware.static/-/Sites-masterCatalog_Sephora/default/dw4d39833b/images/hi-res/SKU/SKU_6/71393_swatch.jpg?sw=585&sh=585&sm=fit',
        10
    ),
    (
        22,
    'CHANEL N°5',
    91.30,
    'Un fleuri abstrait vibrant, qui fait de la modernité son étendard et de la fraîcheur son leitmotiv. N°5 L’EAU pour faire l’éloge de la simplicité. N°5 L’EAU comme une évidence, jusque dans son packaging minimaliste',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/1/8/1841458305-chanel-n-5-vaporisateur-35-ml-visuel_1.webp'
    ,2),
    (
        23,
    'CHANEL N°5',
    91.30,
    'Un fleuri abstrait vibrant, qui fait de la modernité son étendard et de la fraîcheur son leitmotiv. N°5 L’EAU pour faire l’éloge de la simplicité. N°5 L’EAU comme une évidence, jusque dans son packaging minimaliste',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/1/8/1841458305-chanel-n-5-vaporisateur-35-ml-visuel_1.webp'
    ,8),
    (
        24,
    'CHANEL N°5',
    91.30,
    'Un fleuri abstrait vibrant, qui fait de la modernité son étendard et de la fraîcheur son leitmotiv. N°5 L’EAU pour faire l’éloge de la simplicité. N°5 L’EAU comme une évidence, jusque dans son packaging minimaliste',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/1/8/1841458305-chanel-n-5-vaporisateur-35-ml-visuel_1.webp'
    ,7),
    (
        25,
    'La Nuit Trésor',147.90,
    'La Nuit Trésor est née d’une fascinante énigme : deux étoiles irrémédiablement aimantées et attirées l’une vers l’autre entrant en collision pour former, au fil du temps, un diamant noir.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/5/3/53313c400n-lancome-la-nuit-tresor-vaporisateur-100ml-visuel_1.jpg',
    1),
    (
        26,
    'La Nuit Trésor',147.90,
    'La Nuit Trésor est née d’une fascinante énigme : deux étoiles irrémédiablement aimantées et attirées l’une vers l’autre entrant en collision pour former, au fil du temps, un diamant noir.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/5/3/53313c400n-lancome-la-nuit-tresor-vaporisateur-100ml-visuel_1.jpg',
    3),
    (
        27,
    'La Nuit Trésor',147.90,
    'La Nuit Trésor est née d’une fascinante énigme : deux étoiles irrémédiablement aimantées et attirées l’une vers l’autre entrant en collision pour former, au fil du temps, un diamant noir.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/5/3/53313c400n-lancome-la-nuit-tresor-vaporisateur-100ml-visuel_1.jpg',
    5),
        (
        28,
    'La Nuit Trésor',147.90,
    'La Nuit Trésor est née d’une fascinante énigme : deux étoiles irrémédiablement aimantées et attirées l’une vers l’autre entrant en collision pour former, au fil du temps, un diamant noir.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/5/3/53313c400n-lancome-la-nuit-tresor-vaporisateur-100ml-visuel_1.jpg',
    7),
        (
            29,
    'BLACK OPIUM', 197.50,
    'Le premier café floral par Yves Saint-Laurent. Un jus coup de poing mais aussi coup de cœur, travaillé en clair-obscur : vibrant, sensuel et terriblement addictif. l\'énergie du café noir électrise une brassée de fleurs blanches à la féminité affirmée',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/8/1/8141346e27-yves-saint-laurent-black-opium-eau-de-parfum-vaporisateur-150ml-visuel_1.jpg',
    2), 
    (
            30,
    'BLACK OPIUM', 197.50,
    'Le premier café floral par Yves Saint-Laurent. Un jus coup de poing mais aussi coup de cœur, travaillé en clair-obscur : vibrant, sensuel et terriblement addictif. l\'énergie du café noir électrise une brassée de fleurs blanches à la féminité affirmée',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/8/1/8141346e27-yves-saint-laurent-black-opium-eau-de-parfum-vaporisateur-150ml-visuel_1.jpg',
    4),
     (
            31,
    'BLACK OPIUM', 197.50,
    'Le premier café floral par Yves Saint-Laurent. Un jus coup de poing mais aussi coup de cœur, travaillé en clair-obscur : vibrant, sensuel et terriblement addictif. l\'énergie du café noir électrise une brassée de fleurs blanches à la féminité affirmée',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/8/1/8141346e27-yves-saint-laurent-black-opium-eau-de-parfum-vaporisateur-150ml-visuel_1.jpg',
    6),
     (
            32,
    'BLACK OPIUM', 197.50,
    'Le premier café floral par Yves Saint-Laurent. Un jus coup de poing mais aussi coup de cœur, travaillé en clair-obscur : vibrant, sensuel et terriblement addictif. l\'énergie du café noir électrise une brassée de fleurs blanches à la féminité affirmée',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/8/1/8141346e27-yves-saint-laurent-black-opium-eau-de-parfum-vaporisateur-150ml-visuel_1.jpg',
    10),
        (
            33,
    'My Way',72.50,
    'My Way, l\'eau de parfum rechargeable pour femme de Giorgio Armani, est une véritable invitation à s\'ouvrir à de nouvelles rencontres, vivre des expériences uniques et élargir ses horizons.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/0/3/0301323304-armani-my-way-vaporisateur-30ml-visuel_1.webp',

     4),
     (
            34,
    'My Way',72.50,
    'My Way, l\'eau de parfum rechargeable pour femme de Giorgio Armani, est une véritable invitation à s\'ouvrir à de nouvelles rencontres, vivre des expériences uniques et élargir ses horizons.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/0/3/0301323304-armani-my-way-vaporisateur-30ml-visuel_1.webp',

     4),
          (
            35,
    'My Way',72.50,
    'My Way, l\'eau de parfum rechargeable pour femme de Giorgio Armani, est une véritable invitation à s\'ouvrir à de nouvelles rencontres, vivre des expériences uniques et élargir ses horizons.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/0/3/0301323304-armani-my-way-vaporisateur-30ml-visuel_1.webp',

     7),
               (
            36,
    'My Way',72.50,
    'My Way, l\'eau de parfum rechargeable pour femme de Giorgio Armani, est une véritable invitation à s\'ouvrir à de nouvelles rencontres, vivre des expériences uniques et élargir ses horizons.',
    'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/0/3/0301323304-armani-my-way-vaporisateur-30ml-visuel_1.webp',

     9),
     (
        37,
        'Yes I Am',39.90,
        'Yes I Am c\'est le parfum des femmes audacieuses et indépendantes, prêtes à s\'affirmer. Avec sa forme qui s\'inspire du rouge à lèvres, il deviendra votre nouvel indispensable.',
        'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/1/2/1291353025-cacharel-yes-i-am-vaporisateur-30ml-visuel_1.webp',
        2),
             (
        38,
        'Yes I Am',39.90,
        'Yes I Am c\'est le parfum des femmes audacieuses et indépendantes, prêtes à s\'affirmer. Avec sa forme qui s\'inspire du rouge à lèvres, il deviendra votre nouvel indispensable.',
        'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/1/2/1291353025-cacharel-yes-i-am-vaporisateur-30ml-visuel_1.webp',
        5
     ),
          (
        39,
        'Yes I Am',39.90,
        'Yes I Am c\'est le parfum des femmes audacieuses et indépendantes, prêtes à s\'affirmer. Avec sa forme qui s\'inspire du rouge à lèvres, il deviendra votre nouvel indispensable.',
        'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/1/2/1291353025-cacharel-yes-i-am-vaporisateur-30ml-visuel_1.webp',
        9
     ),
     (40,
     'MISS DIOR', 105.20,
     'La nouvelle Eau de toilette Miss Dior est un tourbillon floral enivrant et rafraîchissant. Une valse effrénée autour de la Rose de Grasse et d\'un voile de Muguet léger comme un jupon de tulle.',
     'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/2/9/2931456504-dior-miss-dior-vaporisateur-50ml-visuel_1.webp',
     8),
          (41,
     'MISS DIOR', 105.20,
     'La nouvelle Eau de toilette Miss Dior est un tourbillon floral enivrant et rafraîchissant. Une valse effrénée autour de la Rose de Grasse et d\'un voile de Muguet léger comme un jupon de tulle.',
     'https://www.beautysuccess.fr/media/catalog/product/cache/913b9a533e99637993328686e83b3935/2/9/2931456504-dior-miss-dior-vaporisateur-50ml-visuel_1.webp',
     10);

INSERT INTO
    `options` (
        `id`,
        `label`,
        `price`,
        `id_product`
    )
VALUES 
(1,'Grave un nom sur le packaging',30.23,1), 
(2,'Grave un nom sur le packaging',30.23,2), 
( 3,'Graver un nom sur le packaging',30.23,3), 
(4,'Graver un nom sur le packaging',30.23,4), 
    (
        5,
        'Graver un nom sur le packaging',
        30.23,
        5
    ), 
    (
        6,
        'Graver un nom sur le packaging',
        30.23,
        6
    ), 
        (
        7,
        'Graver un nom sur le packaging',
        30.23,
        7
    ), 
            (
        8,
        'Graver un nom sur le packaging',
        30.23,
        8
    ), 
        (
        9,
        'Graver un nom sur le packaging',
        30.23,
        9
    ), 
    (
        10,
        'Graver un nom sur le packaging',
        30.23,
        10
    ),
        (
        11,
        'Graver un nom sur le packaging',
        30.23,
        11
    ), 
            (
        12,
        'Graver un nom sur le packaging',
        30.23,
        12
    ), 
            (
        13,
        'Graver un nom sur le packaging',
        30.23,
        13
    ), 
      (
        14,
        'Graver un nom sur le packaging',
        30.23,
        14
    ), 
    (
        15,
        'Graver un nom sur le packaging',
        30.23,
        15
    ), 
    (
        16,
        'Graver un nom sur le packaging',
        30.23,
        16
    ), 
    (
        17,
        'Graver un nom sur le packaging',
        30.23,
        17
    ), 
    (
        18,
        'Graver un nom sur le packaging',
        30.23,
        18
    ), 
    (
        19,
        'Graver un nom sur le packaging',
        30.23,
        22
    ), 
    (
        20,
        'Graver un nom sur le packaging',
        30.23,
        23
    ), 
    (
        21,
        'Graver un nom sur le packaging',
        30.23,
        24
    ), 
        (
        22,
        'Graver un nom sur le packaging',
        30.23,
        25
    ), 
        (
        23,
        'Graver un nom sur le packaging',
        30.23,
        26
    ), 
        (
        24,
        'Graver un nom sur le packaging',
        30.23,
        27
    ), 
    (
        25,
        'Graver un nom sur le packaging',
        30.23,
        28
    ), 
        (
        26,
        'Graver un nom sur le packaging',
        30.23,
        29
    ),
        (
        27,
        'Graver un nom sur le packaging',
        30.23,
        30
    ),
        (
        28,
        'Graver un nom sur le packaging',
        30.23,
        31
    ),
        (
        29,
        'Graver un nom sur le packaging',
        30.23,
        32
    ),
        (
        30,
        'Graver un nom sur le packaging',
        30.23,
        33
    ),
        (
        31,
        'Graver un nom sur le packaging',
        30.23,
        34
    ),
        (
        32,
        'Graver un nom sur le packaging',
        30.23,
        35
    ),

    (33, 'Changer le flacon', 15.2, 19), 
    (34, 'Changer le flacon', 15.2, 20), 
    (35, 'Changer le flacon', 15.2, 21),
    (36, 'Changer le flacon', 15.2, 37), 
    (37, 'Changer le flacon', 15.2, 38), 
    (38, 'Changer le flacon', 15.2, 39),
    
    (39, 'choisir la quantité', 20,1),
    (40, 'choisir la quantité', 20,2),
    (41, 'choisir la quantité', 20,3),
    (42, 'choisir la quantité', 20,4),
    (43, 'choisir la quantité', 20,5),
    (44, 'choisir la quantité', 20,6),
    (45, 'choisir la quantité', 20,7),
    (46, 'choisir la quantité', 20,8),
    (47, 'choisir la quantité', 20,9),
    (48, 'choisir la quantité', 20,10),
    (49, 'choisir la quantité', 20,11),
    (50, 'choisir la quantité', 20,12),
    (51, 'choisir la quantité', 20,13),
    (52, 'choisir la quantité', 20,14),
    (53, 'choisir la quantité', 20,15),
    (54, 'choisir la quantité', 20,16),
    (55, 'choisir la quantité', 20,17),
    (56, 'choisir la quantité', 20,18),
    (57, 'choisir la quantité', 20,19),
    (58, 'choisir la quantité', 20,20),
    (59, 'choisir la quantité', 20,21),
    (60, 'choisir la quantité', 20,22),
    (61, 'choisir la quantité', 20,23),
    (62, 'choisir la quantité', 20,24),
    (63, 'choisir la quantité', 20,25),
    (64, 'choisir la quantité', 20,26),
    (65, 'choisir la quantité', 20,27),
    (66, 'choisir la quantité', 20,28),
    (67, 'choisir la quantité', 20,29),
    (68, 'choisir la quantité', 20,30),
    (69, 'choisir la quantité', 20,31),
    (70, 'choisir la quantité', 20,32),
    (71, 'choisir la quantité', 20,33),
    (72, 'choisir la quantité', 20,34),
    (73, 'choisir la quantité', 20,35),
    (74, 'choisir la quantité', 20,36),
    (75, 'choisir la quantité', 20,37),
    (76, 'choisir la quantité', 20,38),
    (77, 'choisir la quantité', 20,39),
    (78, 'choisir la quantité', 20,40),
    (79, 'choisir la quantité', 20,41);

INSERT INTO
    `orders` (
        `id`,
        `createdAt`,
        `customerName`
    )
VALUES (
        1,
        '2023-07-06 11:10:32',
        'Nesrine Ishak'
    ), (
        2,
        '2023-07-06 12:10:32',
        'Nisreen khattem'
    ),(
        3,
        '2023-07-08 09:10:32',
        'Maher Rouis'
    ),(
        4,
        '2023-07-09 14:10:32',
        'Christophe Thiou'
    ),(
        5,
        '2023-07-09 18:10:32',
        'Pierre Termini '
    ),(
        6,
        '2023-07-10 09:10:32',
        'Xiaoyu Ma'
    ),(
        7,
        '2023-07-10 09:40:32',
        'Joao Marco RIBEIRO LEITE'
    ),(
        8,
        '2023-07-09 21:40:32',
        'Eugénie FERBEYRE'
    ),
    (
        9,
        '2023-07-09 00:40:32',
        'Monia Ghribi'
    );
    

INSERT INTO
    `orderitem` (
        `id`,
        `quantity`,
        `itemPrice`,
        `id_product`,
        `id_orders`
    )
VALUES 
(1, 1, 83.50, 1, 1),
(2, 1, 65.30 , 11, 1),
(3, 3, 65.30, 12, 2),
(4, 4, 119.30, 19, 4),
(5, 3, 72.00 , 33, 3),
(6, 1, 127.50, 29, 5),
(7, 2, 73.00, 24, 6),
(8, 4, 71.50 , 26, 7),
(9, 4, 0, 39, 1),
(10, 5, 0,  40, 1);

SELECT *
FROM product
    LEFT JOIN shop ON product.id_shop = shop.id
WHERE product.id_shop = 1;

SELECT *
FROM orders
    LEFT JOIN orderitem ON orderitem.id_orders = orders.id
WHERE
    orderitem.id_orders = 1;

INSERT INTO
    `options_orderitem` (
        `id_options`,
        `id_orderitem`
    )
VALUES 
(1,1),
(11,2),
(12,3),
(57,4),
(30,5),
(26,6),
(21,7),
(64,8),
(77,9),
(78,10);


SELECT *
FROM orderitem
    LEFT JOIN product ON product.id = orderitem.id_product
    LEFT JOIN options_orderitem ON options_orderitem.id_orderitem = orderitem.id
    LEFT JOIN options ON options.id = options_orderitem.id_options
WHERE orderitem.id_orders = 1;