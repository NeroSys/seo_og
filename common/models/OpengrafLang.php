<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Exception;

/**
 * This is the model class for table "{{%opengraf_lang}}".
 *
 * @property int $id
 * @property int $item_id
 * @property int $lang_id
 * @property string $lang
 * @property string $title
 * @property string $keywords
 * @property string $description
 *
 * @property Opengraf $item
 */
class OpengrafLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%opengraf_lang}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'lang_id'], 'integer'],
            [['lang'], 'string', 'max' => 50],
            [['title', 'keywords', 'description'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Opengraf::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'lang' => Yii::t('app', 'Lang'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Opengraf::className(), ['id' => 'item_id']);
    }

    public function beforeSave($insert)
    {
        $ret = parent::beforeSave($insert);

        $lng = Lang::find()->where(['id' => $this->lang_id])->one();

        if($this->isNewRecord) {
            try {
                if (empty($lng)) throw new Exception('Неверный язык');
                $this->lang = $lng->local;
            } catch (Exception $e) {
                $ret = false;
            }
        }
        return $ret;
    }

    public function getLangList($item_id){

        return ArrayHelper::getColumn(OpengrafLang::find()->select('lang_id')->distinct('lang_id')->where(['item_id' => $item_id])->all(), 'lang_id');

    }

    public function getArray($item_id){


        return ArrayHelper::map(Lang::find()->where(['NOT IN', 'id', $this->getLangList($item_id)])->all(), 'id', 'name');
    }
}
