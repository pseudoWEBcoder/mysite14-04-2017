<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 * Has foreign keys to the tables:
 *
 * - `categoty_id`
 * - `user`
 */
class m170419_100408_create_articles_table extends Migration
{
    private $table =  'articles';
    private $shortname;

    public function init()
    {
        if(preg_match('/(^\w+)e?s$/',  $this->table,  $matches ))
            $this->shortname =$matches[1];
        else
            $this->shortname = $this->table;
    }

    /**
     * @inheritdoc
     */

    public function SafeUp()
    {

        $this->createTable($this->table, [
            $col[] =  'id_'.$this->shortname => $this->primaryKey(),
            'create_time' => $this->integer(10)->defaultValue(null),
            'update_time' => $this->integer(10)->defaultValue(null),
            'categoty_id' => $this->integer(10)->notNull(),
            'title' => $this->string(500)->defaultValue(null),
            'preview_text' => $this->text(),
            'full_text' => $this->text(),
            'user' => $this->integer(11)->defaultValue(null),
            'viewcounter' => $this->integer(11)->defaultValue(0),
            'meta_keywords' => $this->string(500)->defaultValue(null),
            'meta_description' => $this->string(500)->defaultValue(null),
            'published' => $this->boolean()->defaultValue(1),
        ]);

$this->addCommentOnColumn($this->table, $col[0],  'ID '.  $this->shortname);
$this->addCommentOnColumn($this->table, 'create_time' ,  'Дата  создания');
$this->addCommentOnColumn($this->table, 'update_time' ,  'Дата  обновления');
$this->addCommentOnColumn($this->table, 'categoty_id' ,  'ID категории');
        $this->addCommentOnColumn($this->table, 'title' ,  'заголовок');
$this->addCommentOnColumn($this->table, 'preview_text' ,  'превью');
$this->addCommentOnColumn($this->table, 'full_text' ,  'контент');
$this->addCommentOnColumn($this->table, 'user' ,  'кто  создал');
$this->addCommentOnColumn($this->table, 'viewcounter' ,  'количесво  просмотров');
$this->addCommentOnColumn($this->table, 'meta_keywords' ,  'SEO  keywords');
$this->addCommentOnColumn($this->table, 'meta_description' ,  'SEO  description');
        $this->addCommentOnColumn($this->table, 'viewcounter' ,  'опубликован ли ');
        // creates index for column `categoty_id`
        $this->createIndex(
            'idx-'.$this->table.'-categoty_id',
            $this->table,
            'categoty_id'
        );

        // add foreign key for table `categoty_id`
        $this->addForeignKey(
            'fk-'.$this->table.'-categoty_id',
            $this->table,
            'categoty_id',
            'categories',
            'id_category',
            'CASCADE'
        );

        // creates index for column `user`
        $this->createIndex(
            'idx-'.$this->table.'-user',
            $this->table,
            'user'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-'.$this->table.'-user',
            $this->table,
            'user',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `categoty_id`
        $this->dropForeignKey(
            'fk-'.$this->table.'-categoty_id',
            $this->table
        );

        // drops index for column `categoty_id`
        $this->dropIndex(
            'idx-'.$this->table.'-categoty_id',
            $this->table
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-'.$this->table.'-user',
            $this->table
        );

        // drops index for column `user`
        $this->dropIndex(
            'idx-'.$this->table.'-user',
            $this->table
        );

        $this->dropTable($this->table);
    }
}
