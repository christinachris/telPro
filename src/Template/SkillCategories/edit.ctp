<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SkillCategory $skillCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $skillCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $skillCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Skill Categories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="skillCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($skillCategory) ?>
    <fieldset>
        <legend><?= __('Edit Skill Category') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
