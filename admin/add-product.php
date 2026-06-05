<?php
require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../views/layouts/header.php";

$conn=mysqli_connect("localhost","root","","nexishop");

if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    // Gerer l'ajout des images
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = __DIR__ . "/../uploads/";
        $destPath = $uploadDir . $imageName;

        if(move_uploaded_file($imageTmpPath, $destPath)){
            // Met les produits dans la base de données
            $sql = "INSERT INTO products (name, description, price, image, stock) VALUES ('$name', '$description', '$price', '$imageName', '$quantity')";
            if(mysqli_query($conn, $sql)){
                echo "<div class='alert alert-success'>Produit ajouté avec succès !</div>";
            } else {
                echo "<div class='alert alert-danger'>Erreur lors de l'ajout du produit : " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Erreur lors du téléchargement de l'image.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Aucune image sélectionnée ou erreur lors du téléchargement.</div>";
    }
}

?>

<style>
    textarea{
        width: 30%;
        height: 200px;
    }
</style>

<button class="btn btn-primary m-2"><a href="gestion-product.php" class="text-white text-decoration-none">retour à la liste des produits</a></button>

<h1 class="mb-4">Ajouter des produits</h1>

<div class="container">
    <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="col-12">
            <label for="name" class="form-label">Nom du produit :</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="col-12">
            <label for="price" class="form-label">Prix :</label>
            <input type="number" id="price" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description :</label>
            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="col-12">
            <label for="quantity" class="form-label">Quantité :</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required>
        </div>

        <div class="col-12">
            <label for="image" class="form-label">Image du produit :</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <div class="col-12">
            <input type="submit" name="add_product" class="btn btn-primary" value="Ajouter le produit">
        </div>
    </form>
</div>

<br>

