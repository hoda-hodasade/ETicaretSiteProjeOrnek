<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
global $db;

$getCart = $db->prepare('SELECT * FROM cart WHERE userID = :userID');
$getCart->bindParam(':userID', $_SESSION['user']->id, PDO::PARAM_INT);
$getCart->execute();
$cart = $getCart->fetch(PDO::FETCH_OBJ);

$getCartItems = $db->prepare('SELECT * FROM cartitems WHERE cartId = :cartId');
$getCartItems->bindParam(':cartId', $cart->id, PDO::PARAM_INT);
$getCartItems->execute();

?>

<header class="position-relative">
    <nav class="navbar navbar-expand-xl bg-body-tertiary pt-4 pb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>">E-Ticaret</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?=BASE_URL?>">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>kategoriler">Kategoriler</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>hakkimizda">Hakkımızda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>iletisim">İletişim</a>
                    </li>
                </ul>

                <div class="d-flex">
                    <form action="<?= BASE_URL ?>urun/ara" method="post" id="form_searchProduct" class="me-1">
                        <div class="input-group">
                            <input type="text" class="form-control" id="keyword" name="keyword"
                                   placeholder="Ürün Ara...">
                            <button class="btn btn-outline-dark" type="submit">Ara</button>
                        </div>
                    </form>

                    <a href="<?= BASE_URL ?>sepet" class="btn btn-outline-dark me-1">
                        <span class="badge text-bg-dark"><?=$getCartItems->rowCount()?></span>
                        🛒
                    </a>

                    <?php if (!isset($_SESSION['user'])) { ?>
                        <div>
                            <a href="<?= BASE_URL ?>giris" class="btn btn-dark">Giriş Yap</a>
                            <a href="<?= BASE_URL ?>kaydol" class="btn btn-outline-dark">Üye Ol</a>
                        </div>
                    <?php } else { ?>
                        <div>
                            <a href="<?= BASE_URL ?>hesabim" class="btn btn-outline-dark">Hesabım</a>
                            <a href="<?= BASE_URL ?>cikis" class="btn btn-outline-danger">Çıkış Yap</a>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </nav>
</header>
