<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activity Entity
 *
 * @property int $id
 * @property string $type
 * @property string|null $summary
 * @property \Cake\I18n\FrozenTime $create_date
 * @property \Cake\I18n\FrozenTime|null $edit_date
 * @property int|null $client_id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property \Cake\I18n\FrozenTime|null $time
 * @property string|null $activity_flag
 *
 * @property \App\Model\Entity\Client $client
 */
class Activity extends Entity
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
        'type' => true,
        'summary' => true,
        'create_date' => true,
        'edit_date' => true,
        'client_id' => true,
        'date' => true,
        'time' => true,
        'client' => true,
        'activity_flag'=>true,
        'talent_id'=>true
    ];
}
