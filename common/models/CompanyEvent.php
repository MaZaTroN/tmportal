<?php

namespace common\models;

use Yii;
use common\helpers\UtilsHelper;

/**
 * This is the model class for table "company_event".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $thumbnail
 * @property integer $status 
 *
 * @property Photo[] $photos
 */
class CompanyEvent extends base\BaseCompanyEvent
{
    public $imageFile;
    
    public function scenarios()
    {
        return array(
            self::SCENARIO_DEFAULT => array('name','description','date','status','!thumbnail'),
        );
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
            [['name'], 'string', 'max' => 255],
            [['status'], 'integer'],
            [['thumbnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public static function find()
    {
        return new CompanyEventQuery(get_called_class());
    }

    public static function getEventsDirPath(){
        $dir = Yii::getAlias('@frontend/web/uploads/events/');
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        return $dir;
    }
    
    public static function getEventsRelPath(){
        return '/uploads/events/';
    }
    
    public static function getEventRelPath($id){
        if(!is_dir(self::getEventsDirPath().$id)){
            mkdir(self::getEventsDirPath().$id);
        }
        return '/uploads/events/' . $id . '/';
    }

    /**
    * Returns event photos relative path
     * @param integer $id event id
     * @param boolean $thumb is thumb path
     * @return string '/uploads/events/' . $id . '/photos/'
     */
    public static function getEventPhotosRelPath($id, $thumb = false){
        if(!is_dir(self::getEventsDirPath(). $id . '/photos/')){
            mkdir(self::getEventsDirPath(). $id . '/photos/');
        }
        return '/uploads/events/' . $id . '/photos/' . ($thumb ? 'thumb/' : '');
    }
    
    public function uploadPreview(){
        $dir = self::getEventsDirPath();
        $fileName = 'thumbnail' . '.' . $this->thumbnail->extension;
        if(!is_dir($dir . $this->id)){
            mkdir($dir . $this->id);
        }
        $this->thumbnail->saveAs($dir . $this->id . '/' . $fileName);
        $image = \Yii::$app->image->load($dir . $this->id . '/' . $fileName);
        $image->resize(Yii::$app->params['thumbnail']['width'], Yii::$app->params['thumbnail']['height'])->save($dir . $this->id . '/' . $fileName);
        $this->thumbnail = self::getEventRelPath($this->id) . $fileName;
        $this->update();
    }
}

class CompanyEventQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => UtilsHelper::STATUS_ACTIVE]);
    }
}