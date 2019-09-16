<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientNote Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $create_date
 * @property string|null $content
 * @property \Cake\I18n\FrozenTime $edit_date
 * @property bool|null $id_flag
 * @property int|null $client_id
 *
 * @property \App\Model\Entity\Client $client
 */
class ClientNote extends Entity
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
        'create_date' => true,
        'content' => true,
        'edit_date' => true,
        'id_flag' => true,
        'client_id' => true,
        'client' => true,
        'client_note_flag'=>true
    ];
}
