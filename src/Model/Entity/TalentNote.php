<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TalentNote Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created_date
 * @property string|null $content
 * @property \Cake\I18n\FrozenTime|null $edited_date
 * @property bool|null $if_flag
 * @property int|null $talent_id
 *
 * @property \App\Model\Entity\Talent $talent
 */
class TalentNote extends Entity
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
        'created_date' => true,
        'content' => true,
        'edited_date' => true,
        'if_flag' => true,
        'talent_id' => true,
        'talent' => true
    ];
}
