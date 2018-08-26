
// Ajax post
$(document).ready(function() {

	//code to process issue
	$(document).on("click", ".issue", function(){

		var $this = $(this);
		var book_id = $this.attr('id');
		$.ajax({
			type: "POST",
			url: baseurl + "index.php/issue_book",
			dataType: 'json',
			data: {book_id: book_id},
			success: function(res) {
				if (res) {
					var res = JSON.parse(res);
					if (1 == res.success) { // if success
						$("#success_msg").text('Book Issued Successully !').css( "color", "green" ).show().delay(5000).fadeOut();
					} else { // if error
						$("#error_msg").text('Book Issue Failed !').css( "color", "red" ).show().delay(5000).fadeOut();
						return false;
					}
					// turn button to retrn after success
					$this.removeClass('issue').addClass('return');
					$this.text('Return Book');
				}
			}
		});
	});

	//code to process return
	$(document).on("click", ".return", function(){
		
		var $this = $(this);
		var book_id = $this.attr('id');
		
		$.ajax({
			type: "POST",
			url: baseurl + "index.php/return_book",
			dataType: 'json',
			data: {book_id: book_id},
			success: function(res) {
				var res = JSON.parse(res);
				if (1 == res.success) { // if success
					$("#success_msg").text('Book Returned Successully !').css( "color", "green" ).show().delay(5000).fadeOut();
				} else { // if error
					$("#error_msg").text('Book Return Failed !').css( "color", "red" ).show().delay(5000).fadeOut();
					return false;
				}

				// turn button to issue after success
				$this.removeClass('return').addClass('issue');
				$this.text('Issue Book');

			}
		});

	});

	// code to search book in library
	$(document).on("click", ".search", function(){

		$.ajax({
			type: "POST",
			url: baseurl + "index.php/search_book",
			dataType: 'json',
			data: {book_name: $('.book_name').val()},
			success: function(res) {
				var res = JSON.parse(res);
				//show returned books html
				$('#book_details').html(res.message);

			}

		});
	});

});
