<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Talents Model
 *
 * @property \App\Model\Table\SkillCategoriesTable|\Cake\ORM\Association\BelongsTo $SkillCategories
 * @property \App\Model\Table\TalentProjectsTable|\Cake\ORM\Association\HasMany $TalentProjects
 * @property \App\Model\Table\SpecialitiesTable|\Cake\ORM\Association\BelongsTo $Specialities

 *
 * @method \App\Model\Entity\Talent get($primaryKey, $options = [])
 * @method \App\Model\Entity\Talent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Talent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Talent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Talent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Talent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Talent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Talent findOrCreate($search, callable $callback = null, $options = [])
 */
class TalentsTable extends Table
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

        $this->setTable('talents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

//        $this->belongsTo('SkillCategories', [
//            'foreignKey' => 'skill_category_id'
//        ]);
//        $this->hasMany('TalentProjects', [
//            'foreignKey' => 'talent_id'
//        ]);

        // Team 34's
        $this->belongsToMany('Projects', [
            'through' => 'TalentProjects',
        ]);

        $this->belongsTo('Specialities', [
            'foreignKey' => 'speciality_id'
        ]);

        $this->belongsTo('SkillCategories', [
            'foreignKey' => 'skill_categories_id'
        ]);
        $this->hasMany('TalentNotes', [
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
            ->maxLength('preferred_name', 255)
            ->allowEmptyString('preferred_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('phone_no')
            ->maxLength('phone_no', 20)
            ->requirePresence('phone_no', 'create')
            ->allowEmptyString('phone_no', false);

        $validator
            ->scalar('address')
            ->maxLength('address', 1000)
            ->allowEmptyString('address');

        $validator
            ->date('join_date')
            //->requirePresence('join_date', 'create')
            ->allowEmptyDate('join_date', false);

        $validator
            ->scalar('speciality')
            ->maxLength('speciality', 1000)
            ->allowEmptyString('speciality');

        $validator
            ->scalar('logcre_name')
            ->maxLength('logcre_name', 255)
            ->allowEmptyString('logcre_name');

        $validator
            ->scalar('logcre_detail')
            ->maxLength('logcre_detail', 255)
            ->allowEmptyString('logcre_detail');

        $validator
            ->scalar('occupied')
            ->maxLength('occupied', 255)
            ->allowEmptyString('occupied');

        $validator
            ->scalar('archive')
            ->maxLength('archive', 255)
            ->allowEmptyString('archive');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->allowEmptyString('url');

        $validator
            ->scalar('cost')
            ->maxLength('cost', 255)
            ->allowEmptyString('cost');

        $validator
            ->scalar('response_time')
            ->maxLength('response_time', 255)
            ->allowEmptyString('response_time');

        $validator
            ->scalar('quality_ofWork')
            ->maxLength('quality_ofWork', 255)
            ->allowEmptyString('quality_ofWork');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['skill_category_id'], 'SkillCategories'));
        $rules->add($rules->existsIn(['speciality_id'], 'Specialities'));


        return $rules;
    }
}
