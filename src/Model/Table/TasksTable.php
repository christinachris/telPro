<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tasks Model
 *
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 * @property \App\Model\Table\StatusTable|\Cake\ORM\Association\BelongsTo $Status
 * @property \App\Model\Table\ColoursTable|\Cake\ORM\Association\BelongsTo $Colours
 * @property \App\Model\Table\CommentsTable|\Cake\ORM\Association\BelongsTo $Comments
 * @property \App\Model\Table\LabelsTable|\Cake\ORM\Association\BelongsTo $Labels
 *
 * @method \App\Model\Entity\Task get($primaryKey, $options = [])
 * @method \App\Model\Entity\Task newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Task[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Task|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Task saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Task patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Task[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Task findOrCreate($search, callable $callback = null, $options = [])
 */
class TasksTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tasks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id'
        ]);
        $this->belongsTo('Status', [
            'foreignKey' => 'status_id'
        ]);
        $this->belongsTo('Colours', [
            'foreignKey' => 'colour_id'
        ]);
//        $this->belongsTo('Comments', [
//            'foreignKey' => 'comment_id',
//            'joinType' => 'INNER'
//        ]);
        $this->belongsTo('Labels', [
            'foreignKey' => 'label_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Comments');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('task_name')
            ->maxLength('task_name', 255)
            ->requirePresence('task_name', 'create')
            ->allowEmptyString('task_name', false);

        $validator
            ->dateTime('create_date')
            ->requirePresence('create_date', 'create')
            ->allowEmptyDateTime('create_date', false);

        $validator
            ->dateTime('due_date')
            ->allowEmptyDateTime('due_date');

        $validator
            ->scalar('description')
            ->maxLength('description', 1000)
            ->allowEmptyString('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->existsIn(['status_id'], 'Status'));
        $rules->add($rules->existsIn(['colour_id'], 'Colours'));
//        $rules->add($rules->existsIn(['comment_id'], 'Comments'));
        $rules->add($rules->existsIn(['label_id'], 'Labels'));

        return $rules;
    }
}
