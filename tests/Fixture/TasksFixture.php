<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TasksFixture
 */
class TasksFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'task_name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'create_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'due_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'description' => ['type' => 'string', 'length' => 1000, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'project_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'status_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'colour_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'comment_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'label_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'task_status_fk' => ['type' => 'index', 'columns' => ['status_id'], 'length' => []],
            'task_comments_fk' => ['type' => 'index', 'columns' => ['comment_id'], 'length' => []],
            'task_colour_fk' => ['type' => 'index', 'columns' => ['colour_id'], 'length' => []],
            'task_label_fk' => ['type' => 'index', 'columns' => ['label_id'], 'length' => []],
            'task_project_fk' => ['type' => 'index', 'columns' => ['project_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'task_colour_fk' => ['type' => 'foreign', 'columns' => ['colour_id'], 'references' => ['colours', 'colour_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'task_comments_fk' => ['type' => 'foreign', 'columns' => ['comment_id'], 'references' => ['comments', 'comment_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'task_label_fk' => ['type' => 'foreign', 'columns' => ['label_id'], 'references' => ['labels', 'label_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'task_project_fk' => ['type' => 'foreign', 'columns' => ['project_id'], 'references' => ['projects', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'task_status_fk' => ['type' => 'foreign', 'columns' => ['status_id'], 'references' => ['status', 'status_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'task_name' => 'Lorem ipsum dolor sit amet',
                'create_date' => '2019-04-21 12:09:28',
                'due_date' => '2019-04-21 12:09:28',
                'description' => 'Lorem ipsum dolor sit amet',
                'project_id' => 1,
                'status_id' => 1,
                'colour_id' => 1,
                'comment_id' => 1,
                'label_id' => 1
            ],
        ];
        parent::init();
    }
}
