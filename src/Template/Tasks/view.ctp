<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Status'), ['controller' => 'Status', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Status', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colours'), ['controller' => 'Colours', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colour'), ['controller' => 'Colours', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Labels'), ['controller' => 'Labels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Label'), ['controller' => 'Labels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tasks view large-9 medium-8 columns content">
    <h3><?= h($task->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Task Name') ?></th>
            <td><?= h($task->task_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($task->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $task->has('project') ? $this->Html->link($task->project->id, ['controller' => 'Projects', 'action' => 'view', $task->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $task->has('status') ? $this->Html->link($task->status->status_id, ['controller' => 'Status', 'action' => 'view', $task->status->status_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Colour') ?></th>
            <td><?= $task->has('colour') ? $this->Html->link($task->colour->colour_id, ['controller' => 'Colours', 'action' => 'view', $task->colour->colour_id]) : '' ?></td>
        </tr>
<!--        <tr>-->
<!--            <th scope="row">--><?//= __('Comment') ?><!--</th>-->
<!--            <td>--><?//= $task->has('comment') ? $this->Html->link($task->comment->comment_id, ['controller' => 'Comments', 'action' => 'view', $task->comment->comment_id]) : '' ?><!--</td>-->
<!--        </tr>-->
        <tr>
            <th scope="row"><?= __('Label') ?></th>
            <td><?= $task->has('label') ? $this->Html->link($task->label->label_id, ['controller' => 'Labels', 'action' => 'view', $task->label->label_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($task->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Date') ?></th>
            <td><?= h($task->create_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Due Date') ?></th>
            <td><?= h($task->due_date) ?></td>
        </tr>
    </table>
</div>
