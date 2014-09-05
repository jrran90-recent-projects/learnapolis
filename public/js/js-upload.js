$(function(){

	var list = $('<li class="list"><span></span><p style="font-size:12px"></p></li>');

	$("#file_uploader").fileupload({
		// test
		// url: '../upload.php',
		// dataType: 'json',
		// ------

		add: function (e, data) {

			// Append file name and file size
			list.find('p').text(data.files[0].name)
						  .append('<em>' + formatFileSize( data.files[0].size ) + '</em>')
			
			// Add the HTML to the UL element
			data.context = list.appendTo('ul#upload_file');

			// Automatically upload the file once it is added to the queue
			var jqXHR = data.submit();
		},

		progress: function (e, data) {

			// Calculate the completion percentage of the upload
			var progress = parseInt(data.loaded / data.total * 100, 10);

			// data.context.find('span').text(progress)

			$('#progress .progress-bar').css( 'width', progress + '%' );

			// if(progress == 100){
			// 	$('#progress .progress-bar').css( 'width', progress + '%' );
			// 	// data.context.removeClass('working');
			// }			
		}

	})



// Helper function that formats the file sizes
function formatFileSize(bytes)
{
	if ( typeof bytes !== 'number' ) {
		return '';
	}
	if (bytes >= 1000000000) {
		return (bytes / 1000000000).toFixed(2) + ' GB';
	}
	if (bytes >= 1000000) {
		return (bytes / 1000000).toFixed(2) + ' MB';
	}

	return (bytes / 1000).toFixed(2) + ' KB';
}




})