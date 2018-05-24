<?php

namespace kouosl\gallery\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $gallery_id
 * @property string $name
 * @property string $description
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Photos[] $photos
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => 'Gallery ID',
            'name' => 'Name',
            'description' => 'Description',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['gallery_id' => 'gallery_id']);
    }
}
