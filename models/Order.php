<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property int $device_type_id
 * @property string $insurance_policy
 * @property string $medical_record_number
 * @property string $passport_number
 * @property string $passport_series
 * @property string $birthday
 * @property int $status_id
 * @property string $appointment_date
 * @property string $appointment_time
 * @property string|null $created_at
 * @property string|null $feedback
 * @property int|null $doctor_id
 * @property int $is_completed
 *
 * @property DeviceType $deviceType
 * @property Service $service
 * @property Status $status
 * @property User $user
 * @property Doctors $doctor
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id', 'device_type_id', 'insurance_policy', 
              'medical_record_number', 'passport_number', 'passport_series',
              'birthday', 'status_id', 'appointment_date', 'appointment_time'], 'required'],
            [['user_id', 'service_id', 'device_type_id', 'status_id', 'doctor_id', 'is_completed'], 'integer'],
            [['birthday', 'appointment_date', 'appointment_time', 'created_at'], 'safe'],
            [['feedback'], 'string'],
            [['insurance_policy', 'medical_record_number', 'passport_number', 'passport_series'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctors::class, 'targetAttribute' => ['doctor_id' => 'id']],
            [['device_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::class, 'targetAttribute' => ['device_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'service_id' => 'Service ID',
            'device_type_id' => 'Device Type ID',
            'insurance_policy' => 'Insurance Policy',
            'medical_record_number' => 'Medical Record Number',
            'passport_number' => 'Passport Number',
            'passport_series' => 'Passport Series',
            'birthday' => 'Birthday',
            'status_id' => 'Status ID',
            'appointment_date' => 'Appointment Date',
            'appointment_time' => 'Appointment Time',
            'created_at' => 'Created At',
            'feedback' => 'Feedback',
            'doctor_id' => 'Doctor ID',
            'is_completed' => 'Is Completed'
        ];
    }

    /**
     * Gets query for [[DeviceType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceType()
    {
        return $this->hasOne(DeviceType::class, ['id' => 'device_type_id']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /**
     * Gets query for [[Doctor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctors::class, ['id' => 'doctor_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}