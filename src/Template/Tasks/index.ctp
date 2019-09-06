<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */

use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\Core\Configure;
//I18n::Locale('es-au');
// my_connection is defined in your database config
$conn = ConnectionManager::get('default');
?>
<!-- begin:: Header Topbar -->

<div class="kt-header__topbar">
    <?php
    $results = $conn
        ->execute('select * from tasks');
    $count = 0;
    foreach ($results

             as $task) {
        $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
        $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
        $datediff = date_diff($sys_date, $due_date);

        if ($datediff->days < 10) {
            $count = $count + 1
            ?>
            <?php
        }
        if (!empty($task['moved_date'])) {
            $moved_date = date_create_from_format('Y-m-d H:i:s', $task['moved_date']);
            $datediff_Moved = date_diff($moved_date, $sys_date);
            if ($task['status_id'] == 3) {
                if ($datediff_Moved->days > 5) {
                    $count = $count + 1;
                }
            }
        }

    }

    ?>
    <!--begin: Notifications -->
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,10px">
											<span class="kt-header__topbar-icon">
												<i class="flaticon2-bell-alarm-symbol"></i>
												<span class="kt-badge kt-badge--success kt-hidden"></span>
											</span>
            <span class="kt-badge kt-badge--danger"
                  style=" position: absolute;top: -5px;right: -5px; width:24px; height:24px ;opacity: 0.9 ; font-weight: 500;font-size: 15px"> <?php echo $count; ?></span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
            <form>

                <!--begin: Head -->
                <div class="kt-head kt-head--skin-light kt-head--fit-x" style="padding-bottom: 20px">
                    <h3 class="kt-head__title" style="text-align: center">
                        User Notifications
                        <span class="btn btn-label-primary btn-sm btn-bold btn-font-md"><?php echo $count ?> new </span>
                    </h3>
                </div>

                <!--end: Head -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true"
                             data-height="300" data-mobile-height="200">
                            <?php
                            $results = $conn
                                ->execute('select * from tasks');

                            foreach ($results as $task) {
                                $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
                                $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                $datediff = date_diff($sys_date, $due_date);
                                if ($datediff->days < 10) {
                                    ?>
                                    <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id']]); ?>"
                                       class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-line-chart kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title">
                                                Task: <b> <?php echo $task["task_name"] ?> </b> is coming to the due
                                                date !
                                            </div>
                                            <div class="kt-notification__item-time">
                                                <?php echo $datediff->days ?> Days left
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                }
                                if (!empty($task['moved_date'])) {
                                    $moved_date = date_create_from_format('Y-m-d H:i:s', $task['moved_date']);
                                    $datediff_Moved = date_diff($moved_date, $sys_date);
                                    if ($task['status_id'] == 3) {
                                        if ($datediff_Moved->days > 5) { ?>
                                            <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id']]); ?>"
                                               class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-bar-chart kt-font-info"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        Task: <b> <?php echo $task["task_name"] ?> </b> needs to be
                                                        followed up !
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        <?php echo $datediff->days ?> Days passed
                                                    </div>
                                                </div>
                                            </a>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!--end: Notifications -->

    <!--begin: User bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,10px">
            <span class="kt-header__topbar-welcome kt-visible-desktop" style="font-size: 16px">G'day ,</span>
            <span class="kt-header__topbar-username kt-visible-desktop" style="font-size: 16px"><?php echo $this->Session->read('Auth.User.username') ?> ! </span>
            <span class="kt-header__topbar-icon kt-bg-brand kt-font-lg kt-font-bold kt-font-light kt-hidden">S</span>
            <span class="kt-header__topbar-icon kt-hidden"><i class="flaticon2-user-outline-symbol"></i></span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

            <!--begin: Head -->
            <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                <div class="kt-user-card__avatar">
                    <!--                    <img class="kt-hidden-" alt="Pic" src="../assets/media/users/300_25.jpg"/>-->

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                </div>
                <div class="kt-user-card__name">
                    <?php echo  $this->Session->read('Auth.User.role'). ":  ".  $this->Session->read('Auth.User.username') ?>
                </div>
                <!--                <div class="kt-user-card__badge">-->
                <!--                    <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span>-->
                <!--                </div>-->
            </div>

            <!--end: Head -->

            <!--begin: Navigation -->
            <div class="kt-notification">
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-calendar-3 kt-font-success"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Profile-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            Account settings and more-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-mail kt-font-warning"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Messages-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            Inbox and tasks-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-rocket-1 kt-font-danger"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Activities-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            Logs and notifications-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-hourglass kt-font-brand"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Tasks-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            latest tasks and projects-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
                <div class="kt-notification__custom">
                    <?= $this->Html->link('<span class="btn btn-primary"><i class="flaticon2-plus]"></i> Sign Out</span>', ['controller' => 'Users', 'action' => 'logout', 'type' => 'button'], ['escape' => false]) ?>
                </div>
            </div>

            <!--end: Navigation -->
        </div>
    </div>
    <!--end: User bar -->

</div>
<!-- end:: Header Topbar -->
</div>
</div>
</div>
<!-- end:: Header -->

<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">

                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a
                            href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Talents', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
                </ul>

            </div>

        </div>
        <!-- end: Header Menu -->
    </div>
</div>

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <!-- Header End -->

            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Dashboard </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                           class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                           class="kt-subheader__breadcrumbs-link">
                            Project List </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                           class="kt-subheader__breadcrumbs-link">
                            <?php foreach ($projectName as $name) {
                                echo $name->project_name;
                            } ?></a>


                        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <div class="btn kt-subheader__btn-daterange" title="Select dashboard daterange">
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date"
                                  id="kt_dashboard_daterangepicker_date"><?php echo date("M d") ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px"
                                 height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                        id="check" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path
                                        d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                        id="Combined-Shape" fill="#000000"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-content kt-grid__item kt-grid__item--fluid">
                <!-- Start : Sticky-toolbar-->
                <ul class="kt-sticky-toolbar" style="margin-top: 30px;">
                    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="kt_demo_panel_toggle"
                        data-toggle="kt-tooltip" title="" data-placement="right"
                        data-original-title="Check out more demos">
                        <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                           class=""><i
                                class="flaticon-home-2"></i></a>
                    </li>
                    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--brand" data-toggle="kt-tooltip" title=""
                        data-placement="left" data-original-title="Layout Builder">
                        <a href="<?php echo $this->Url->build(["controller" => "colours", "action" => "index"]); ?>"><i
                                class="flaticon2-gear"></i></a>
                    </li>
                    <!--    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--warning" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Documentation">-->
                    <!--        <a href="https://keenthemes.com/metronic/?page=docs" target="_blank"><i class="flaticon2-telegram-logo"></i></a>-->
                    <!--    </li>-->
                    <!---->
                    <!--    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--danger" id="kt_sticky_toolbar_chat_toggler" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Chat Example">-->
                    <!--        <a href="#" data-toggle="modal" data-target="#kt_chat_modal"><i class="flaticon2-chat-1"></i></a>-->
                    <!--    </li>-->
                </ul>
                <!-- End : Sticky-toolbar-->

                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__body"
                         style="padding:5px ; margin: 10px ;background-image: url('<?= $this->Url->image('bg-3.jpg') ?>') ">

                        <div class="kt-widget14__header">
                            <div class="kt-subheader__title">
                                <h4>
                                    <b><?php foreach ($projectName

                                        as $name) {
                                        echo $name->project_name;
                                        ?></b>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-form-label col-lg-3 col-sm-12 "
                                   Style="font-size: 20px; font-weight: bold">Project Overview Progress
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px"
                                     height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="30" height="30"/>
                                        <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                        <path
                                            d="M12.4208204,17.1583592 L15.4572949,11.0854102 C15.6425368,10.7149263 15.4923686,10.2644215 15.1218847,10.0791796 C15.0177431,10.0271088 14.9029083,10 14.7864745,10 L12,10 L12,7.17705098 C12,6.76283742 11.6642136,6.42705098 11.25,6.42705098 C10.965921,6.42705098 10.7062236,6.58755277 10.5791796,6.84164079 L7.5427051,12.9145898 C7.35746316,13.2850737 7.50763142,13.7355785 7.87811529,13.9208204 C7.98225687,13.9728912 8.09709167,14 8.21352549,14 L11,14 L11,16.822949 C11,17.2371626 11.3357864,17.572949 11.75,17.572949 C12.034079,17.572949 12.2937764,17.4124472 12.4208204,17.1583592 Z"
                                            id="Path-3" fill="#000000"/>
                                    </g>
                                </svg>
                            </label>
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="kt-ion-range-slider"
                                ">
                                <input type="hidden" id="kt_slider_1" name="project_num"
                                       value=" <?php echo $projectNum->progress_num; ?>" data-min="0"
                                       data-grid="true"
                                       data-project-id="<?php echo $id; ?>">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2" style="margin-top: 15px">
                            <button type="button" id="Btn-progress"
                                    class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-md"
                                    style="margin-left: 15px">
                                Update
                            </button>
                            <!--                            <button type="button" id="Btn-reset"-->
                            <!--                                    class="btn btn-danger btn-elevate btn-pill btn-elevate-air btn-md"-->
                            <!--                                    style="margin-left: 15px">-->
                            <!--                                Reset-->
                            <!--                            </button>-->
                        </div>
                    </div>
                    <span>
                <b>Start Date : <?php echo $name->start_date;
                    } ?> </b>
			</span>
                </div>

            </div>
            <div class="board">
                <?php
                $i = 0;
                foreach ($status as $status) {
                    $i = $i + 1;
                    ?>
                    <div class="status-card">
                        <div class="card-header"
                             Style="background-color:  #dfe1e6; border-bottom: none; padding-top: 0px">
                            <div class="row">
                                <div class="col-10">
                        <span class="card-header-text"
                              Style="padding-top: 5px"><h5><?php echo $status->status_name; ?></h5></span></div>
                                <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" id="clear"
                                   data-toggle="modal"
                                   data-target="#kt_modal_<?php echo $status->status_id; ?>">
                                    <i class="flaticon2-add-1"></i>
                                </a>
                            </div>
                        </div>

                        <!--begin::Modal : ADD New Task -->
                        <div class="modal fade" id="kt_modal_<?php echo $status->status_id; ?>"
                             class="kt_modal_<?php echo $status->status_id; ?>" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" style="margin-top: 50px" role="document">

                                <?= $this->Form->create($taskAdd, ['enctype' => 'multipart/form-data']) ?>

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create New Task</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="la la-remove"></span>
                                        </button>
                                    </div>
                                    <form class="kt-form">
                                        <div class="modal-body">

                                            <div class="form-group row" style="margin : 3px">
                                                <label class="col-form-label col-lg-3 col-sm-12"> Task
                                                    Trait </label>
                                                <?php

                                                echo $this->Form->control('trait_contact',
                                                    [
                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                        'type' => 'checkbox',
                                                        'value' => 'Y',
                                                        'hiddenField' => 'N',
                                                        'label' => [
                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                            'text' => '     <span class="kt-badge kt-badge--success kt-badge--lg breath"
                                                      style="background-color: #0079bf ; margin: 10px ;margin-left: 15px"><i
                                                        class="flaticon-speech-bubble-1"></i></span> Contact',
                                                            'escape' => false
                                                        ]
                                                    ]);
                                                echo $this->Form->control('trait_repeat',
                                                    [
                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                        'type' => 'checkbox',
                                                        'value' => 'Y',
                                                        'hiddenField' => 'N',
                                                        'label' => [
                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                            'text' => '<span  style="margin: 10px; margin-left: 15px" class="kt-badge kt-badge--success kt-badge--lg breath"><i
                                                        class="flaticon2-circular-arrow "></i></span> Repeat ',
                                                            'escape' => false
                                                        ]
                                                    ]);
                                                ?>
                                            </div>
                                            <div class="form-group row" style="margin : 3px">
                                                <label class="col-form-label col-lg-3 col-sm-12"> </label>
                                                <?php
                                                echo $this->Form->control('trait_important',
                                                    [
                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                        'type' => 'checkbox',
                                                        'value' => 'Y',
                                                        'hiddenField' => 'N',
                                                        'label' => [
                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                            'text' => '<span  style="margin: 10px ;margin-left: 15px" class="kt-badge kt-badge--danger kt-badge--lg fa-beat"><i
                                                        class="flaticon2-attention"></i></span> Important',
                                                            'escape' => false
                                                        ]
                                                    ]);
                                                echo $this->Form->control('trait_uncertain',
                                                    [
                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                        'type' => 'checkbox',
                                                        'value' => 'Y',
                                                        'hiddenField' => 'N',
                                                        'class' => 'labe',
                                                        'label' => [
                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                            'text' => '<span style="margin: 10px ;margin-left: 15px"
                                                  class="kt-badge kt-badge--warning kt-badge--lg fa-beat"><b>?</b></span> Uncertain',
                                                            'escape' => false
                                                        ]
                                                    ]);
                                                ?>
                                            </div>

                                            <div class="form-group row" style="margin : 3px">
                                                <div class="col-lg-6">
                                                    <?php
                                                    $options = [NULL => '     '];
                                                    echo $this->Form->control('colour_id',
                                                        [
                                                            'templates' => ['inputContainer' => '{{content}}'],
                                                            'type' => 'select',
                                                            'options' => $options + $card_types,
                                                            'class' => 'form-control col-lg-8 col-md-9 col-sm-12',
                                                            'label' => [
                                                                'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                'text' => 'Card Type'
                                                            ]
                                                        ]); ?>
                                                </div>
                                                <div class="col-lg-6">
                                                    <?php
                                                    $results = $conn
                                                        ->execute('select * from talent_projects, talents where talent_projects.talent_id = talents.id and talent_projects.project_id = :id ', ['id' => $id]);
                                                    $talent_list = [];
                                                    foreach ($results as $talent) {
                                                        $talent_list = $talent_list + [$talent['id'] => $talent['position'] . " - " . $talent['first_name'] . " " . $talent['last_name']];
                                                    }

                                                    $options = [NULL => '     '];
                                                    echo $this->Form->control('allocated_talent',
                                                        [
                                                            'templates' => ['inputContainer' => '{{content}}'],
                                                            'type' => 'select',
                                                            'options' => $options + $talent_list,
                                                            'class' => 'form-control col-lg-8 col-md-9 col-sm-12',
                                                            'label' => [
                                                                'class' => 'col-form-label col-lg-5 col-sm-12',
                                                                'text' => 'Allocate Talents'
                                                            ]
                                                        ]); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row" style="margin : 3px">
                                                <div class="col-lg-6">
                                                    <?php echo $this->Form->control('task_name', [
                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                        'maxlength' => '800',
                                                        'class' => 'form-control col-lg-8 col-md-9 col-sm-12 edit_form',
                                                        'label' => [
                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                            'text' => 'Task Title'
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <!--//Auto-store Create-date-->
                                                <?php echo $this->Form->hidden('create_date', ['value' => date("Y-m-d H:i:s")]); ?>
                                                <div class="col-lg-6">
                                                    <?php echo $this->Form->control('due_date', [
                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                        'class' => 'input-group date form-control col-lg-8 col-md-9 col-sm-12 ',
                                                        'type' => 'text',
                                                        'required' => 'required',
                                                        'id' => 'kt_datetimepicker_2', // this ID is fixed, using for Helper Datepicker !
                                                        'label' => [
                                                            'class' => 'col-form-label col-lg-5 col-sm-12',
                                                            'text' => 'Task Due Date'
                                                        ]
                                                    ]); ?>
                                                </div>
                                            </div>
                                            <div class="form-group  " style="margin : 3px">
                                                <div class="col-lg-12">
                                                    <?php echo $this->Form->control('description', [
                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                        'type' => 'textarea',
                                                        'maxlength' => '4000',
                                                        'row' => '5',
                                                        'class' => 'form-control col-lg-10 col-md-10 col-sm-12',
                                                        'label' => [
                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                            'text' => 'Description'
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <?php
                                                echo $this->Form->hidden('project_id', ['value' => $id]);
                                                echo $this->Form->hidden('status_id', ['value' => $status->status_id]);
                                                echo $this->Form->hidden('label_id', ['value' => 1]); ?>
                                                <label class="col-form-label" for="description"
                                                       style="margin-top: 5px">Upload New
                                                    Image</label>
                                                <div class="form-group row" style="margin : 5px">

                                                    <?php
                                                    echo $this->Form->control('upload', [
                                                        'type' => 'file',
                                                        'class' => 'custom-file-upload kt-dropzone dropzone dz-clickable',
                                                        'style' => 'padding-top:60px'
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="padding-top: 20px ">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <!--Button has not template in Cakephp, need to set a templates before change it -->
                                            <?php
                                            $this->Form->setTemplates([
                                                'button' => '<button{{attrs}}>{{text}}</button>'])
                                            ?>

                                            <?= $this->Form->button('Submit ', [
                                                'type' => 'submit',
                                                'class' => 'btn btn-brand',
                                                'escape' => false
                                            ]);
                                            ?>
                                            <?= $this->Form->end() ?>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end::Modal-->

                        <ul class="sortable "
                            id="sort<?php echo $status->status_id; ?>"
                            data-status-id="<?php echo $status->status_id; ?>">
                            <?php foreach ($tasks as $task) {
                                if ($task->status_id == $status->status_id) { ?>
                                    <li class="text-row ui-sortable-handle"
                                        data-task-id="<?php echo $task->id; ?>">
                                        <a href="#" data-toggle="modal"
                                           data-target="#kt_modala_<?php echo $task->id; ?>">
                                            <div class="kt-portlet kt-portlet--mobile kt-portlet--sortable"
                                                 style="margin-bottom: 0px">
                                                <div class="kt-portlet__head"
                                                     style="min-height: 10px ; padding-left: 5px ; padding-top: 3px ; padding-bottom: 3px ; padding-right: 0px ;border:none ; cursor: default">

                                    <span
                                        class="kt-badge  kt-badge--inline kt-badge--pill kt-badge--rounded"
                                        style="min-height: 20px ; font-weight: bold; color: #ffffff ;
                                    background-color:
                                    <?php
                                        if (!empty($task->colour_id)) {
                                            foreach ($colours as $colour) {
                                                if ($colour->colour_id == $task->colour_id) {
                                                    echo $colour->colour_name;
                                                }
                                            }
                                        } ?>">
                                        <?php
                                        // -- Display the Name for the Colour (set by User)

                                        foreach ($colours as $colour) {
                                            if ($colour->colour_id == $task->colour_id) {

                                                echo $colour->card_type;
                                                // need to be changed here "Colour_name"
                                            }

                                        } ?>
                                    </span>
                                                    <?php if ($task->allocated_talent != NULL) { ?>
                                                        <span
                                                            class=" name kt-badge kt-badge--outline kt-badge--primary  kt-badge--inline kt-badge--pill kt-badge--sm"
                                                            style="  margin-bottom: 8px;
                                                                              font-weight: bold;">
                                                                <style>
                                                                      /* Portrait and Landscape */
                                                                      @media only screen
                                                                      and (min-device-width: 834px)
                                                                      and (max-device-width: 1112px) {
                                                                          .name {
                                                                              margin-bottom: 8px;
                                                                              font-weight: bold;
                                                                              height: auto !important;
                                                                              line-height: 1;
                                                                              margin-left: 10px;
                                                                          }

                                                                      }
                                                                </style>
                                                            <?php
                                                            $results = $conn
                                                                ->execute('select * from talent_projects, talents where talent_projects.talent_id = talents.id and talent_projects.project_id = :id and talent_projects.talent_id = :talent_id', ['id' => $task->project_id, 'talent_id' => $task->allocated_talent]);
                                                            foreach ($results as $talent) {
                                                                echo $talent['position'] . " - " . $talent['first_name'] . " " . $talent['last_name'];
                                                            } ?>
                                    </span>
                                                    <?php } ?>
                                                </div>
                                                <div class="images">
                                                    <?php
                                                    $findme = 'webroot';
                                                    $mystring = $task->upload_path;
                                                    $pos2 = stripos($mystring, $findme);
                                                    $path = substr($mystring, $pos2);
                                                    $realpath = urldecode(str_replace("%5C", "/", urlencode($path)));
                                                    echo $this->Html->image("/" . $realpath,
                                                        ['style' => "max-width: 100%;display: block;max-height: 250px;width: auto;height: auto;"]);
                                                    //                                            echo $_SERVER['DOCUMENT_ROOT'] .'/IMS-project/'. $realpath;
                                                    ?>
                                                </div>
                                                <div class="kt-portlet__head"
                                                     style="border-bottom: none ;min-height: 30px; margin: 0px ;padding: 0px ;padding-left: 10px ; padding-right: 5px ; cursor: url(<?= $this->Url->image('edit.svg') ?>), default; ">
                                                    <div class="kt-portlet__head-label">
                                                        <h5 class="kt-portlet__head-title"
                                                            style="font-size: 1rem ;display: inline-block; overflow-wrap: break-word;  hyphens: auto">
                                                            <?php echo $task->task_name; ?>
                                                        </h5>
                                                    </div>

                                                </div>

                                                <div class="kt-portlet__foot"
                                                     style="padding:3px; padding-top:5px ; padding-bottom: 3px; border: none ;">
                                                    <!--  Button Comments in the Card  -->
                                                    <?php
                                                    $results = $conn
                                                        ->newQuery()
                                                        ->select('*')
                                                        ->from('comments')
                                                        ->where(['task_id' => $task->id])
                                                        ->order(['comment_date' => 'DESC'])
                                                        ->execute();
                                                    $rowCount = count($results);
                                                    ?>
                                                    <div class="row align-items-center" style="margin-top: 0px">
                                                        <div class="col-lg-4">

                                                            <div class="btn-clean btn-sm btn-icon btn-icon-md"
                                                                 style="display: inline-block; position: relative;">
                                                                <i class="flaticon-comment"
                                                                   style="font-size: 1.2rem "></i>
                                                                <?php if ($rowCount != 0) { ?>
                                                                    <span class="kt-badge kt-badge--primary"
                                                                          style=" position: absolute;top: 2px;right: 6px; width:15px; height:15px ;opacity: 0.8"><?php echo $rowCount; ?></span>
                                                                <?php } ?>
                                                            </div>

                                                        </div>

                                                        <!--  Button End  -->
                                                        <div class="col-lg-8 kt-align-right">
                                                            <?php if ($task->trait_repeat == 'Y') { ?>
                                                                <span
                                                                    class="kt-badge kt-badge--success kt-badge--lg "
                                                                    style="  height: 28px; width: 28px;"><i
                                                                        class="flaticon2-circular-arrow "></i></span>
                                                            <?php }
                                                            if ($task->trait_contact == 'Y') { ?>
                                                                <span
                                                                    class="kt-badge kt-badge--success kt-badge--lg "
                                                                    style="background-color: #0079bf ;  height: 28px; width: 28px;"><i
                                                                        class="flaticon-speech-bubble-1"></i></span>
                                                            <?php }
                                                            if ($task->trait_uncertain == 'Y') { ?>
                                                                <span
                                                                    class="kt-badge kt-badge--warning kt-badge--lg "
                                                                    style="   height: 28px; width: 28px;"><b>?</b></span>
                                                            <?php }
                                                            if ($task->trait_important == 'Y') { ?>
                                                                <span
                                                                    class="kt-badge kt-badge--danger kt-badge--lg breath"
                                                                    style="   height: 28px; width: 28px;"><i
                                                                        class="flaticon2-attention"></i></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>


                                    <!--begin::Modal : Edit Task -->

                                    <div class="modal fade" id="kt_modala_<?php echo $task->id; ?>" role="dialog"
                                         aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                        <div id="taskid" value="<?php echo $task->id ?>"
                                             data-task-id="<?php echo $task->id ?>"
                                             data-url="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task->project_id]); ?>"
                                             data-project-id="<?php $task->project_id ?>"></div>
                                        <div class="modal-dialog modal-lg" style="margin-top: 50px" role="document">
                                            <?php $taskEdit = null ?>
                                            <?= $this->Form->create($taskEdit, ['enctype' => 'multipart/form-data', 'url' => ['controller' => 'Tasks', 'action' => 'edit', $task->id]]) ?>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                                                    <div class="right-align col-lg-6 col-md-6 col-sm-6">

                                                        <button type="button" class="btn btn-sm btn-secondary btn-custom"
                                                                id="delete_alert" data-task-id="
                                                       <?php echo $task->id ?>" style="margin-left: 5px">
                                                            Delete
                                                        </button>

                                                        <?php
                                                        $this->Form->setTemplates([
                                                            'button' => '<button{{attrs}}>{{text}}</button>'])
                                                        ?>
                                                    </div>
                                                    <div class="right-align col-lg-4 col-md-4 col-sm-4">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                            Cancel
                                                        </button>
                                                        <?= $this->Form->button('Submit ', [
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-success',
                                                            'escape' => false
                                                        ]);
                                                        ?>

                                                    </div>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true" class="la la-remove"></span>
                                                    </button>

                                                </div>

                                                <div class="modal-body">
                                                    <div class="kt-form">
                                                        <div class="form-group " style="margin : 3px">
                                                            <label class="col-form-label col-lg-3 col-sm-12"> Task
                                                                Trait </label>
                                                            <?php

                                                            echo $this->Form->control('trait_contact',
                                                                [
                                                                    'templates' => ['inputContainer' => '{{content}}'],
                                                                    'type' => 'checkbox',
                                                                    'value' => 'Y',
                                                                    'hiddenField' => 'N',
                                                                    'checked' => ($task->trait_contact == 'Y' ? true : false),
                                                                    'label' => [
                                                                        'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                        'text' => '     <span class="kt-badge kt-badge--success kt-badge--lg breath"
                                                      style="background-color: #0079bf ; margin: 10px ;margin-left: 15px"><i
                                                        class="flaticon-speech-bubble-1"></i></span> &nbsp; Contact &nbsp; ',
                                                                        'escape' => false
                                                                    ]
                                                                ]);
                                                            echo $this->Form->control('trait_repeat',
                                                                [
                                                                    'templates' => ['inputContainer' => '{{content}}'],
                                                                    'type' => 'checkbox',
                                                                    'value' => 'Y',
                                                                    'hiddenField' => 'N',
                                                                    'checked' => ($task->trait_repeat == 'Y' ? true : false),
                                                                    'label' => [
                                                                        'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                        'text' => '<span  style="margin: 10px; margin-left: 15px" class="kt-badge kt-badge--success kt-badge--lg breath"><i
                                                        class="flaticon2-circular-arrow "></i></span> &nbsp; Repeat &nbsp;&nbsp; ',
                                                                        'escape' => false
                                                                    ]
                                                                ]);
                                                            ?>
                                                        </div>
                                                        <div class="form-group" style="margin : 3px">
                                                            <label class="col-form-label col-lg-3 col-sm-12"> Task
                                                                Trait </label>
                                                            <?php
                                                            echo $this->Form->control('trait_important',
                                                                [
                                                                    'templates' => ['inputContainer' => '{{content}}'],
                                                                    'type' => 'checkbox',
                                                                    'value' => 'Y',
                                                                    'hiddenField' => 'N',
                                                                    'checked' => ($task->trait_important == 'Y' ? true : false),
                                                                    'label' => [
                                                                        'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                        'text' => '<span  style="margin: 10px ;margin-left: 15px" class="kt-badge kt-badge--danger kt-badge--lg fa-beat"><i
                                                        class="flaticon2-attention"></i></span> Important',
                                                                        'escape' => false
                                                                    ]
                                                                ]);
                                                            echo $this->Form->control('trait_uncertain',
                                                                [
                                                                    'templates' => ['inputContainer' => '{{content}}'],
                                                                    'type' => 'checkbox',
                                                                    'value' => 'Y',
                                                                    'hiddenField' => 'N',
                                                                    'class' => 'labe',
                                                                    'checked' => ($task->trait_uncertain == 'Y' ? true : false),
                                                                    'label' => [
                                                                        'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                        'text' => '<span style="margin: 10px ;margin-left: 15px"
                                                  class="kt-badge kt-badge--warning kt-badge--lg fa-beat"><b>?</b></span> Uncertain',
                                                                        'escape' => false
                                                                    ]
                                                                ]);
                                                            ?>
                                                        </div>
                                                        <div class="form-group row" style="margin : 3px">
                                                            <div class="col-lg-6">
                                                                <?php
                                                                $options = [NULL => '     '];
                                                                echo $this->Form->control('colour_id',
                                                                    [
                                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                                        'type' => 'select',
                                                                        'options' => $options + $card_types,
                                                                        'value' => $task->colour_id,
                                                                        'class' => 'form-control col-lg-8 col-md-9 col-sm-12',
                                                                        'label' => [
                                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                            'text' => 'Card Type'
                                                                        ]
                                                                    ]); ?>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <?php
                                                                $results = $conn
                                                                    ->execute('select * from talent_projects, talents where talent_projects.talent_id = talents.id and talent_projects.project_id = :id ', ['id' => $id]);
                                                                $talent_list = [];
                                                                foreach ($results as $talent) {
                                                                    $talent_list = $talent_list + [$talent['id'] => $talent['position'] . " - " . $talent['first_name'] . " " . $talent['last_name']];
                                                                }

                                                                $options = [NULL => '     '];
                                                                echo $this->Form->control('allocated_talent',
                                                                    [
                                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                                        'type' => 'select',
                                                                        'options' => $options + $talent_list,
                                                                        'value' => $task->allocated_talent,
                                                                        'class' => 'form-control col-lg-8 col-md-9 col-sm-12',
                                                                        'label' => [
                                                                            'class' => 'col-form-label col-lg-5 col-sm-12',
                                                                            'text' => 'Allocate Talents'
                                                                        ]
                                                                    ]); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" style="margin : 3px">
                                                            <div class="col-lg-6">
                                                                <?php echo $this->Form->control('task_name',
                                                                    [
                                                                        'value' => $task->task_name,
                                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                                        'maxlength' => '800',
                                                                        'class' => 'form-control col-lg-8 col-md-9 col-sm-12 edit_form',
                                                                        'label' => [
                                                                            'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                            'text' => 'Task Title'
                                                                        ]
                                                                    ]); ?>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <?php echo $this->Form->hidden('create_date', ['value' => $task->create_date]); ?>
                                                                <?php echo $this->Form->control('due_date', [
                                                                    'value' => date_format($task->due_date, 'd/m/Y h:i A'),
                                                                    'templates' => ['inputContainer' => '{{content}}'],
                                                                    'class' => 'input-group date form-control col-lg-8 col-md-9 col-sm-12 ',
                                                                    'type' => 'text',
                                                                    'id' => 'kt_datetimepicker_2', // this ID is fixed, using for Helper Datepicker !
                                                                    'label' => [
                                                                        'class' => 'col-form-label col-lg-5 col-sm-12',
                                                                        'text' => 'Task Due Date'
                                                                    ]
                                                                ]); ?>
                                                                <!--                                                    <div class="input-group-append">-->
                                                                <!--					                            	<span class="input-group-text">-->
                                                                <!--							                           <i class="la la-calendar"></i>-->
                                                                <!--						                            </span>-->
                                                                <!--                                                    </div>-->
                                                            </div>
                                                        </div>
                                                        <!--                                                <div-->
                                                        <!--                                      class="kt-form__seperator kt-form__seperator--dashed kt-form__seperator--space"></div>-->
                                                        <div class="form-group  " style="margin : 3px">
                                                            <div class="col-lg-12">
                                                                <?php echo $this->Form->control('description', [
                                                                    'value' => $task->description,
                                                                    'templates' => ['inputContainer' => '{{content}}'],
                                                                    'type' => 'textarea',
                                                                    'maxlength' => '4000',
                                                                    // Rich text section
                                                                    //'data-provide' => 'markdown',
                                                                    'row' => '5',
                                                                    'class' => 'form-control col-lg-10 col-md-10 col-sm-12',
                                                                    'label' => [
                                                                        'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                        'text' => 'Description'
                                                                    ]
                                                                ]); ?>
                                                            </div>

                                                            <div class="form-group row" style="margin : 5px">
                                                                <?php
                                                                $findme = 'webroot';
                                                                $mystring = $task->upload_path;
                                                                $pos2 = stripos($mystring, $findme);
                                                                $path = substr($mystring, $pos2);
                                                                $realpath = urldecode(str_replace("%5C", "/", urlencode($path)));
                                                                if (!empty($realpath) || $realpath != NULL) {
                                                                    ?>
                                                                    <div class="col-lg-6" id="hide">
                                                                        <label class="col-form-label"
                                                                               for="description">Uploaded
                                                                            Image</label>

                                                                        <?php
                                                                        echo $this->Html->image("/" . $realpath,
                                                                            ['style' => "max-width: 100%;display: block;max-height: 250px;width: auto;height: auto;",
                                                                                'templates' => ['inputContainer' => '{{content}}'],
                                                                                'label' => [
                                                                                    'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                                    'text' => 'Description']]);
                                                                        ?>
                                                                    </div>
                                                                    <div style="position: relative;">
                                                                        <a href="#" class="btn btn-danger"
                                                                           id="Delete_image"
                                                                           data-task-id="<?php echo $task->id; ?>"
                                                                           style="color:white !important;position: absolute;bottom: 0px;z-index: 10000;">
                                                                            Delete
                                                                        </a>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="col-lg-6">
                                                                    <label class="col-form-label" for="description"
                                                                           style="margin-top: 5px">Upload New
                                                                        Image</label>
                                                                    <?php
                                                                    echo $this->Form->control('upload', [
                                                                        'type' => 'file',
                                                                        'class' => 'custom-file-upload kt-dropzone dropzone dz-clickable',
                                                                        'style' => 'padding-top:60px'
                                                                    ]);
                                                                    ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <?php
                                                        echo $this->Form->hidden('project_id', ['value' => $task->project_id]);
                                                        echo $this->Form->hidden('status_id', ['value' => $task->status_id]);
                                                        echo $this->Form->hidden('label_id', ['value' => $task->label_id]);
                                                        ?>
                                                        <?= $this->Form->end() ?>

                                                    </div>
                                                    <!-- ADD Comments -->
                                                    <!--begin::Modal : View Comments -->
                                                    <hr class="hr2"/>

                                                    <!--begin::Accordion-->
                                                    <div class="accordion accordion-solid accordion-toggle-plus"
                                                         id="accordionExample6">
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne6">
                                                                <div class="card-title" data-toggle="collapse"
                                                                     data-target="#collapseOne6" aria-expanded="false"
                                                                     aria-controls="collapseOne6"
                                                                     style="color: #716aca !important;">
                                                                    <i class="flaticon-comment"
                                                                       style="font-size: 1.2rem "></i> Comments
                                                                </div>
                                                            </div>
                                                            <div id="collapseOne6" class="collapse"
                                                                 aria-labelledby="headingOne6"
                                                                 data-parent="#accordionExample6">
                                                                <div class="card-body">
                                                                    <?php $comment = null ?>
                                                                    <?= $this->Form->create($comment, ['url' => ['controller' => 'Comments', 'action' => 'add', $task->project_id]]) ?>

                                                                    <div class="kt-form" style="margin-top: 5px">
                                                                        <div class="modal-body">
                                                                            <?php echo $this->Form->hidden('comment_date', ['value' => date("Y-m-d H:i:s")]); ?>
                                                                            <div class="form-group row kt-margin-b-20">
                                                                                <?php echo $this->Form->control('comment_desc', [
                                                                                    'templates' => ['inputContainer' => '{{content}}'],
                                                                                    'type' => 'textarea',
                                                                                    'maxlength' => '800',
                                                                                    'rows' => '2',
                                                                                    'class' => 'form-control col-lg-6 col-md-7 col-sm-12',
                                                                                    'label' => [
                                                                                        'class' => 'col-form-label col-lg-2 col-sm-12',
                                                                                        'text' => 'Comments'
                                                                                    ]
                                                                                ]); ?>

                                                                                <?php echo $this->Form->hidden('task_id', ['value' => $task->id]); ?>
                                                                                <?php $this->Form->setTemplates(['button' => '<button{{attrs}}>{{text}}</button>']) ?>
                                                                                <?= $this->Form->postButton('Submit ',
                                                                                    ['controller' => 'Comments', 'action' => 'add', $task->project_id],
                                                                                    [
                                                                                        'class' => 'btn btn-brand btn-sm',
                                                                                        'style' => 'margin-left : 15px',
                                                                                        'id' => $task->project_id,
                                                                                        'escape' => false
                                                                                    ]);
                                                                                ?>
                                                                            </div>
                                                                            <?= $this->Form->end() ?>
                                                                            <?php
                                                                            $results = $conn
                                                                                ->newQuery()
                                                                                ->select('*')
                                                                                ->from('comments')
                                                                                ->where(['task_id' => $task->id])
                                                                                ->order(['comment_date' => 'DESC'])
                                                                                ->execute();
                                                                            $i = 0;
                                                                            foreach ($results as $row) {
                                                                                $i = $i + 1;
                                                                            }
                                                                            if ($i > 0) {
                                                                                ?>
                                                                                <div
                                                                                    class="form-group row kt-margin-b-20">
                                                                                    <label
                                                                                        class=" col-form-label col-lg-2 col-sm-12">
                                                                                        History </label>
                                                                                    <!--Begin::Portlet-->
                                                                                    <div class="" style="width:100%">
                                                                                        <div class="kt-scroll"
                                                                                             data-scroll="true"
                                                                                             data-height="420"
                                                                                             data-mobile-height="300">
                                                                                            <div
                                                                                                class="kt-timeline-v1 kt-timeline-v1--justified"
                                                                                                style="margin: 15px">
                                                                                                <div
                                                                                                    class="kt-timeline-v1__items">
                                                                                                    <div
                                                                                                        class="kt-timeline-v1__marker"></div>
                                                                                                    <?php foreach ($results as $row) { ?>
                                                                                                        <div
                                                                                                            class="kt-timeline-v1__item">
                                                                                                            <div
                                                                                                                class="kt-timeline-v1__item-circle">
                                                                                                                <div
                                                                                                                    class="kt-bg-danger"></div>
                                                                                                            </div>

                                                                                                            <span
                                                                                                                class="kt-timeline-v1__item-time kt-font-brand"
                                                                                                                style="right: 0;">
															<?php echo date_format((date_create_from_format('Y-m-d H:i:s', $row["comment_date"])), "d M Y H:i:s"); ?>
                                                                                                                <span></span>
														</span>
                                                                                                            <div
                                                                                                                class="kt-timeline-v1__item-content"
                                                                                                                style="padding: 1rem">
                                                                                                                <div
                                                                                                                    class="kt-timeline-v1__item-body">

                                                                                                                    <h6>
                                                                                                                        <?php echo $row["comment_desc"]; ?>
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="kt-timeline-v1__item-actions">
                                                                                                                    <a href="#"
                                                                                                                       class="btn btn-sm btn-clean btn-icon btn-icon-sm"
                                                                                                                       data-toggle="modal"
                                                                                                                       data-target="#kt_modaleditcomments_<?php echo $row["comment_id"]; ?>">
                                                                                                                        <i class="flaticon2-note"
                                                                                                                           data-toggle="kt-popover"
                                                                                                                           data-content="Edit Comment"
                                                                                                                           data-placement='bottom'></i>
                                                                                                                    </a>

                                                                                                                    <?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm"><i class="flaticon2-delete"></i></span>',
                                                                                                                        ['controller' => 'Comments', 'action' => 'delete', $row["comment_id"],$task->project_id],
                                                                                                                        ['escape' => false, 'data-toggle' => "kt-popover", 'data-content' => "Delete Comment", 'data-placement' => 'bottom', 'confirm' => 'Are you sure you wish to delete this comment?']) ?>

                                                                                                                    <!--begin::Modal : Edit Comments -->

                                                                                                                    <div
                                                                                                                        class="modal fade"
                                                                                                                        id="kt_modaleditcomments_<?php echo $row["comment_id"]; ?>"
                                                                                                                        class="kt_modal_<?php echo $row["comment_id"]; ?>"
                                                                                                                        role="dialog"
                                                                                                                        aria-labelledby="exampleModalLabel"
                                                                                                                        aria-hidden="true"
                                                                                                                        tabindex="-2">
                                                                                                                        <div
                                                                                                                            class="modal-dialog modal-md "
                                                                                                                            style="margin-top: 10%"
                                                                                                                            role="document">
                                                                                                                            <?php $comment = null ?>
                                                                                                                            <?= $this->Form->create($comment, ['url' => ['controller' => 'Comments', 'action' => 'edit', $row["comment_id"],$task->project_id]]) ?>

                                                                                                                            <div
                                                                                                                                class="modal-content">
                                                                                                                                <div
                                                                                                                                    class="modal-header">
                                                                                                                                    <h5 class="modal-title"
                                                                                                                                        id="exampleModalLabel">
                                                                                                                                        Comments</h5>
                                                                                                                                    <button
                                                                                                                                        type="button"
                                                                                                                                        class="close"
                                                                                                                                        data-dismiss="modal"
                                                                                                                                        aria-label="Close">
                                                                                                                <span
                                                                                                                    aria-hidden="true"
                                                                                                                    class="la la-remove"></span>
                                                                                                                                    </button>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="kt-form kt-form--fit kt-form--label-right">
                                                                                                                                    <div
                                                                                                                                        class="modal-body">
                                                                                                                                        <?php echo $this->Form->hidden('comment_date', ['value' => date("Y-m-d H:i:s")]); ?>
                                                                                                                                        <div
                                                                                                                                            class="form-group row kt-margin-b-20">
                                                                                                                                            <?php echo $this->Form->control('comment_desc', [
                                                                                                                                                'value' => $row["comment_desc"],
                                                                                                                                                'templates' => ['inputContainer' => '{{content}}'],
                                                                                                                                                'type' => 'textarea',
                                                                                                                                                'rows' => '5',
                                                                                                                                                'class' => 'form-control col-lg-6 col-md-7 col-sm-12',
                                                                                                                                                'label' => [
                                                                                                                                                    'class' => 'col-form-label col-lg-3 col-sm-12',
                                                                                                                                                    'text' => 'Comments'
                                                                                                                                                ]
                                                                                                                                            ]); ?>
                                                                                                                                        </div>
                                                                                                                                        <?php echo $this->Form->hidden('task_id', ['value' => $task->id]); ?>
                                                                                                                                    </div>
                                                                                                                                    <div
                                                                                                                                        class="modal-footer">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn btn-secondary"
                                                                                                                                            data-dismiss="modal">
                                                                                                                                            Cancel
                                                                                                                                        </button>
                                                                                                                                        <!--Button has not template in Cakephp, need to set a templates before change it -->
                                                                                                                                        <?php
                                                                                                                                        $this->Form->setTemplates([
                                                                                                                                            'button' => '<button{{attrs}}>{{text}}</button>'])
                                                                                                                                        ?>

                                                                                                                                        <?= $this->Form->postButton('Submit ',
                                                                                                                                            ['controller' => 'Comments', 'action' => 'edit', $row["comment_id"],$task->project_id],
                                                                                                                                            [
                                                                                                                                                'class' => 'btn btn-brand',
                                                                                                                                                'id' => $row["comment_id"],
                                                                                                                                                'escape' => false
                                                                                                                                            ]);
                                                                                                                                        ?>
                                                                                                                                        <?= $this->Form->end() ?>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <!--end::Modal-->
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    <?php }; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php }; ?>
                                                                        </div>
                                                                        <!--End::Portlet-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--end::Accordion-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Modal-->
                                    <?php
                                }
                            }
                            ?>
                        </ul>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?= $this->Html->css('trello-like.css') ?>
        <?= $this->Html->css('heartbeat.css') ?>
        <?= $this->Html->css('Breathing.css') ?>
        <?= $this->Html->script('https://code.jquery.com/jquery-1.12.4.js') ?>
        <?= $this->Html->script('base/scripts.bundle.js') ?>
        <?= $this->Html->script('app/custom/general/crud/forms/widgets/ion-range-slider.js') ?>
        <?= $this->Html->script('dropzone.js') ?>

        <style>
            #exampleSelectl-menu a:hover {
                color: black;
            }

            div.images {
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-top: 5px;
                margin-bottom: 0px;
            }

            .hr2 {
                border: 0;
                height: 3px;
                background-color: #787ac5;
                opacity: 0.5;
            }

            .irs--flat .irs-bar {
                background-color: #1dc9b7 !important;
            }

            /*.irs--flat .irs-handle > i:first-child {*/
            /*background-color: #0079bf!important;*/
            /*}*/
            /*.irs--flat .irs-handle.state_hover > i:first-child,*/
            /*.irs--flat .irs-handle:hover > i:first-child {*/
            /*background-color: #1dc9b7!important;*/
            /*}*/
            /*.irs--flat .irs-from,*/
            /*.irs--flat .irs-to,*/
            /*.irs--flat .irs-single {*/
            /*background-color: #1dc9b7!important;*/

            /*}*/
            /*.irs--flat .irs-from:before,*/
            /*.irs--flat .irs-to:before,*/
            /*.irs--flat .irs-single:before {*/
            /*background-color: #1dc9b7!important;*/
            /*}*/

        </style>

        <script>
            $(function () {
                $('ul[id^="sort"]').sortable({
                    connectWith: ".sortable",
                    receive: function (e, ui) {
                        var status_id = $(ui.item).parent(".sortable").data(
                            "status-id");
                        var task_id = $(ui.item).data("task-id");
                        $.ajax({
                            //url:"<?php //echo Router::url(array('controller' => 'Tasks' ,'action' => 'update_id',status_id,task_id , 'ext' =>'json'));?>//"

                            // IMPORTANT: Hard coded here for testing, need to change !!---------------|
                            // url: 'http://localhost:8080/IMS-project/tasks/updateId/' + task_id + '/' + status_id,
                            // ------------------------------------------------------------------------|

                            url: '<?php echo $this->Url->build([
                                "controller" => "Tasks",
                                "action" => "updateId"
                            ]);?>' + '/' + task_id + '/' + status_id,
                            type: 'GET',

                            success: function (url) {
                                // swal.fire({
                                //     position: 'top',
                                //     type: 'success',
                                //     title: 'Task Status Updated',
                                //     showConfirmButton: false,
                                //     timer: 1000
                                // });
                                // |---  Check OUTPUT of Status_id and Task_id --------------  |
                                // $("li").html("StatusId: " + status_id + "TaskId : " + task_id );
                                // alert(response);
                                // | -----------------------------------------------------|
                                $('[data-switch=true]').bootstrapSwitch();
                                var content = {};

                                content.message = 'Tasks Status updated';
                                content.icon = 'icon ' + 'la la-check';

                                var notify = $.notify(content, {
                                    type: 'success',
                                    allow_dismiss: true,
                                    newest_on_top: false,
                                    mouse_over: false,
                                    showProgressbar: false,
                                    spacing: 10,
                                    timer: 2000,
                                    placement: {
                                        from: 'top',
                                        align: 'right'
                                    },
                                    offset: {
                                        x: 30,
                                        y: 30
                                    },
                                    delay: 1000,
                                    z_index: 10000,
                                    animate: {
                                        enter: 'animated ' + 'flipInX',
                                        exit: 'animated ' + 'flipOutX'
                                    }
                                });
                            }
                        });
                    }
                }).disableSelection();
            });
        </script>


        <script>
            //Update Porject Progress
            $(function () {
                $('#Btn-progress').click(function () {
                    var num = $("#kt_slider_1").val();
                    var projectId = $("#kt_slider_1").data("project-id");
                    $.ajax({
                        url: '<?php echo $this->Url->build([
                            "controller" => "Projects",
                            "action" => "updateProgress"
                        ]);?>' + '/' + projectId + '/' + num,
                        type: 'GET',
                        success: function (data) {
                            swal.fire({
                                "title": "Project Progress Updated !",
                                "text": "The Progress has been successfully Updated !",
                                "type": "success",
                                "confirmButtonClass": "btn btn-success btn-elevate btn-pill btn-elevate-air"
                            });
                        }
                    });
                    // alert(num + projectId);
                })
            });

        </script>
        <script>
            //Reset Porject Progress
            $(function () {
                $('#Btn-reset').click(function () {
                    var projectId = $("#kt_slider_1").data("project-id");
                    $.ajax({
                        url: '<?php echo $this->Url->build([
                            "controller" => "Projects",
                            "action" => "resetProgress"
                        ]);?>' + '/' + projectId,
                        type: 'GET',
                        success: function (data) {
                            swal.fire({
                                "title": "Project Progress has been Reset !",
                                "text": "The Progress has been Reset !",
                                "type": "success",
                                "confirmButtonClass": "btn btn-success btn-elevate btn-pill btn-elevate-air"
                            });
                        }
                    });
                    // alert(num + projectId);
                })
            });

        </script>

        <script>
            $(function () {
                $('.fetch').click(function () {

                    var taskId = $(this).data('fetch');
                    $.ajax({
                        url: '<?php echo $this->Url->build([
                            'controller' => 'Tasks',
                            'action' => 'fetchCard'
                        ]) ?>' + '/' + taskId,
                        type: 'GET',
                        dataType: 'json',
                        data: {get_param: 'value'},
                        success: function (data) {
                            // for (var i=0;i<Object.values(data).length;++i)
                            // {
                            //     alert(Object.values(data)[i]);
                            //     $('#text1').html(Object.values(data)[i]);
                            // }

                            // alert(Object.values(data));
                            console.log(Object.values(data));
                            // $('input[name="task_name"]').val(Object.values(data)[1]);
                            // $(".edit_form").val(Object.values(data)[15]['status_name']);
                            //
                            // $('input[name="due_date"]').val(Object.values(data)[3]);

                            // $('textarea[name="description"]').val(Object.values(data)[4]);
                        }
                    });
                })
            });

        </script>
        <!-- Task Edit : Delete Button -->
        <script>
            $(function () {
                $(document).on("click", "#delete_alert", function () {
                    var taskId = $(this).data("task-id");
                    var url = $("#taskid").data("url");
                    swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function (result) {
                        if (result.value) {
                            $.ajax({
                                url: '<?php echo $this->Url->build([
                                    "controller" => "tasks",
                                    "action" => "delete"
                                ]);?>' + '/' + taskId,
                                type: 'GET',
                                success: function (data) {
                                    swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    );
                                    window.location.href = url;
                                }
                            });
                        }
                    });
                });
            });
        </script>

        <!-- Delete Image  -->
        <script>
            $(document).on("click", "#Delete_image", function () {
                // document.getElementById('hide').style.visibility ="hidden";
                var taskId = $(this).attr("data-task-id");
                $.ajax({
                    url: '<?php echo $this->Url->build([
                        'controller' => 'Tasks',
                        'action' => 'deleteImg'
                    ])?>' + '/' + taskId,
                    headers: {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                    async: false,
                    type: 'POST',

                    //hide contents if image has been deleted
                    success: function (data) {
                        $("#hide").remove();
                        $("#Delete_image").remove();
                    },
                    error: function () {
                    }
                })
            })
        </script>


<!--        <script>-->
<!--            $(function () {-->
<!--                $('#kt_datetimepicker_2, #kt_datetimepicker_2_validate').datetimepicker({-->
<!--                    todayHighlight: true,-->
<!--                    autoclose: true,-->
<!--                     pickerPosition: 'bottom-left',-->
<!--                     format: 'dd/mm/yyyy HH:ii P'-->
<!--                });-->
<!--            });-->
<!---->
<!--        </script>-->


        <script>
            $(document).on("click", ".deleteNoteButton", function () {
                var noteId = $(this).attr("data-note-id");
                $.ajax({
                    url: '<?php echo $this->Url->build([
                        'controller' => 'ClientNotes',
                        'action' => 'delete'
                    ])?>' + '/' + noteId,
                    type: 'POST'


                })
            })
        </script>
