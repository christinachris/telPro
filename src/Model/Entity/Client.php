<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $preferred_name
 * @property string $email
 * @property string|null $description
 * @property string $phone_no
 * @property \Cake\I18n\FrozenDate|null $last_contactdate
 * @property string|null $company_name
 * @property string|null $address_url
 *
 * @property \App\Model\Entity\Project[] $projects
 */
class Client extends Entity
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
        'credential' => true,
        'last_contactdate' => true,
        'company_name' => true,
        'address_url' => true,
        'lifecycle_stage' => true,
        'contact_owner_id' => true,
        'phone_no' => true,
        'talent' => true,
        'note' => true,
        'client_activities' => true,
        'client_emails' => true,
        'client_phones' => true,
        'projects' => true,
        'email' => true,
        'flag' =>true,
        'archive' =>true,
    ];
}
