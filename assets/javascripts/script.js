var base_url = "http://trackr.local/";

$(document).ready(function()
{
   // decimal places.
   
    
    
  // ajax to perform tv show search
  $('#books_search button').click(function (event){
	event.preventDefault();
	$('#process_results, #hidden_results').html('');
	console.log('Books search Called.');
	$.ajax({
	  type: 'POST',
	  url: base_url+'books/ajax_search',
	  dataType: 'html',
	  data: ({
		'title' : $('#search').val()
	  }),
	  success: function(data)
	  {
		$('#hidden_results').html(data);
		$('#hidden_results').show();
	  }
	})
  });

}); // document ready end here

// status toggle
function st (type, id, status)
{
  console.log('status_toggle Called.');

  if (type == 'company')
  {
	request_controller = 'companies';
	selector1 = $('#cst_'+id+'');
	selector2 = $('#cst_'+id+' i');
  //
  }

  if (type == 'user')
  {
	request_controller = 'users';
	selector1 = $('#ust_'+id+'');
	selector2 = $('#ust_'+id+' i');
  //
  }

  if (type == 'project')
  {
	request_controller = 'projects';
	selector1 = $('#pst_'+id+'');
	selector2 = $('#pst_'+id+' i');
  //
  }

  selector2.removeClass().addClass('icon-refresh icon-white');
  $.ajax({

	type: 'POST',
	url: base_url+request_controller+'/ajax_status',
	dataType: 'html',
	data: ({
	  'id' : id,
	  'status_active' : status
	}),
	success: function(data)
	{
	  if (data == 'Updated')
	  {
		selector1.removeAttr('href');
		selector2.removeClass().addClass('icon-ok icon-white');
	  }
	  else
	  {
		selector1.removeAttr('href').removeClass().addClass('btn btn-danger btn-mini');
		selector2.removeClass().addClass('icon-exclamation-sign icon-white');
	  }
	}
  })
}

function del(type, id)
{
  $('#delmodel_'+id).modal('hide');
  console.log('del Called.');

  if (type == 'company')
  {
	request_controller = 'companies';
	selector1 = $('#cdel_'+id+'');
	selector2 = $('#cdel_'+id+' i');
	selector3 = $('#row_'+id);
  //
  }

  if (type == 'user')
  {
	request_controller = 'users';
	selector1 = $('#udel_'+id+'');
	selector2 = $('#udel_'+id+' i');
	selector3 = $('#row_'+id);
  //
  }
  if (type == 'project')
  {
	request_controller = 'projects';
	selector1 = $('#pdel_'+id+'');
	selector2 = $('#pdel_'+id+' i');
	selector3 = $('#row_'+id);
  //
  }

  selector2.removeClass().addClass('icon-refresh icon-white');
  $.ajax({

	type: 'POST',
	url: base_url+request_controller+'/ajax_delete',
	dataType: 'html',
	data: ({
	  'id' : id
	}),
	success: function(data)
	{
	  if (data == 'Deleted')
	  {
		selector1.removeAttr('href');
		selector2.removeClass().addClass('icon-ok icon-white');
		selector3.removeClass().addClass('alert alert-error').hide('slow');
	  }
	  else
	  {
		selector1.removeAttr('href').removeClass().addClass('btn btn-danger btn-mini');
		selector2.removeClass().addClass('icon-exclamation-sign icon-white');
	  }
	}
  })
}

function genpass()
{
  var pwd = $.generateRandomPassword(8);
  $('#password').val(pwd);
}

function calcmulti(val1, val2, output)
{
  var item1 = $('#'+val1).val();
  var item2 = $('#'+val2).val();
  var total = (item1)*(item2);
  //console.log(total);
  $('#'+output).val('USD '+total);
}

function savehttask ()
{
  var data = $('#addhltask').serialize();
  var phase = $('#phase').val();

  console.log(data);

  $.ajax({
	type: 'POST',
	url: base_url+'hl_tasks/ajax_savehltask',
	dataType: 'html',
	data: ({
	  'data' : data
	}),
	success: function(data)
	{
	  //console.log(data);
	  if (data == 'Added')
		{
		  $('#addmodel').modal('hide');

		}
	}
  })
}

// jQuery Extends.
// -----------------------------------------------------------------------------


// Password creator.
(function($) {
  $.generateRandomPassword = function(limit) {
	limit = limit || 8;
	var password = '';
	var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@';
	var list = chars.split('');
	var len = list.length, i = 0;
	do {
	  i++;
	  var index = Math.floor(Math.random() * len);
	  password += list[index];
	} while(i < limit);
	return password;
  };
})(jQuery);