<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property int|null $status 0-new, 1-processed
 * @property int $is_completed
 * @property int $created_at
 * @property int $updated_at
 */
class Contact extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_COMPLETED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'message'], 'required'],
            [['message', 'user_agent'], 'string'],
            [['status', 'is_completed', 'created_at', 'updated_at'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['ip_address'], 'string', 'max' => 45],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['is_completed', 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'message' => 'Message',
            'ip_address' => 'IP Address',
            'user_agent' => 'User Agent',
            'status' => 'Status',
            'is_completed' => 'Выполнено',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Получение списка статусов
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_PROCESSED => 'В обработке',
            self::STATUS_COMPLETED => 'Завершен',
        ];
    }

    /**
     * Получение текстового значения статуса
     * @return string
     */
    public function getStatusText()
    {
        $statuses = self::getStatuses();
        return $statuses[$this->status] ?? 'Неизвестный статус';
    }
}