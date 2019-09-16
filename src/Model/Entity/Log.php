<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Log Entity
 *
 * @property int $id
 * @property int|null $task_id
 * @property int|null $project_id
 * @property \Cake\I18n\FrozenTime|null $log_time
 * @property string|null $action_type
 * @property int|null $user_name
 * @property int|null $user_role
 *
 * @property \App\Model\Entity\Task $task
 * @property \App\Model\Entity\Project $project
 */
class Log extends Entity
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
        'task_id' => true,
        'project_id' => true,
        'log_time' => true,
        'action_type' => true,
        'user_name' => true,
        'user_role' => true,
        'task' => true,
        'project' => true,
        'task_name' => true,
        'value' => true
    ];
}
