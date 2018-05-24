<?php

namespace kouosl\gallery\models;

use Yii;

/**
 * This is the model class for table "photos".
 *
 * @property int $photo_id
 * @property int $gallery_id
 * @property string $name
 *
 * @property Gallery $gallery
 */
class Photos extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'name'], 'required'],
            [['gallery_id'], 'integer'],
            [['file'], 'file'],
            [['name'], 'string', 'max' => 255],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'gallery_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'photo_id' => 'Photo ID',
            'file' => 'Image Upload',
            'gallery_id' => 'Gallery ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['gallery_id' => 'gallery_id']);
    }
}
