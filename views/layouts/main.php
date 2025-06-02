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
            ['label' => 'Продукты', 'url' => ['/site/producs']],  // исправлено с producs
            ['label' => 'Врачи', 'url' => ['/site/doctors']],
            ['label' => 'Новости', 'url' => ['/site/news']],
            ['label' => 'Заказы', 'url' => ['/order/index'], 'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == Role::$NEW_USER)],
            ['label' => 'Админка', 'url' => ['/order/admin'], 'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == Role::$NEW_ADMIN)],
            ['label' => 'Создать заказ', 'url' => ['/contact/create'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Обратная связь', 'url' => ['/contact/index'], 'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == Role::$NEW_ADMIN)],

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
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Моя компания <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
