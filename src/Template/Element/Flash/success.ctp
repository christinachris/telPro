<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message success" onclick="this.classList.add('hidden')">--><?//= $message ?><!--</div>-->
<!--<div class="alert alert-success fade show" role="alert"  onclick="this.classList.add('hidden')"> <div class="alert-text"> <strong>Success!</strong> --><?//= h($message) ?><!-- </div></div>-->
<div class="row">
<div class="col-5">
<div class="alert alert-success fade show" id="successMessage" style="margin-left: 30px  ; font-size: 15px ; background-color: #a7ceca; background: rgba(29, 201, 183, 0.1);
    border-color: transparent;" role="alert">
    <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
    <div class="alert-text" style="color: #1dc9b7 ;font-weight: 500 ">Success !<?= ' '. h($message) ?> </div>
    <div class="alert-close" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close" style="color: #1dc9b7 ;font-weight: 500"></i></span>
        </button>
    </div>
</div>
</div>
</div>
<script>
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 5000);
</script>
