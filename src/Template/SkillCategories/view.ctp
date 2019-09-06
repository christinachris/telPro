<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SkillCategory $skillCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Skill Category'), ['action' => 'edit', $skillCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Skill Category'), ['action' => 'delete', $skillCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $skillCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Skill Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Skill Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="skillCategories view large-9 medium-8 columns content">
    <h3><?= h($skillCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($skillCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($skillCategory->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($skillCategory->id) ?></td>
        </tr>
    </table>
</div>
