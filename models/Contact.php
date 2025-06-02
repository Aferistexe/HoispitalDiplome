<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Contact extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_COMPLETED = 2;

    public static function tableName()
    {
        return 'contact';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
        ];
    }
    public function rules()
    {
        return [
            // Обязательные поля
            [['name', 'phone', 'email', 'message'], 'required'],
    
            // Типы данных
            [['message'], 'string'],
            [['status'], 'integer'],
            [['is_completed'], 'boolean'],
    
            // Длина строк
            [['name', 'phone', 'email', 'ip_address'], 'string', 'max' => 255],
    
            // Валидация email
            ['email', 'email'],
    
            // Паттерн: имя — буквы, пробелы, дефисы
            ['name', 'match', 'pattern' => '/^[А-Яа-яЁёA-Za-z\s\-]+$/u', 'message' => 'Имя может содержать только буквы, пробелы и дефисы'],
    
            // Паттерн: телефон — формат +7 (999) 123-45-67
            ['phone', 'match', 'pattern' => '/^\+7\s?\(\d{3}\)\s?\d{3}-\d{2}-\d{2}$/', 'message' => 'Введите номер в формате: +7 (XXX) XXX-XX-XX'],
        ];
    }
    

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Email',
            'message' => 'Сообщение',
            'ip_address' => 'IP адрес',
            'is_completed' => 'Завершено',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function getStatusText(): string
    {
        return $this->is_completed ? 'Завершено' : 'Новый';
    }
    
    public function getStatusClass(): string
    {
        return $this->is_completed ? 'success' : 'secondary';
    }
    
    public function toggleCompleted()
    {
        $this->is_completed = (int)!$this->is_completed;
        
        if ($this->is_completed) {
            $this->status = self::STATUS_COMPLETED;
        } else {
            $this->status = self::STATUS_PROCESSED;
        }
        
        return $this->save(false, ['is_completed', 'status']);
    }
}