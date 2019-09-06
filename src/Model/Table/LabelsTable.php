<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Labels Model
 *
 * @method \App\Model\Entity\Label get($primaryKey, $options = [])
 * @method \App\Model\Entity\Label newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Label[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Label|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Label saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Label patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Label[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Label findOrCreate($search, callable $callback = null, $options = [])
 */
class LabelsTable extends Table
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

        $this->setTable('labels');
        $this->setDisplayField('label_id');
        $this->setPrimaryKey('label_id');
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
            ->integer('label_id')
            ->allowEmptyString('label_id', 'create');

        $validator
            ->scalar('label_name')
            ->maxLength('label_name', 225)
            ->requirePresence('label_name', 'create')
            ->allowEmptyString('label_name', false);

        $validator
            ->scalar('label_colour')
            ->maxLength('label_colour', 255)
            ->allowEmptyString('label_colour');

        return $validator;
    }
}
