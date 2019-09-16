<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mention Entity
 *
 * @property int $id
 * @property int|null $talent_id
 * @property \Cake\I18n\FrozenTime|null $mention_date
 * @property int|null $project_id
 * @property int|null $task_id
 * @property int|null $user_id
 *
 * @property \App\Model\Entity\Talent $talent
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Task $task
 * @property \App\Model\Entity\User $user
 */
class Mention extends Entity
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
        'talent_id' => true,
        'mention_date' => true,
        'project_id' => true,
        'task_id' => true,
        'task_name' => true,
        'user_id' => true,
        'talent' => true,
        'project' => true,
        'task' => true,
        'user' => true
    ];
}
