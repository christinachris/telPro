<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientNotes Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\ClientNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientNote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClientNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientNote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientNote saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientNote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientNote findOrCreate($search, callable $callback = null, $options = [])
 */
class ClientNotesTable extends Table
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

        $this->setTable('client_notes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id'
        ]);

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
            ->dateTime('create_date')
            ->requirePresence('create_date', 'create')
            ->allowEmptyDateTime('create_date', false);

        $validator
            ->scalar('content')
            ->maxLength('content', 1000)
            ->allowEmptyString('content');

        $validator
            ->dateTime('edit_date')
            ->requirePresence('edit_date', 'create')
            ->allowEmptyDateTime('edit_date', false);

        $validator
            ->boolean('id_flag')
            ->allowEmptyString('id_flag');

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
        $rules->add($rules->existsIn(['client_id'], 'Clients'));

        return $rules;
    }
}
