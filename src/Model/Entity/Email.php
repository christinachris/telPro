<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Email Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $email_address
 * @property bool|null $is_primary
 * @property int|null $client_id
 *
 * @property \App\Model\Entity\Client $client
 */
class Email extends Entity
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
        'title' => true,
        'email_address' => true,
        'is_primary' => true,
        'client_id' => true,
        'client' => true
    ];
}
