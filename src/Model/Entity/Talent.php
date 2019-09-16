<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Talent Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $preferred_name
 * @property string $email
 * @property string $phone_no
 * @property string|null $address
 * @property \Cake\I18n\FrozenDate $join_date
 * @property string|null $speciality
 * @property string|null $logcre_name
 * @property string|null $logcre_detail
 * @property string|null $occupied
 * @property string|null $url
 * @property string|null $cost
 * @property string|null $response_time
 * @property string|null $quality_ofWork
 * @property int|null $skill_category_id
 *
 * @property \App\Model\Entity\SkillCategory $skill_category
 * @property \App\Model\Entity\TalentProject[] $talent_projects
 */
class Talent extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'preferred_name' => true,
        'email' => true,
        'phone_no' => true,
        'address' => true,
        'url' => true,
        'cost' => true,
        'response_time' => true,
        'quality_ofWork' => true,
        'note_id' => true,
        'occupied' => true,
        'speciality_id' => true,
        'skill_categories_id' => true,
        'position' => true,
        'talent_notes' => true,
        'speciality' => true,
        'skill_category' => true
    ];

}
