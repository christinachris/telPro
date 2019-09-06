<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TalentProjects Model
 *
 * @property \App\Model\Table\TalentsTable|\Cake\ORM\Association\BelongsTo $Talents
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\TalentProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\TalentProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TalentProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TalentProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TalentProject saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TalentProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TalentProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TalentProject findOrCreate($search, callable $callback = null, $options = [])
 */
class TalentProjectsTable extends Table
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

        $this->setTable('talent_projects');
        $this->setDisplayField('talent_id');
        $this->setPrimaryKey(['talent_id', 'project_id']);

//        $this->belongsTo('Talents', [
//            'foreignKey' => 'talent_id',
//            'joinType' => 'INNER'
//        ]);
//        $this->belongsTo('Projects', [
//            'foreignKey' => 'project_id',
//            'joinType' => 'INNER'
//        ]);
        $this->belongsTo('Projects');
        $this->belongsTo('Talents');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['talent_id'], 'Talents'));
        $rules->add($rules->existsIn(['project_id'], 'Projects'));

        return $rules;
    }
}
