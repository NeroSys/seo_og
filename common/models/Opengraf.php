<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "{{%opengraf}}".
 *
 * @property int $id
 * @property string $modelName
 * @property int $itemId
 * @property string $type
 * @property string $img
 * @property string $url
 * @property string $video
 * @property string $audio
 * @property string $localeAlternative
 * @property string $GAuthor
 * @property string $GPublisher
 * @property int $app_id
 * @property int $created_at
 *
 */
class Opengraf extends \yii\db\ActiveRecord
{

    public $title;
    public $titleNew;
    public $keywords;
    public $keywordsNew;
    public $description;
    public $descriptionNew;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%opengraf}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemId', 'app_id'], 'integer'],
            [
                [
                    'title',
                    'titleNew',
                    'keywords',
                    'keywordsNew',
                    'description',
                    'descriptionNew'
                ], 'safe'],
            [['created_at'], 'safe'],
            [['modelName', 'type', 'img', 'url', 'video', 'audio', 'localeAlternative', 'GAuthor', 'GPublisher'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'modelName' => Yii::t('app', 'Model Name'),
            'itemId' => Yii::t('app', 'Item ID'),
            'type' => Yii::t('app', 'Type'),
            'img' => Yii::t('app', 'Img'),
            'url' => Yii::t('app', 'Url'),
            'video' => Yii::t('app', 'Video'),
            'audio' => Yii::t('app', 'Audio'),
            'localeAlternative' => Yii::t('app', 'Locale Alternative'),
            'GAuthor' => Yii::t('app', 'Google+ author'),
            'GPublisher' => Yii::t('app', 'Google+ publisher'),
            'app_id' => Yii::t('app', 'App ID'),
            'created_at' => Yii::t('app', 'Дата добавления'),
        ];
    }

    public function getOpengrafLangs()
    {
        return $this->hasMany(OpengrafLang::className(), ['item_id' => 'id']);
    }

    /*
* Возвращает массив объектов модели
*/
    public function getItems(){
        return $this->find()->all();
    }
    /*
     * Возвращает данные для указанного языка
     */
    public function getDataItems(){
        $language = Yii::$app->language;
        $data_lang = $this->getOpengrafLangs()->where(['lang'=>$language])->one();
        return $data_lang;
    }

    public function getDataitemsAdmin(){

        $language = 'ru-RU';
        $data_lang = $this->getOpengrafLangs()->where(['lang'=>$language])->one();
        return $data_lang;
    }

    /*
     * Возвращает объект по его url
     */
    public function getLang($url){
        return $this->find()->where(['url' => $url])->one();
    }

    public static function getValue($id, $langId){

        return OpengrafLang::find()->where(['item_id' => $id])->andWhere(['lang_id' => $langId])->one();
    }

    public function getLangList($item_id){

        return ArrayHelper::getColumn(OpengrafLang::find()->select('lang_id')->distinct('lang_id')->where(['item_id' => $item_id])->all(), 'lang_id');

    }

    public function getArray($item_id){


        return ArrayHelper::map(Lang::find()->where(['NOT IN', 'id', $this->getLangList($item_id)])->all(), 'id', 'name');
    }

    /*
    * Сохранение значений переводов в сопутствующую таблицу
    */

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);


        if(!empty($this->title)){
            foreach ($this->title as $lang => $item){

                $key_id = key($item);
                $lang = OpengrafLang::find()->where(['lang_id' => $lang])->andWhere(['id'=>$key_id])->one();

                if(!empty($lang)){
                    $lang->title = array_pop($item);

                    $lang->keywords = $this->keywords[$lang->lang_id][$key_id];
                    $lang->description = $this->description[$lang->lang_id][$key_id];

                    $lang->save();
                }
            }
        };

        if(!empty($this->titleNew)) {

            foreach ($this->titleNew as $lang_id => $data) {


                $lang = Lang::find()->where(['id' => $lang_id])->one()->local;

                $itemTitle = (is_array($data) ? array_pop($data) : '');
                $itemKeywords = (is_array($this->keywordsNew) ? array_pop($this->keywordsNew[$lang_id]) : '');
                $itemDescription = (is_array($this->descriptionNew) ? array_pop($this->descriptionNew[$lang_id]) : '');

                $item = new OpengrafLang();

                $item->item_id = $this->id;
                $item->lang_id = $lang_id;
                $item->lang = $lang;

                $item->title = (!empty($itemTitle) ? $itemTitle : '');
                $item->keywords = (!empty($itemKeywords) ? $itemKeywords : '');
                $item->description = (!empty($itemDescription) ? $itemDescription : '');

                $item->save();
            }
        }

    }

}
