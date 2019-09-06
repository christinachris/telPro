<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TalentNote[]|\Cake\Collection\CollectionInterface $talentNotes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Talent Note'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentNotes index large-9 medium-8 columns content">
    <h3><?= __('Talent Notes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('content') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('if_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('talent_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($talentNotes as $talentNote): ?>
            <tr>
                <td><?= $this->Number->format($talentNote->id) ?></td>
                <td><?= h($talentNote->created_date) ?></td>
                <td><?= h($talentNote->content) ?></td>
                <td><?= h($talentNote->edited_date) ?></td>
                <td><?= h($talentNote->if_flag) ?></td>
                <td><?= $talentNote->has('talent') ? $this->Html->link($talentNote->talent->id, ['controller' => 'Talents', 'action' => 'view', $talentNote->talent->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $talentNote->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $talentNote->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $talentNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentNote->id)]) ?>
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
