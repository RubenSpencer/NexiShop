<?php
require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../views/layouts/header.php";
require_once __DIR__ . "/../config/database.php";
$pdo = Database::connect();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /NexiShop/index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: gestion-product.php");
    exit;
}

$id = $_GET['id'];
$sql = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$sql->execute([$id]);

$product = $sql->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: gestion-product.php");
    exit;
}


// var_dump($product);


if(isset($_POST['update_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    // Gerer l'ajout des images
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = __DIR__ . "/../uploads/";
        $destPath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpPath, $destPath)) {
            // Met les produits dans la base de données
            $update_sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$imageName', stock='$stock' WHERE id=$id";
            // ça permet d'éviter que le code constate une erreur lorsque rien ne change ; MySQL considère alors les anciennes données comme identiques aux nouvelles données
            $result = $pdo->exec($update_sql);
            // $result = pdo->exec($update_sql);
            
            if ($result !== false) {
                echo "<div class='alert alert-success'>Produit modifié avec succès !</div>";
            } else {
                echo "<div class='alert alert-danger'>Erreur lors de la modification du produit : " . $pdo->errorInfo()[2] . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Erreur lors du téléchargement de l'image.</div>";
        }
    } else {
        // Si aucune nouvelle image n'est téléchargée, on met à jour les autres champs sans changer l'image
        $update_sql = "UPDATE products SET name='$name', description='$description', price='$price', stock='$stock' WHERE id=$id";
        $result = $pdo->exec($update_sql);

        if ($result !== false) {
            echo "<div class='alert alert-success'>Produit modifié avec succès !</div>";
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de la modification du produit : " . $pdo->errorInfo()[2] . "</div>";
        }
    }
}



?>
<style>
    textarea{
        width: 30%;
        height: 200px;
    }
</style>

<button class="m-4"><a href="gestion-product.php" class="btn btn-secondary">Retour</a></button>

<h1 class="mb-4">
    Modifier le produit "<?= htmlspecialchars($product['name']) ?>"
</h1>

<div class="container">
    <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="col-12">
            <label for="name" class="form-label">Nom du produit :</label>
            <input type="text" id="name" name="name" class="form-control" value = "<?= $product['name'] ?>" required>
        </div>

        <div class="col-12">
            <label for="price" class="form-label">Prix :</label>
            <input type="number" id="price" name="price" step="0.01" class="form-control" value = "<?= $product['price'] ?>" required>
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description :</label>
            <textarea id="description" name="description" class="form-control" rows="4"><?= $product['description'] ?></textarea>
        </div>

        <div class="col-12">
            <label for="stock" class="form-label">Quantité :</label>
            <input type="number" id="stock" name="stock" class="form-control" value = "<?= $product['stock'] ?>" required>
        </div>

        <div class="col-12">
            <label for="image" class="form-label">Image du produit :</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <div class="col-12">
            <input type="submit" name="update_product" class="btn btn-primary" value="Modifier le produit">
        </div>
    </form>
</div>