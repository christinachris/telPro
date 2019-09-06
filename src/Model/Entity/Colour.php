<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Colour Entity
 *
 * @property int $colour_id
 * @property string $colour_name
 */
class Colour extends Entity
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
        'colour_name' => true,
        'card_type' => true
    ];
}
