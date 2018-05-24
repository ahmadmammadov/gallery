<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180520_193618_gallery
 */
class m180520_193618_gallery extends Migration
{
    public function up()
    {
        $this->createTable('gallery', [
            'gallery_id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'description' => $this->text(),
            'updated_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP')->append('on update current_timestamp'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            //'updated_at' => 'timestamp on update current_timestamp',
            //'created_at' => $this->dateTime()->notNull(),
        ]);
        $this->createTable('photos', [
            'photo_id' => $this->primaryKey(),
            'gallery_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-photos-gallery_id',
            'photos',
            'gallery_id',
            'gallery',
            'gallery_id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-photos-gallery_id',
            'post'
        );

        $this->dropTable('gallery');
        $this->dropTable('photos');
    }
}
