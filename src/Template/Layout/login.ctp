<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Metronic | Login Page v2</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <?= $this->Html->css('login-v2.default.css') ?>


    <!--end::Page Custom Styles -->

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

    <!--begin::Global Theme Styles(used by all pages) -->
    <!--begin::Global Theme Styles(used by all pages) -->
    <?= $this->Html->css('base/style.bundle.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
     <link rel="shortcut icon" href="../assets/media/logos/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<?= $this->fetch('content') ?>


<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
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
<?= $this->Html->script('base/scripts.bundle.js') ?>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<?= $this->Html->script('app/custom/login/login-general.js') ?>

<!--end::Page Scripts -->

<!--begin::Global App Bundle(used by all pages) -->
<?= $this->Html->script('app/bundle/app.bundle.js') ?>

<!--end::Global App Bundle -->
</body>

<!-- end::Body -->
</html>
