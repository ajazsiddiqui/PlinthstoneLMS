$(function () {
	$('.datepicker').datepicker({format: 'dd/mm/yyyy'});
});


	var clipboard = new Clipboard('.clipboard_btn');
		$('.form_script').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var modal = $(this)
			modal.find('#form_script').text('<script type="text/javascript" src="http://plinthstonerema.co.in/public/js/widget_script.js?p='+id+'"></script><div class="floating-form" id="contact_form"><div class="contact-opener"></div><div id="PlinthstoneLMS"></div></div>')
		});

$('#campaign_type').on('change',function(){
	val = $(this).val();
	if (val == 1){
	$('#projects').prop("disabled", false);
	}else{
	$('#projects').prop("disabled", true);
	}
})

function setcontactno(no){
		$('#smscontactno').val(no);
	};
	
	function setemailadd(add,id){
		$('#modalleadid').val(id);
		$('#modalemailadd').val(add);
	};

$(document).ready(function(){

	

	$('#confirmDelete').on('show.bs.modal', function (e) {
			 url = $(e.relatedTarget).attr('data-link');
			 // Pass form reference to modal for submission on yes/ok
			 var form = $(e.relatedTarget).closest('form');
			 $(this).find('.modal-footer #confirm').data('form', form);
	 });

	 $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
			 window.location.href = url;
	 });

	$('#confirmCall').on('show.bs.modal', function (e) {
			 token = $(e.relatedTarget).attr('data-token');
			 customer_number = $(e.relatedTarget).attr('data-number');
			 customer_cc = $(e.relatedTarget).attr('data-customer');
			 support_user_id = $(e.relatedTarget).attr('data-support');
			 var form = $(e.relatedTarget).closest('form');
			 $(this).find('.modal-footer #confirm').data('form', form);
	 });
 
	$('#confirmCall').find('.modal-footer #confirm').on('click', function(){
			   $.ajax({
		  url: 'https://developers.myoperator.co/clickOcall ',
		  type: 'post',
		  dataType: 'json',
		  data: {
			  'token':token,
			  'customer_number':customer_number,
			  'customer_cc':customer_cc,
			  'support_user_id':support_user_id,			  
		  },
		  error: {},
		  success: function(data) {

		  }
	  });
	});
 });
 
 Dropzone.options.crmUploader = {
  maxFilesize: 2, // MB
  acceptedFiles: "image/jpeg,image/png,image/gif,application/pdf"
};


$('#daterangepicker').daterangepicker({format: 'DD/MM/YYYY'});
$('#daterangepicker2').daterangepicker({format: 'DD/MM/YYYY'});
$('#daterangepicker3').daterangepicker({format: 'DD/MM/YYYY'});
$('#daterangepicker4').daterangepicker({format: 'DD/MM/YYYY'});
