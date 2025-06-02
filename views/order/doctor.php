<?php

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_card_order',
    'summary' => '',
    'emptyText' => '<div class="alert alert-info">Нет заказов для отображения</div>',
    'options' => ['class' => 'order-cards'],
    'itemOptions' => ['class' => 'mb-4'],
]);