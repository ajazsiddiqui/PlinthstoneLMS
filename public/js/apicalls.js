//API CALLS
  $('#state').change(function() {
      state = $("#state option:selected").val();
      $.ajax({
          url: 'https://plinthstonerema.co.in/public/api/cities/'+state,
          type: 'GET',
          dataType: 'json',
          error: {},
          success: function(data) {
              $('#city')
                  .find('option')
                  .remove()
                  .end();
              $('#city').append($("<option></option>").attr("value", '0').text('Select'));
              $.each(data, function(key, value) {
                  $('#city')
                      .append($("<option></option>")
                          .attr("value", key)
                          .text(value));
              });
          }
      });
  });

  $('#smstemplate').change(function(){
	  id = $(this).val();
	  $.ajax({
		  url: 'https://plinthstonerema.co.in/public/api/smstemplates/'+ id,
		  type: 'GET',
		  dataType: 'json',
		  error:{},
		  success: function (data){
			  $.each(data, function(key, value){
					$('#message').val(value);
				});			  
		  }
	  })
	});

  $('#emailtemplate').change(function(){
	  id = $(this).val();
	  $.ajax({
		  url: 'https://plinthstonerema.co.in/public/api/emailtemplates/'+id,
		  type: 'GET',
		  dataType: 'json',
		  error:{},
		  success: function (data){
			  $.each(data, function(key, value){
				  myEditor.setData(value);
				});			  
		  }
	  })
	});
