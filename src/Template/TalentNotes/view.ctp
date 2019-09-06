<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TalentNote $talentNote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Talent Note'), ['action' => 'edit', $talentNote->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Talent Note'), ['action' => 'delete', $talentNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentNote->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Talent Notes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Note'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="talentNotes view large-9 medium-8 columns content">
    <h3><?= h($talentNote->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Content') ?></th>
            <td><?= h($talentNote->content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Talent') ?></th>
            <td><?= $talentNote->has('talent') ? $this->Html->link($talentNote->talent->id, ['controller' => 'Talents', 'action' => 'view', $talentNote->talent->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($talentNote->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($talentNote->created_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited Date') ?></th>
            <td><?= h($talentNote->edited_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('If Flag') ?></th>
            <td><?= $talentNote->if_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
