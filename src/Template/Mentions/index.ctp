<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mention[]|\Cake\Collection\CollectionInterface $mentions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Mention'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mentions index large-9 medium-8 columns content">
    <h3><?= __('Mentions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('talent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mention_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('task_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mentions as $mention): ?>
            <tr>
                <td><?= $this->Number->format($mention->id) ?></td>
                <td><?= $mention->has('talent') ? $this->Html->link($mention->talent->id, ['controller' => 'Talents', 'action' => 'view', $mention->talent->id]) : '' ?></td>
                <td><?= h($mention->mention_date) ?></td>
                <td><?= $mention->has('project') ? $this->Html->link($mention->project->id, ['controller' => 'Projects', 'action' => 'view', $mention->project->id]) : '' ?></td>
                <td><?= $mention->has('task') ? $this->Html->link($mention->task->id, ['controller' => 'Tasks', 'action' => 'view', $mention->task->id]) : '' ?></td>
                <td><?= $mention->has('user') ? $this->Html->link($mention->user->id, ['controller' => 'Users', 'action' => 'view', $mention->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mention->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mention->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mention->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mention->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
