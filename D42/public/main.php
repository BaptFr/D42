<?php
    /*pseudocode: 
    Si !==null -> get name  : 'there' ; ternaire. */
    $hello = isset($_GET['who']) ? htmlspecialchars($_GET['who']) : 'there';

    
    class Product {
        public function __construct(
            public string $title,
            public string $color,
            public int $price
        ) {}
    }

    $productCollection = [
        new Product('Perfecto cuir', 'noir', 20000),
        new Product('Kway nylon', 'bleu marine', 12000),
        new Product('Doudoune fourrure', 'taupe', 80000),
    ];

        
    /***pseudocode***
    1- affichage des produits pour l'utilisateur dans le html: 
    Boucle liste des products de $productCollection
    boucle //JS  for each (i=0; i<productCollection.length; i++)
    variable index liée au titre-lien: 
    $productCollection as $i => $p   htmlspecialchars($p->title)
    cloturer boucle avec <?php endforeach; ?>
        
    2 - récup product:
    product cliqué.
    Conditions, ternaire:
        Si $_GET['product']dans l'URL (isset) -> productId= href product = $i 
        sinon productId = null.
        
    *déclarer var $product null par défaut pour stocker id
        conditions !=null +  isset
        $product= $productCollection[$productId]
        
    3- correspondance des index et conditions: 
    $productId correspond à un index de $produitCollection
        if $productId = null {
            return code réponse erreur;
        }else if { $productId = $productCollection[i]}.
        }else{
                header("HTTP/1.1 404 Not Found");
                header("Location: error.html");
                exit();
        }

    4- Affichage des indos du produit: 
    Cond: if product !=null -> liste infos. 
    format réponses:  string, num, prix  /100 et en €
    htmlspecialchars / number_format
    cloturer avec <?php endif; ?>
    ***/ 

      
    //récup product
    $product=null;
    $productId = isset($_GET['product']) ? (int)$_GET['product'] : null; 

    if ($productId !== null && isset($productCollection[$productId])) {
        $product = $productCollection[$productId];
    } elseif ($productId !== null) {
        //redirection erreur
        header("Location: error.html");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello <?= $hello ?></title>
    </head>
    <body>
        <h1>Hello <?= $hello ?> !</h1>
        <ul>
            <li>
                <a href="?who=Anne">
                    <img src="https://www.planetegrandesecoles.com/wp-content/uploads/2023/08/anne.jpg.webp" alt="anne-picture" width="100">
                     Anne
                </a>
            </li>
            <li>
                <a href="?who=Eva">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/EVA_GREEN_CESAR_2020.jpg" alt="Eva-image" width="100">
                    Eva
                </a>
            </li>
        </ul>

        <h1>Produits</h1>
        <!--boucle pour liste de $productCollection-->
        <ul>
            <!-- récupérer index pour href -->
            <?php foreach ($productCollection as $i => $p): ?>
                <li>
                  <a href="?product=<?= $i ?>"> <?= htmlspecialchars($p->title) ?>  </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Si product !null alors afichage des infos $product-->
        <?php if ($product): ?>
            <h2>Détails du produit selectionne :</h2>
            <ul>
                <li>Nom: <?= htmlspecialchars($product->title) ?></li>
                <li> Couleur : <?= htmlspecialchars($product->color) ?></li>
                <li>Prix: <?= number_format($product->price / 100) ?> € </li>
            </ul>
        <?php endif; ?>
    </body>
</html>