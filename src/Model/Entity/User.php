<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $role
 * @property string|null $email
 * @property string|null $token
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Image[] $images
 */
class User extends Entity
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
        'username' => true,
        'password' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'images' => true,
        'talent_id'=>true,
        'permission_'=>true,
        'permission_view_full_client_list'=>true,
        'permission_view_limited_client_list'=>true,
        'permission_view_full_talent_list'=>true,
        'permission_view_limited_talent_list'=>true,
        'permission_add_client'=>true,
        'permission_add_talent'=>true,
        'permission_edit_client'=>true,
        'permission_edit_talent'=>true,
        'permission_delete_talent'=>true,
        'permission_delete_client'=>true,
        'permission_archive_client'=>true,
        'permission_unarchive_client'=>true,
        'permission_archive_talent'=>true,
        'permission_unarchive_talent'=>true,
        'permission_view_archive_client_list'=>true,
        'permission_view_archive_talent_list'=>true,
        'permission_view_full_project_list'=>true,
        'permission_view_limited_project_list'=>true,
        'permission_add_project'=>true,
        'permission_edit_project'=>true,
        'permission_archive_project'=>true,
        'permission_unarchive_project'=>true,
        'permission_view_archive_project_list'=>true,
        'permission_delete_project'=>true,
        'email'=>true,
        'token'=>true


    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);


    }
}
