<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TalentProject Entity
 *
 * @property int $talent_id
 * @property int $project_id
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate|null $end_date
 *
 * @property \App\Model\Entity\Talent $talent
 * @property \App\Model\Entity\Project $project
 */
class TalentProject extends Entity
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
        'talent' => true,
        'project' => true
    ];
}
