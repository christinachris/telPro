<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mention $mention
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mention'), ['action' => 'edit', $mention->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mention'), ['action' => 'delete', $mention->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mention->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mentions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mention'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mentions view large-9 medium-8 columns content">
    <h3><?= h($mention->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Talent') ?></th>
            <td><?= $mention->has('talent') ? $this->Html->link($mention->talent->id, ['controller' => 'Talents', 'action' => 'view', $mention->talent->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $mention->has('project') ? $this->Html->link($mention->project->id, ['controller' => 'Projects', 'action' => 'view', $mention->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Task') ?></th>
            <td><?= $mention->has('task') ? $this->Html->link($mention->task->id, ['controller' => 'Tasks', 'action' => 'view', $mention->task->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $mention->has('user') ? $this->Html->link($mention->user->id, ['controller' => 'Users', 'action' => 'view', $mention->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mention->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mention Date') ?></th>
            <td><?= h($mention->mention_date) ?></td>
        </tr>
    </table>
</div>
