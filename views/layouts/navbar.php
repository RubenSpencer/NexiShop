<ul class="navbar-nav ms-auto">

    <li class="nav-item">
        <a class="nav-link active" href="/NexiShop/index.php">Accueil</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/NexiShop/products.php">Produits</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/NexiShop/cart.php">Panier</a>
    </li>

    <?php if (isset($_SESSION['user'])): ?>

        <li class="nav-item">
            <span class="nav-link">
                Bonjour <?= htmlspecialchars($_SESSION['user']['username']) ?>
            </span>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/NexiShop/logout.php">
                Déconnexion
            </a>
        </li>

    <?php else: ?>

        <li class="nav-item">
            <a class="nav-link" href="/NexiShop/views/auth/login.php">
                Connexion
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/NexiShop/views/auth/register.php">
                Inscription
            </a>
        </li>

    <?php endif; ?>

</ul>