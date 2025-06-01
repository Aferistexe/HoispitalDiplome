<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Помощи.нет</title>

    <!-- Предварительное подключение к ресурсам Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Подключение шрифтов Wix Madefor Display и Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Wix+Madefor+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Подключение основного CSS файла -->
    <link rel="stylesheet" href="/css/main.css">

    <!-- Подключение Font Awesome для иконок -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="hero container">
            <div class="hero--info">
                <h1>Добро пожаловать в Помощи.нет</h1>
                <p>Ведущая клиника кибермедицины в Найтсити. Мы предлагаем передовые медицинские решения, основанные на
                    инновационных технологиях, для обеспечения здоровья и благополучия наших пациентов.
                    "Помощь.net" - это не просто клиника, это место, где кибермедицина встречает человеческое понимание и
                    заботу. Наша команда врачей, специализирующихся в области киберимплантов, обеспечивает индивидуальный
                    подход к каждому пациенту, помогая им восстановить здоровье и качество жизни.
                    Мы предлагаем широкий спектр услуг, включая установку, обслуживание и обновление киберимплантов, а
                    также реабилитацию после операций. Наши современные медицинские установки и передовые технологии
                    позволяют нам обеспечивать высококачественное и безопасное медицинское обслуживание нашим пациентам.
                </p>
                <button class="btn">Подробнее</button>
            </div>
            <img src="img/main.jpg" alt="Клиника кибермедицины">
        </div>

        <!-- Блок "Наши специализации" -->
        <div class="specialities-container">
            <h2 class="specialities-title">Наши специализации</h2>
            <hr class="specialities-divider" />
            <div class="specialities-content">
                <p class="specialities-text">
                    Имплантация киберпротезов, кибернетическая хирургия, программирование нейроинтерфейсов и многое другое.
                </p>
            </div>
        </div>

        <div class="services-container container">
            <div class="service-item">
                <i class="logo fa fa-ambulance"></i>
                <div class="text">
                    <h3>Круглосуточная поддержка скорой помощи</h3>
                    <p>Круглосуточная поддержка скорой помощи гарантирует быстрое реагирование на любую медицинскую
                        ситуацию в любое время суток.</p>
                </div>
            </div>
            <div class="service-item">
                <i class="logo fa fa-eye"></i>
                <div class="text">
                    <h3>Киберимплантация 2.0</h3>
                    <p>Революционная технология для улучшения человеческих возможностей.</p>
                </div>
            </div>
            <div class="service-item">
                <i class="logo fa fa-brain"></i>
                <div class="text">
                    <h3>Улучшение мозговых функций с помощью киберимплантов</h3>
                    <p>Киберимпланты для мозга - это передовые медицинские устройства, разработанные для оптимизации и
                        улучшения функций человеческого мозга.</p>
                </div>
            </div>
            <div class="service-item">
                <i class="logo fa fa-hospital"></i>
                <div class="text">
                    <h3>У нас 20 современных операционных залов</h3>
                    <p>Наши операционные залы обеспечивают комфорт и безопасность как для пациентов, так и для
                        медицинского персонала.</p>
                </div>
            </div>
            <div class="service-item">
                <i class="logo fa fa-user-md"></i>
                <div class="text">
                    <h3>Центр замены суставов</h3>
                    <p>Проведение операций по замене суставов с использованием передовых имплантатов. Наша команда
                        опытных хирургов и медицинских специалистов обеспечивает высококачественное лечение и
                        реабилитацию пациентов с заболеваниями суставов.</p>
                </div>
            </div>
            <div class="service-item">
                <i class="logo fa fa-microscope"></i>
                <div class="text">
                    <h3>Центр киберимплантации</h3>
                    <p>Где технология встречает человеческий организм.</p>
                </div>
            </div>
        </div>

        <!-- Пакеты здоровья -->
        <div class="health-packages-container container">
            <h2 class="block-title">Пакеты здоровья</h2>
            <hr class="divider-line" />
            <div class="packages-wrapper">
                <!-- Пример пакетов, каждый можно оформить динамически из базы данных -->
                <div class="package">
                    <h3 class="unity-title">Базовое благополучие Помощи.net</h3>
                    <div>
                        <div class="price-container">
                            <p class="price">Цена: $1500</p>
                        </div>
                        <button class="bron-btn">Забронировать</button>
                        <a href="#" class="read-a">Подробнее</a>
                    </div>
                    <ul>
                        <li><span class="icon-Health check">&#10004;</span>Кибер-диагностика и анализ</li>
                        <li><span class="icon-Health check">&#10004;</span>КиберЭКГ</li>
                        <li><span class="icon-Health cross">&#10008;</span>Киберимпланты Премиум</li>
                        <li><span class="icon-Health cross">&#10008;</span>Сканирование киберлипидов</li>
                        <li><span class="icon-Health cross">&#10008;</span>Киберрентген грудной клетки</li>
                        <li><span class="icon-Health cross">&#10008;</span>Киберсахар в крови</li>
                        <li><span class="icon-Health cross">&#10008;</span>Основной пакет киберздоровья</li>
                        <li><span class="icon-Health cross">&#10008;</span>Базовый план киберблагополучия</li>
                        <li><span class="icon-Health cross">&#10008;</span>Тесты функции легких</li>
                    </ul>
                </div>
                <div class="package">
                    <h3 class="unity-title">Золотое благополучие Помощи.net</h3>
                    <div>
                        <div class="price-container">
                            <p class="price">Цена: $3000</p>
                        </div>
                        <button class="bron-btn">Забронировать</button>
                        <a href="#" class="read-a">Подробнее</a>
                    </div>
                    <ul>
                        <li><span class="icon-Health check">&#10004;</span>Кибер-диагностика и анализ</li>
                        <li><span class="icon-Health check">&#10004;</span>КиберЭКГ</li>
                        <li><span class="icon-Health check">&#10004;</span>Киберимпланты Премиум</li>
                        <li><span class="icon-Health check">&#10004;</span>Сканирование киберлипидов</li>
                        <li><span class="icon-Health cross">&#10008;</span>Киберрентген грудной клетки</li>
                        <li><span class="icon-Health cross">&#10008;</span>Киберсахар в крови</li>
                        <li><span class="icon-Health cross">&#10008;</span>Основной пакет киберздоровья</li>
                        <li><span class="icon-Health cross">&#10008;</span>Базовый план киберблагополучия</li>
                        <li><span class="icon-Health cross">&#10008;</span>Тесты функции легких</li>
                    </ul>
                </div>
                <div class="package">
                    <h3 class="unity-title">Премиум благополучие Помощи.net</h3>
                    <div>
                        <div class="price-container">
                            <p class="price">Цена: $5000</p>
                        </div>
                        <button class="bron-btn">Забронировать</button>
                        <a href="#" class="read-a">Подробнее</a>
                    </div>
                    <ul>
                        <li><span class="icon-Health check">&#10004;</span>Кибер-диагностика и анализ</li>
                        <li><span class="icon-Health check">&#10004;</span>КиберЭКГ</li>
                        <li><span class="icon-Health check">&#10004;</span>Киберимпланты Премиум</li>
                        <li><span class="icon-Health check">&#10004;</span>Сканирование киберлипидов</li>
                        <li><span class="icon-Health check">&#10004;</span>Киберрентген грудной клетки</li>
                        <li><span class="icon-Health check">&#10004;</span>Киберсахар в крови</li>
                        <li><span class="icon-Health cross">&#10008;</span>Основной пакет киберздоровья</li>
                        <li><span class="icon-Health cross">&#10008;</span>Базовый план киберблагополучия</li>
                        <li><span class="icon-Health cross">&#10008;</span>Тесты функции легких</li>
                    </ul>
                </div>
                <div class="package">
                    <h3 class="unity-title">Эксклюзивное благополучие Помощи.net</h3>
                    <div>
                        <div class="price-container">
                            <p class="price">Цена: $10000</p>
                        </div>
                        <button class="bron-btn">Забронировать</button>
                        <a href="#" class="read-a">Подробнее</a>
                    </div>
                    <ul>
                        <li><span class="icon-Health check">&#10004;</span>Кибер-диагностика и анализ</li>
                        <li><span class="icon-Health check">&#10004;</span>КиберЭКГ</li>
                        <li><span class="icon-Health check">&#10004;</span>Киберимпланты Премиум</li>
                        <li><span class="icon-Health check">&#10004;</span>Сканирование киберлипидов</li>
                        <li><span class="icon-Health check">&#10004;</span>Киберрентген грудной клетки</li>
                        <li><span class="icon-Health check">&#10004;</span>Киберсахар в крови</li>
                        <li><span class="icon-Health check">&#10004;</span>Основной пакет киберздоровья</li>
                        <li><span class="icon-Health check">&#10004;</span>Базовый план киберблагополучия</li>
                        <li><span class="icon-Health check">&#10004;</span>Тесты функции легких</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>