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

$cakeDescription = 'Set My Brand Up';
?>
<!DOCTYPE html>
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
            active: function() {
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
    <?= $this->Html->css('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') ?>
    <!--begin::Global Theme Styles(used by all pages) -->
    <?= $this->Html->css('base/style.bundle.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="background-image: url(<?= $this->Url->image('bg.jpg') ?>)" class="kt-page--fluid kt-subheader--enabled kt-subheader--transparent kt-page--loading">
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  ">
    <div class="kt-header-mobile__logo">
        <a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>">
            <img alt="Logo" src="<?= $this->Url->image('SMBU_IMS.png') ?>" style=" height: 60px " class="kt-header__brand-logo-default" />
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
            <div class="kt-header__brand   kt-grid__item" id="kt_header_brand" style="text-align: center ; margin-left: 40%">
                <div class="kt-header__brand-logo">
                    <a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>">
                        <img alt="Logo" src="<?= $this->Url->image('SMBU_IMS.png') ?>" style=" height: 60px " class="kt-header__brand-logo-default" />
                    </a>
                </div>
            </div>
            <!-- end:: Brand -->


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

<!-- begin:: Add.ctp -->
<link href="http://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- end:: Add.ctp -->

            <!--begin::Fonts -->
            <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
            <script>
                WebFont.load({
                    google: {
                        "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
                    },
                    active: function() {
                        sessionStorage.fonts = true;
                    }
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
                            2019&nbsp;&copy;&nbsp;<a href="http://www.setmybrandup.com.au" target="_blank" class="kt-link">Set My Brand Up </a>.    By Monash IE Team 35
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
