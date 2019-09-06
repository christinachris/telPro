<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity
 *
 * @property int $id
 * @property string $task_name
 * @property \Cake\I18n\FrozenTime $create_date
 * @property \Cake\I18n\FrozenTime|null $due_date
 * @property string|null $description
 * @property int|null $project_id
 * @property int|null $status_id
 * @property int|null $colour_id
 * @property int $comment_id
 * @property int $label_id
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Colour $colour
 * @property \App\Model\Entity\Comment $comment
 * @property \App\Model\Entity\Label $label
 */
class Task extends Entity
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
        'task_name' => true,
        'create_date' => true,
        'due_date' => true,
        'description' => true,
        'project_id' => true,
        'status_id' => true,
        'colour_id' => true,
//        'comment_id' => true,
        'label_id' => true,
        'project' => true,
        'status' => true,
        'colour' => true,
        'comment' => true,

        'trait_contact' => true,
        'trait_repeat' => true,
        'trait_important' => true,
        'trait_uncertain' => true,
        'allocated_talent' =>true,
        'label' => true,
        'upload_path'  => true,
        'moved_date'=>true
    ];
}
