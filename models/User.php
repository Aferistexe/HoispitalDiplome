<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string $login
 * @property string $password
 * @property int $role_id
 * @property string $auth_key
 *
 * @property Order[] $orders
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // Обязательные поля
            [['full_name', 'phone', 'email', 'login', 'password'], 'required'],
    
            // Типы данных
            [['role_id'], 'integer'],
    
            // Уникальность логина
            [['login'], 'unique'],
    
            // Email-валидация
            ['email', 'email'],
    
            // Проверка существования роли
            ['role_id', 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
    
            // Длина строк
            [['full_name', 'email'], 'string', 'max' => 100],
            [['phone', 'login'], 'string', 'max' => 50],
            [['password', 'auth_key'], 'string', 'max' => 255],
    
            // Паттерн: ФИО — только буквы, пробелы и дефисы
            ['full_name', 'match', 'pattern' => '/^[А-Яа-яЁёA-Za-z\s\-]+$/u', 'message' => 'ФИО может содержать только буквы, пробелы и дефисы'],
    
            // Паттерн: телефон — формат +7 (999) 123-45-67
            ['phone', 'match', 'pattern' => '/^\+7\s?\(\d{3}\)\s?\d{3}-\d{2}-\d{2}$/', 'message' => 'Введите номер в формате: +7 (XXX) XXX-XX-XX'],
    
            // Паттерн: логин — только латинские буквы, цифры, подчёркивания, от 4 до 50 символов
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9_]{4,50}$/', 'message' => 'Логин должен содержать только латинские буквы, цифры и подчёркивания'],
    
            // Паттерн: пароль — минимум 6 символов, хотя бы одна буква и одна цифра
            ['password', 'match', 'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/', 'message' => 'Пароль должен быть не короче 6 символов и содержать хотя бы одну букву и одну цифру'],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'login' => 'Login',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // не реализовано, можно вернуть null
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Найти пользователя по логину
     *
     * @param string $login
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * Генерация случайного ключа аутентификации
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Проверка пароля (хэш сравнивается с введённым)
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Генерация хэша пароля из открытого пароля
     *
     * @param string $password
     */
    public function generatePassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    public function getDoctor()
    {
        return $this->hasOne(Doctors::class, ['user_id' => 'id']);
    }
}
