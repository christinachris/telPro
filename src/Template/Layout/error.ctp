<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        .kt-error-v3 {
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover; }
        .kt-error-v3 .kt-error_container .kt-error_number > h1 {
            font-size: 20.7rem;
            margin-left: 7.85rem;
            margin-top: 11.4rem;
            font-weight: 500;
            -webkit-text-stroke-width: 0.35rem;
            -moz-text-stroke-width: 0.35rem;
            text-stroke-width: 0.35rem;
            color: #A3DCF0;
            -webkit-text-stroke-color: white;
            -moz-text-stroke-color: white;
            text-stroke-color: white; }
        @media screen\0 {
            .kt-error-v3 .kt-error_container .kt-error_number > h1 {
                color: white; } }
        .kt-error-v3 .kt-error_container .kt-error_title {
            margin-left: 9.85rem;
            font-size: 2.5rem;
            font-weight: 700;
            color: #464457; }
        .kt-error-v3 .kt-error_container .kt-error_subtitle {
            margin-left: 7.85rem;
            margin-top: 1.57rem;
            font-size: 2rem;
            font-weight: 700;
            color: #6c7293; }
        .kt-error-v3 .kt-error_container .kt-error_description {
            margin-left: 7.85rem;
            font-size: 1.4rem;
            font-weight: 500;
            color: #6c7293; }

        @media (max-width: 768px) {
            .kt-error-v3 .kt-error_container .kt-error_number > h1 {
                font-size: 8rem;
                margin-left: 4rem;
                margin-top: 3.5rem; }
            .kt-error-v3 .kt-error_container .kt-error_title {
                margin-left: 4rem; }
            .kt-error-v3 .kt-error_container .kt-error_subtitle {
                margin-left: 4rem;
                padding-right: 0.5rem; }
            .kt-error-v3 .kt-error_container .kt-error_description {
                margin-left: 4rem;
                padding-right: 0.5rem; } }


        .kt-error-v5 {
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover; }
        .kt-error-v5 .kt-error_container .kt-error_title > h1 {
            font-size: 14rem;
            margin-left: 25rem;
            margin-top: 18rem;
            font-weight: 700;
            color: #314DA7;
            -webkit-text-stroke-color: white; }
        .kt-error-v5 .kt-error_container .kt-error_subtitle {
            margin-left: 26rem;
            margin-top: 3.57rem;
            font-size: 2.3rem;
            font-weight: 700;
            color: #6c7293; }
        .kt-error-v5 .kt-error_container .kt-error_description {
            margin-left: 26rem;
            font-size: 1.8rem;
            font-weight: 500;
            line-height: 130%;
            color: #a7abc3; }

        @media (min-width: 1025px) and (max-width: 1399px) {
            .kt-error-v5 {
                background-position: bottom -80px left 1300px; }
            .kt-error-v5 .kt-error_container .kt-error_title > h1 {
                font-weight: 700;
                font-size: 12rem;
                margin-left: 7rem; }
            .kt-error-v5 .kt-error_container .kt-error_subtitle {
                margin-left: 7rem;
                font-size: 2.3rem;
                font-weight: 700; }
            .kt-error-v5 .kt-error_container .kt-error_description {
                margin-left: 7rem;
                font-size: 1.8rem;
                font-weight: 500;
                line-height: 130%; } }

        @media (min-width: 769px) and (max-width: 1024px) {
            .kt-error-v5 .kt-error_container .kt-error_title > h1 {
                font-weight: 700;
                font-size: 12rem;
                margin-left: 7rem; }
            .kt-error-v5 .kt-error_container .kt-error_subtitle {
                margin-left: 7rem;
                font-size: 2.3rem;
                font-weight: 700; }
            .kt-error-v5 .kt-error_container .kt-error_description {
                margin-left: 7rem;
                font-size: 1.8rem;
                font-weight: 500;
                line-height: 130%; } }

        @media (max-width: 768px) {
            .kt-error-v5 .kt-error_container .kt-error_title > h1 {
                font-size: 6rem;
                margin-top: 5rem;
                margin-left: 4rem; }
            .kt-error-v5 .kt-error_container .kt-error_subtitle {
                margin-top: 2rem;
                margin-left: 4rem;
                font-size: 2rem;
                line-height: 2rem; }
            .kt-error-v5 .kt-error_container .kt-error_description {
                font-size: 1.4rem;
                margin-left: 4rem; } }
    </style>
    <?= $this->Html->css('base/style.bundle.css') ?>
</head>
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed  kt-subheader--enabled kt-subheader--transparent">
<!--    <div id="container">-->
<!--        <div id="header">-->
<!--            <h1>--><?//= __('Error') ?><!--</h1>-->
<!--        </div>-->
<!--        <div id="content">-->
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
<!--        </div>-->
<!--        <div id="footer">-->
<!--            <?//= $this->Html->link(__('Back'), 'javascript:history.back()') ?> -->
<!--        </div>-->
<!--    </div>-->
</body>
<script>
    var KTAppOptions = {"colors":{"state":{"brand":"#716aca","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
</script>
</html>
