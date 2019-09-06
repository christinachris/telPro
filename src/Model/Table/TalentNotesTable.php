<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TalentNotes Model
 *
 * @property \App\Model\Table\TalentsTable|\Cake\ORM\Association\BelongsTo $Talents
 *
 * @method \App\Model\Entity\TalentNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\TalentNote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TalentNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TalentNote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TalentNote saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TalentNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TalentNote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TalentNote findOrCreate($search, callable $callback = null, $options = [])
 */
class TalentNotesTable extends Table
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

        $this->setTable('talent_notes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Talents', [
            'foreignKey' => 'talent_id'
        ]);
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
            ->dateTime('created_date')
            ->requirePresence('created_date', 'create')
            ->allowEmptyDateTime('created_date', false);

        $validator
            ->scalar('content')
            ->maxLength('content', 1000)
            ->allowEmptyString('content');

        $validator
            ->dateTime('edited_date')
            ->allowEmptyDateTime('edited_date');

        $validator
            ->boolean('if_flag')
            ->allowEmptyString('if_flag');

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
        $rules->add($rules->existsIn(['talent_id'], 'Talents'));

        return $rules;
    }
}
