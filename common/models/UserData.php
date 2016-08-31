<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_data".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $office_id
 * @property integer $position_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $address
 * @property string $phone
 * @property string $skype
 * @property string $hire_date
 * @property string $birthday
 * @property string $comment
 * @property string $photo
 * @property integer $map_place
 *
 * @property Office $office
 * @property JobPosition $position
 * @property User $user
 */
class UserData extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required', 'on' => 'default'],
            [['hire_date','office_id'], 'required', 'on' => 'create'],
            [['user_id', 'office_id', 'position_id', 'gender', 'map_place'], 'integer'],
            [['hire_date', 'birthday', 'gender'], 'safe'],
            [['comment'], 'string'],
            [['first_name', 'last_name', 'address', 'phone', 'skype', 'photo'], 'string', 'max' => 255],
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Office::className(), 'targetAttribute' => ['office_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = [
            'office_id',
            'position_id',
            'first_name',
            'last_name',
            'gender',
            'address',
            'phone',
            'skype',
            'hire_date',
            'birthday',
        ];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserData', 'ID'),
            'user_id' => Yii::t('UserData', 'User ID'),
            'office_id' => Yii::t('UserData', 'Office ID'),
            'position_id' => Yii::t('UserData', 'Position ID'),
            'first_name' => Yii::t('UserData', 'First Name'),
            'last_name' => Yii::t('UserData', 'Last Name'),
            'gender' => Yii::t('UserData', 'Gender'),
            'address' => Yii::t('UserData', 'Address'),
            'phone' => Yii::t('UserData', 'Phone'),
            'skype' => Yii::t('UserData', 'Skype'),
            'hire_date' => Yii::t('UserData', 'Hire Date'),
            'birthday' => Yii::t('UserData', 'Birthday'),
            'comment' => Yii::t('UserData', 'About me'),
            'photo' => Yii::t('UserData', 'Photo'),
            'map_place' => Yii::t('UserData', 'Map Place'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Office::className(), ['id' => 'office_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(JobPosition::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFullName(){
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public static function getGenders(){
        return [
            self::GENDER_FEMALE => Yii::t('app', 'Female'),
            self::GENDER_MALE => Yii::t('app', 'Male')
        ];
    }
    
    /**
     * Get gender name
     * @param type $gender
     * @return type
     */
    public function getGenderName() {
        if (!$this->gender) {
            return \common\helpers\UtilsHelper::getNotSetMsg();
        }
        return \Yii::t('app', self::getGenders()[$this->gender]);
    }
}
