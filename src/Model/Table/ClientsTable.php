<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clients Model
 *
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, callable $callback = null, $options = [])
 */
class ClientsTable extends Table
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

        $this->setTable('clients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Projects', [
            'foreignKey' => 'client_id'
        ]);

        $this->hasMany('Activities', [
            'foreignKey' => 'client_id'
        ]);
        $this->hasMany('Emails', [
            'foreignKey' => 'client_id'
        ]);
        $this->hasMany('ClientNotes', [
            'foreignKey' => 'client_id'
        ]);
        $this->hasMany('Phones', [
            'foreignKey' => 'client_id'
        ]);
// Contact with Talents
        $this->belongsTo('Talents', [
            'foreignKey' => 'contact_owner_id'
        ]);
    }

    public function isOwnedBy($clientId, $userId)
    {
        return $this->exists(['id' => $clientId, 'contact_owner_id' => $userId]);
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
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->allowEmptyString('first_name', false);

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->allowEmptyString('last_name', false);

        $validator
            ->scalar('preferred_name')
            ->maxLength('preferred_name', 225)
            ->allowEmptyString('preferred_name');

        $validator
            ->email('email');


        $validator
            ->scalar('description')
            ->maxLength('description', 1000)
            ->allowEmptyString('description');

        $validator
            ->scalar('phone_no')
            ->maxLength('phone_no', 20);



        $validator
            ->date('last_contactdate')
            ->allowEmptyDate('last_contactdate');

        $validator
            ->scalar('company_name')
            ->maxLength('company_name', 500)
            ->allowEmptyString('company_name');

        $validator
            ->scalar('address_url')
            ->maxLength('address_url', 1000)
            ->allowEmptyString('address_url');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
//    public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->isUnique(['email']));
//
//        return $rules;
//    }
}
