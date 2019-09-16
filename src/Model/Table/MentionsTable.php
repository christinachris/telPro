<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mentions Model
 *
 * @property \App\Model\Table\TalentsTable|\Cake\ORM\Association\BelongsTo $Talents
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 * @property \App\Model\Table\TasksTable|\Cake\ORM\Association\BelongsTo $Tasks
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Mention get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mention newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mention[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mention|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mention saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mention patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mention[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mention findOrCreate($search, callable $callback = null, $options = [])
 */
class MentionsTable extends Table
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

        $this->setTable('mentions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

//        $this->belongsTo('Talents', [
//            'foreignKey' => 'talent_id'
//        ]);
//        $this->belongsTo('Projects', [
//            'foreignKey' => 'project_id'
//        ]);
//        $this->belongsTo('Tasks', [
//            'foreignKey' => 'task_id'
//        ]);
//        $this->belongsTo('Users', [
//            'foreignKey' => 'user_id'
//        ]);
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
            ->dateTime('mention_date')
            ->allowEmptyDateTime('mention_date');

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
//        $rules->add($rules->existsIn(['talent_id'], 'Talents'));
//        $rules->add($rules->existsIn(['project_id'], 'Projects'));
//        $rules->add($rules->existsIn(['task_id'], 'Tasks'));
//        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
