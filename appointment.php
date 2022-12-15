<!DOCTYPE html>
<html>
<body> 



<div class="modal-header bg-theme-colored">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title text-white" id="myModalLabel">Appointment Form</h4>
</div>
<div class="p-40">
  <!-- Booking Form Starts -->
  <form target="_blank" action="https://formsubmit.co/niclip44@ou.edu" method="POST">
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group mb-10">
          <input name="form_name" class="form-control" type="text" required="" placeholder="Enter Name" aria-required="true">
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group mb-10">
          <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email" aria-required="true">
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group mb-10">
          <input name="form_appontment_date" class="form-control required date-picker" type="text" placeholder="Appoinment Date" aria-required="true">
        </div>
      </div>
    </div>
    <div class="form-group mb-10">
      <textarea name="form_message" class="form-control required"  placeholder="Enter Message" rows="3" aria-required="true"></textarea>
    </div>
    <div class="form-group mb-0 mt-20">
      <input name="form_botcheck" class="form-control" type="hidden" value="">
      <button type="submit" class="btn btn-dark btn-theme-colored" data-loading-text="Please wait...">Send Message</button>
    </div>
  </form>

  <!-- Booking Form Validation-->
  <script type="text/javascript">
    $("#appointment_form_popup").validate({
      submitHandler: function(form) {
        var form_btn = $(form).find('button[type="submit"]');
        var form_result_div = '#form-result';
        $(form_result_div).remove();
        form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
        var form_btn_old_msg = form_btn.html();
        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
        $(form).ajaxSubmit({
          dataType:  'json',
          success: function(data) {
            if( data.status == 'true' ) {
              $(form).find('.form-control').val('');
            }
            form_btn.prop('disabled', false).html(form_btn_old_msg);
            $(form_result_div).html(data.message).fadeIn('slow');
            setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
          }
        });
      }
    });
  </script>
  <!-- Booking Form Ends -->
</div>
<div class="modal-footer">
</div>
<!-- Footer Scripts -->
<script>
  //reload date and time picker
  THEMEMASCOT.initialize.TM_datePicker();
</script>

  
    </body>
</html>
