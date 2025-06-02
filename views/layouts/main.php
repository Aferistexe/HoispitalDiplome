<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\Role;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerJsFile('@web/js/contact.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => "Profi", // Название бренда
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark lol'] // убрал класс "lol"
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Товары', 'url' => ['/site/producs']],  // исправлено с producs
            ['label' => 'Врачи', 'url' => ['/site/doctors']],
            ['label' => 'Новости', 'url' => ['/site/news']],
            ['label' => 'Заказы', 'url' => ['/order/index'], 'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == Role::$NEW_USER)],
            ['label' => 'Админка', 'url' => ['/order/admin'], 'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == Role::$NEW_ADMIN)],
            ['label' => 'Создать заказ', 'url' => ['/contact/create'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Админка обратная связь', 'url' => ['/contact/index'], 'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == Role::$NEW_ADMIN)],
            ['label' => 'Мои назначения', 'url' => ['/order/doctor'], 'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == 3)],

            Yii::$app->user->isGuest
                ? ['label' => 'Войти', 'url' => ['/user/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Html::encode(Yii::$app->user->identity->login) . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>',
            ['label' => 'Регистрация', 'url' => ['/user/register'], 'visible' => Yii::$app->user->isGuest],
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer">
    <div class="footer-container container">
        <div class="footer-logo-description">
            <span class="logo">Profi</span>
            <p>Profi — ведущая компания в области профессиональных медицинских услуг и продуктов.</p>
        </div>
        <div class="footer-about-us">
            <h4>О компании</h4>
            <ul>
                <li><a href="/site/index">Главная</a></li>
                <li><a href="/site/producs">Товары</a></li>
                <li><a href="/site/doctors">Врачи</a></li>
                <li><a href="/site/news">Новости</a></li>
            </ul>
        </div>
        <div class="footer-contacts">
            <h4>Контакты</h4>
            <p>Телефон: +7 (123) 456-78-90</p>
            <p>Email: info@profi.example</p>
            <p>Адрес: г.Рощино</p>
        </div>
    </div>
    <hr class="footer-divider" />
    <div class="footer-rights">
        &copy; Моя компания <?= date('Y') ?> — Все права защищены  
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
