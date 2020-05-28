/*
 *
 * @package: Simple Web Corporative Portal
 * @version: 0.1
 * @authors: Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @created: 23/4/2011
 * @updated: 23/4/2011
 * @license: GPL v3
 * @require: JQuery >= 1.6
 *
 */
var ImgLoader = {
	init: function(imgPreView, frmLoader, serverUrl, inpSave, callback)
	{
		$("#"+imgPreView).on('click', function() {
			$("#"+frmLoader).click();		
		});
		
		function handleFileSelect(evt) {
			var formData = new FormData();
			var files = $("#"+frmLoader)[0].files[0]; //... var files = evt.target.files; 
			formData.append('file',files);
			$.ajax({
				url: serverUrl,
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					if(callback) callback(response);
					if (response != 0) {
						$("#"+imgPreView).attr("src", response);
						if(inpSave) $("#"+inpSave).attr("value", response);
					}
				}
			});
			return false;		
		}
		document.getElementById(frmLoader).addEventListener('change', handleFileSelect, false);
	}
};
/*
	<img   id="imgpv"  src="images/default-avatar.png">
	<input id="imgld"  style="display:none;" type="file" >
	<input id="imgs"   type="text" >

	initImgLoader("imgpv", "imgld", 'upload.php', "imgs");
*/