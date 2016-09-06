<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "company_event".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $thumbnail
 * @property integer $published
 * @property integer $deleted
 *
 * @property Photo[] $photos
 */
class BaseCompanyEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['published', 'deleted'], 'integer'],
            [['name', 'thumbnail'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('CompanyEvent', 'ID'),
            'name' => Yii::t('CompanyEvent', 'Name'),
            'description' => Yii::t('CompanyEvent', 'Description'),
            'date' => Yii::t('CompanyEvent', 'Date'),
            'thumbnail' => Yii::t('CompanyEvent', 'Thumbnail'),
            'published' => Yii::t('CompanyEvent', 'Published'),
            'deleted' => Yii::t('CompanyEvent', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['event_id' => 'id']);
    }
}
