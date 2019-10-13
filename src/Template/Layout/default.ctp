<!DOCTYPE html>
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

use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\Core\Configure;

$conn = ConnectionManager::get('default');
$cakeDescription = 'Set My Brand Up';
?>

<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <!--begin::Fonts -->


    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->
    <?= $this->Html->meta(
        'favicon.ico',
        '/webroot/img/favicon.png',
        ['type' => 'icon']
    );
    ?>
    <!--begin::Page Vendors Styles(used by this page) -->
    <?= $this->Html->css('custom/fullcalendar/fullcalendar.bundle.css') ?>
    <!--end::Page Vendors Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <?= $this->Html->css('general/perfect-scrollbar/css/perfect-scrollbar.css') ?>
    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <?= $this->Html->css('general/tether/dist/css/tether.css') ?>
    <?= $this->Html->css('general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') ?>
    <?= $this->Html->css('general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') ?>
    <?= $this->Html->css('general/bootstrap-timepicker/css/bootstrap-timepicker.css') ?>
    <?= $this->Html->css('general/bootstrap-daterangepicker/daterangepicker.css') ?>
    <?= $this->Html->css('general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') ?>
    <?= $this->Html->css('general/bootstrap-select/dist/css/bootstrap-select.css') ?>
    <?= $this->Html->css('general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') ?>
    <?= $this->Html->css('general/select2/dist/css/select2.css') ?>
    <?= $this->Html->css('general/ion-rangeslider/css/ion.rangeSlider.css') ?>
    <?= $this->Html->css('general/nouislider/distribute/nouislider.css') ?>
    <?= $this->Html->css('general/owl.carousel/dist/assets/owl.carousel.css') ?>
    <?= $this->Html->css('general/owl.carousel/dist/assets/owl.theme.default.css') ?>
    <?= $this->Html->css('general/dropzone/dist/dropzone.css') ?>
    <?= $this->Html->css('general/summernote/dist/summernote.css') ?>
    <?= $this->Html->css('general/bootstrap-markdown/css/bootstrap-markdown.min.css') ?>
    <?= $this->Html->css('general/animate.css/animate.css') ?>
    <?= $this->Html->css('general/toastr/build/toastr.css') ?>
    <?= $this->Html->css('general/morris.js/morris.css') ?>
    <?= $this->Html->css('general/sweetalert2/dist/sweetalert2.css') ?>
    <?= $this->Html->css('general/socicon/css/socicon.css') ?>
    <?= $this->Html->css('custom/vendors/line-awesome/css/line-awesome.css') ?>
    <?= $this->Html->css('custom/vendors/flaticon/flaticon.css') ?>
    <?= $this->Html->css('custom/vendors/flaticon2/flaticon.css') ?>
    <?= $this->Html->css('custom/vendors/fontawesome5/css/all.min.css') ?>
    <?= $this->Html->css('wizard-v2.demo8.css') ?>
    <!--end:: Global Optional Vendors -->
    <!-- <? //= $this->Html->css('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') ?> -->
    <!--begin::Global Theme Styles(used by all pages) -->
    <?= $this->Html->css('base/style.bundle.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body style="background-image: url(<?= $this->Url->image('bg.jpg') ?>)"
      class="kt-page--fluid kt-subheader--enabled kt-subheader--transparent kt-page--loading">
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  ">
    <div class="kt-header-mobile__logo">
        <a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>">
            <img alt="Logo" src="<?= $this->Url->image('SMBU_IMS.png') ?>" style=" height: 60px "
                 class="kt-header__brand-logo-default"/>
        </a>
    </div>
    <!--    <div class="kt-header-mobile__toolbar">-->
    <!--        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>-->
    <!--        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>-->
    <!--    </div>-->
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">
            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  " data-ktheader-minimize="on">
                <div class="kt-header__top" style=" height: 80px ">
                    <div class="kt-container">

                        <!-- begin:: Brand -->
                        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand"
                             style="text-align: center ; margin-left: 40%">
                            <div class="kt-header__brand-logo">
                                <a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>">
                                    <img alt="Logo" src="<?= $this->Url->image('SMBU_IMS.png') ?>"
                                         style=" height: 60px " class="kt-header__brand-logo-default"/>
                                </a>
                            </div>
                        </div>
                        <!-- end:: Brand -->

                        <!-- begin:: Header Topbar -->

                        <div class="kt-header__topbar">
                            <?php
                            $talent_id = $this->Session->read('Auth.User.talent_id');
                            $results = $conn->execute('select * from tasks order by create_date');
                            $mentions = $conn->execute('select * from mentions where mentions.talent_id = :id  Order by mention_date desc ', ['id' => $talent_id]);
                            $count = 0;
                            foreach ($results as $task) {
                                $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
                                $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                $datediff = date_diff($sys_date, $due_date);
                            if($task["status_id"] !=4) {
                                if ($datediff->days < 10) {
                                    $count = $count + 1 ?><?php
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
                            }
                            foreach ($mentions as $mention) {
                                $count = $count + 1;
                            }
                            ?>
                            <!--begin: Notifications -->
                            <div class="kt-header__topbar-item dropdown">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,10px">
											<span class="kt-header__topbar-icon">
												<i class="flaticon2-bell-alarm-symbol"></i>
												<span class="kt-badge kt-badge--success kt-hidden"></span>
											</span>
                                    <span class="kt-badge count_num kt-badge--danger"
                                          style=" position: absolute;top: -5px;right: -5px; width:24px; height:24px ;opacity: 0.9 ; font-weight: 500;font-size: 15px"> <?php echo $count; ?></span>

                                </div>
                                <div
                                    class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                    <form>

                                        <!--begin: Head -->
                                        <div class="kt-head kt-head--skin-light kt-head--fit-x"
                                             style="padding-bottom: 0px">
                                            <h3 class="kt-head__title" style="text-align: center">
                                                User Notifications
                                                <span
                                                    class="btn btn-label-primary btn-sm btn-bold btn-font-md"><?php echo $count ?>
                                                    new </span>
                                            </h3>
                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                                                <li class="nav-item"></li>
                                                <li class="nav-item"></li>
                                                <li class="nav-item"></li>
                                                <li class="nav-item"></li>
                                                <li class="nav-item"></li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="delete_mentions" data-project-id="<?php echo $talent_id ?>"
                                                       data-url="<?php echo $this->Url->build(["controller" => "mentions", "action" => "delete", $talent_id]); ?>">Clear @Mention Message</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--end: Head -->
                                        <div class="tab-content-2" id="notification">
                                            <div class="tab-pane active show" id="topbar_notifications_notifications"
                                                 role="tabpanel">
                                                <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll"
                                                     data-scroll="true"
                                                     data-height="300" data-mobile-height="200">
                                                    <?php
                                                    $mentions = $conn->execute('select * from mentions where mentions.talent_id = :id  Order by mention_date desc ', ['id' => $talent_id]);
                                                    foreach ($mentions as $mention) {
                                                        $due_date = date_create_from_format('Y-m-d H:i:s', $mention['mention_date']);
                                                        $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                                        $datediff = date_diff($due_date, $sys_date);
                                                        ?>
                                                        <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $mention['project_id'], 'task' => $mention['task_id']]); ?>"
                                                           class="kt-notification__item metion-noti">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-hangouts-logo kt-font-success"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    You has been Mentioned @ in task:
                                                                    <b> <?php echo $mention["task_name"]; ?> </b> !
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    <?php echo $datediff->days ?> Days ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <?php
                                                    }

                                                    foreach ($results as $task) {
                                                        $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
                                                        $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                                        $datediff = date_diff($sys_date, $due_date);
                                                        if($task["status_id"] !=4) {
                                                            if ($datediff->days < 10) {
                                                                ?>
                                                                <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id'], 'task' => $task['id']]); ?>"
                                                                   class="kt-notification__item">
                                                                    <div class="kt-notification__item-icon">
                                                                        <i class="flaticon2-time kt-font-danger"></i>
                                                                    </div>
                                                                    <div class="kt-notification__item-details">
                                                                        <div class="kt-notification__item-title">
                                                                            Task:
                                                                            <b> <?php echo $task["task_name"] ?> </b>
                                                                            is coming to the due
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
                                                                        <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id'] ,'task' => $task['id']]); ?>"
                                                                           class="kt-notification__item">
                                                                            <div class="kt-notification__item-icon">
                                                                                <i class="flaticon-alert-2 kt-font-warning"></i>
                                                                            </div>
                                                                            <div class="kt-notification__item-details">
                                                                                <div
                                                                                    class="kt-notification__item-title">
                                                                                    Task:
                                                                                    <b> <?php echo $task["task_name"] ?> </b>
                                                                                    needs to be
                                                                                    followed up !
                                                                                </div>
                                                                                <div class="kt-notification__item-time">
                                                                                    <?php echo $datediff->days ?> Days
                                                                                    passed
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <?php
                                                                    }
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
                                    <span class="kt-header__topbar-username kt-visible-desktop"
                                          style="font-size: 16px"><?php echo $this->Session->read('Auth.User.username') ?>
                                        ! </span>
                                    <span
                                        class="kt-header__topbar-icon kt-bg-brand kt-font-lg kt-font-bold kt-font-light kt-hidden">S</span>
                                    <span class="kt-header__topbar-icon kt-hidden"><i
                                            class="flaticon2-user-outline-symbol"></i></span>
                                </div>
                                <div
                                    class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                    <!--begin: Head -->
                                    <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                        <div class="kt-user-card__avatar">
                                            <!--                    <img class="kt-hidden-" alt="Pic" src="../assets/media/users/300_25.jpg"/>-->

                                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                            <span
                                                class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                                        </div>
                                        <div class="kt-user-card__name">
                                            <?php echo $this->Session->read('Auth.User.role') . ":  " . $this->Session->read('Auth.User.username') ?>
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

            <?= $this->fetch('content') ?>

            <!-- begin::Global Config(global config for global JS sciprts) -->
            <script>
                var KTAppOptions = {
                    "colors": {
                        "state": {
                            "brand": "#716aca",
                            "light": "#ffffff",
                            "dark": "#282a3c",
                            "primary": "#5867dd",
                            "success": "#34bfa3",
                            "info": "#36a3f7",
                            "warning": "#ffb822",
                            "danger": "#fd3995"
                        },
                        "base": {
                            "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                            "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                        }
                    }
                };
            </script>
            <!-- end::Global Config -->


            <!--begin:: Global Mandatory Vendors -->
            <?= $this->Html->script('https://code.jquery.com/jquery-1.12.4.js') ?>
            <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js') ?>
            <?= $this->Html->script('base/scripts.bundle.js') ?>


            <?= $this->Html->script('general/jquery/dist/jquery.js') ?>
            <?= $this->Html->script('general/popper.js/dist/umd/popper.js') ?>
            <?= $this->Html->script('general/bootstrap/dist/js/bootstrap.min.js') ?>
            <?= $this->Html->script('general/js-cookie/src/js.cookie.js') ?>
            <?= $this->Html->script('general/moment/min/moment.min.js') ?>
            <?= $this->Html->script('general/tooltip.js/dist/umd/tooltip.min.js') ?>
            <?= $this->Html->script('general/perfect-scrollbar/dist/perfect-scrollbar.js') ?>
            <?= $this->Html->script('general/sticky-js/dist/sticky.min.js') ?>
            <?= $this->Html->script('general/wnumb/wNumb.js') ?>
            <!--end:: Global Mandatory Vendors -->

            <!--begin:: Global Optional Vendors -->
            <?= $this->Html->script('general/jquery-form/dist/jquery.form.min.js') ?>
            <?= $this->Html->script('general/block-ui/jquery.blockUI.js') ?>
            <?= $this->Html->script('general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>
            <?= $this->Html->script('custom/components/vendors/bootstrap-datepicker/init.js') ?>
            <?= $this->Html->script('general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') ?>
            <?= $this->Html->script('general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') ?>
            <?= $this->Html->script('custom/components/vendors/bootstrap-timepicker/init.js') ?>
            <?= $this->Html->script('general/bootstrap-daterangepicker/daterangepicker.js') ?>
            <?= $this->Html->script('general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') ?>
            <?= $this->Html->script('general/bootstrap-maxlength/src/bootstrap-maxlength.js') ?>
            <?= $this->Html->script('custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') ?>
            <?= $this->Html->script('general/bootstrap-select/dist/js/bootstrap-select.js') ?>
            <?= $this->Html->script('general/bootstrap-switch/dist/js/bootstrap-switch.js') ?>
            <?= $this->Html->script('custom/components/vendors/bootstrap-switch/init.js') ?>
            <?= $this->Html->script('general/select2/dist/js/select2.full.js') ?>
            <?= $this->Html->script('general/ion-rangeslider/js/ion.rangeSlider.js') ?>
            <?= $this->Html->script('general/typeahead.js/dist/typeahead.bundle.js') ?>
            <?= $this->Html->script('general/handlebars/dist/handlebars.js') ?>
            <?= $this->Html->script('general/inputmask/dist/jquery.inputmask.bundle.js') ?>
            <?= $this->Html->script('general/inputmask/dist/inputmask/inputmask.date.extensions.js') ?>
            <?= $this->Html->script('general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') ?>
            <?= $this->Html->script('general/nouislider/distribute/nouislider.js') ?>
            <?= $this->Html->script('general/owl.carousel/dist/owl.carousel.js') ?>
            <?= $this->Html->script('general/autosize/dist/autosize.js') ?>
            <?= $this->Html->script('general/clipboard/dist/clipboard.min.js') ?>
            <?= $this->Html->script('general/dropzone/dist/dropzone.js') ?>
            <?= $this->Html->script('general/summernote/dist/summernote.js') ?>
            <?= $this->Html->script('general/markdown/lib/markdown.js') ?>
            <?= $this->Html->script('general/bootstrap-markdown/js/bootstrap-markdown.js') ?>
            <?= $this->Html->script('custom/components/vendors/bootstrap-markdown/init.js') ?>
            <?= $this->Html->script('general/bootstrap-notify/bootstrap-notify.min.js') ?>
            <?= $this->Html->script('custom/components/vendors/bootstrap-notify/init.js') ?>
            <?= $this->Html->script('general/jquery-validation/dist/jquery.validate.js') ?>
            <?= $this->Html->script('general/jquery-validation/dist/additional-methods.js') ?>
            <?= $this->Html->script('custom/components/vendors/jquery-validation/init.js') ?>
            <?= $this->Html->script('general/toastr/build/toastr.min.js') ?>
            <?= $this->Html->script('general/raphael/raphael.js') ?>
            <?= $this->Html->script('general/morris.js/morris.js') ?>
            <?= $this->Html->script('general/chart.js/dist/Chart.bundle.js') ?>
            <?= $this->Html->script('custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') ?>
            <?= $this->Html->script('custom/vendors/jquery-idletimer/idle-timer.min.js') ?>
            <?= $this->Html->script('general/waypoints/lib/jquery.waypoints.js') ?>
            <?= $this->Html->script('general/counterup/jquery.counterup.js') ?>
            <?= $this->Html->script('general/es6-promise-polyfill/promise.min.js') ?>
            <?= $this->Html->script('general/sweetalert2/dist/sweetalert2.min.js') ?>
            <?= $this->Html->script('custom/components/vendors/sweetalert2/init.js') ?>
            <?= $this->Html->script('general/jquery.repeater/src/lib.js') ?>
            <?= $this->Html->script('general/jquery.repeater/src/jquery.input.js') ?>
            <?= $this->Html->script('general/jquery.repeater/src/repeater.js') ?>
            <?= $this->Html->script('general/dompurify/dist/purify.js') ?>
            <!--end:: Global Optional Vendors -->

            <!--begin::Global Theme Bundle(used by all pages) -->
            <?= $this->Html->script('app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') ?>
            <?= $this->Html->script('app/custom/general/crud/forms/widgets/bootstrap-datetimepicker.js') ?>
            <?= $this->Html->script('jQuery_UI.js') ?>

            <?= $this->Html->script('base/scripts.bundle.js') ?>
            <?= $this->Html->script('app/custom/general/components/portlets/draggable.js') ?>
            <!--end::Global Theme Bundle -->

            <!--begin::Page Vendors(used by this page) -->
            <?= $this->Html->script('custom/fullcalendar/fullcalendar.bundle.js') ?>
            <?= $this->Html->script('custom/gmaps/gmaps.js') ?>
            <!--end::Page Vendors -->

            <!--begin::Page Scripts(used by this page) -->
            <?= $this->Html->script('app/custom/general/dashboard.js') ?>
            <!--end::Page Scripts -->

            <!--begin::Global App Bundle(used by all pages) -->
            <?= $this->Html->script('app/bundle/app.bundle.js') ?>

            <!--begin::Mention function lib -->
            <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js') ?>
            <?= $this->Html->script('jquery.events.input.js') ?>
            <?= $this->Html->script('jquery.elastic.js') ?>
            <?= $this->Html->script('jquery.mentionsInput.js') ?>

            <!-- begin:: Add.ctp -->
            <link href="http://harvesthq.github.io/chosen/chosen.css" rel="stylesheet"/>
            <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
            <!-- end:: Add.ctp -->

            <!--begin::Fonts -->
            <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
            <script>
                WebFont.load({
                    google: {
                        "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
                    },
                    active: function () {
                        sessionStorage.fonts = true;
                    }
                });
            </script>

            <?= $this->fetch('script') ?>
            <script>
                $(document).ready(function () {
                    $(function () {
                        $(document).on("click", "#delete_mentions", function () {
                            var url = $(this).data("url");
                            var projectId = $(this).data("project-id");
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
                                            "controller" => "mentions",
                                            "action" => "delete"
                                        ]);?>' + '/' + projectId,
                                        type: 'GET',
                                        success: function (data) {
                                            swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success'
                                            );
                                            $(".metion-noti").remove();
                                            // $('.count_num').html($('.kt-notification .kt-notification__item').length)
                                        }
                                    });
                                }
                            });
                        });
                    });
                });

            </script>
        </div>
    </div>

</div>
<!-- begin:: Footer -->
<div class="kt-footer kt-grid__item" id="kt_footer">
    <div class="kt-container">
        <div class="kt-footer__wrapper">
            <div class="kt-footer__copyright">
                2019&nbsp;&copy;&nbsp;<a href="http://www.setmybrandup.com.au" target="_blank" class="kt-link">Set My
                    Brand Up </a>. By Monash IE Team 35
            </div>
            <div class="kt-footer__menu">
                <a href="" target="_blank" class="kt-link">About</a>
                <a href="" target="_blank" class="kt-link">Team</a>
                <a href="" target="_blank" class="kt-link">Contact</a>
            </div>
        </div>
    </div>
</div>

<!-- end:: Footer -->
<footer>
</footer>

</body>

</html>
