/*
 *
 * @package: Simple Web Corporative Portal
 * @version: 0.1
 * @authors: Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @created: 23/4/2011
 * @updated: 23/4/2011
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 *
 */
var newEditor = function(selector, height){
	tinymce.init({
		height: height,
		mode : "textareas",
		selector : selector,
		plugins:[
			"image", "fullscreen", "searchreplace", "table" , "link",
			" advlist anchor autolink codesample  help image imagetools ",
			" lists link media noneditable ",
			" template visualblocks wordcount"
		],
		toolbar: " insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image myin",
		
		images_upload_url : Bycod.router.action("news/upload"),
		automatic_uploads : false,
		images_upload_handler : function(blobInfo, success, failure) {
			var xhr, formData;
			xhr = new XMLHttpRequest();
			xhr.withCredentials = false;
			xhr.open('POST', Bycod.router.action("news/upload"));
			xhr.onload = function() {
				var json;
				if (xhr.status != 200) {
					failure('HTTP Error: ' + xhr.status);
					return;
				}
				json = JSON.parse(xhr.responseText);
				if (!json || typeof json.file_path != 'string') {
					failure('Invalid JSON: ' + xhr.responseText);
					return;
				}
				success(json.file_path);
			};
			formData = new FormData();
			formData.append('file', blobInfo.blob(), blobInfo.filename());
			xhr.send(formData);
		}
	});
}
$('#btnSave').on( 'click', (event) => {
	event.preventDefault(); // avoid to execute the actual submit of the form.	

	var form = $("#frmNews");
	$.ajax({
		"type": form.attr("method"),
		"url": form.attr('action'),
		"data": form.serialize(), // serializes the form's elements.
		"success": function(data)
		{
			alert(data); // show response from the php script.
		}
	});	
});

//.............................................................................. 
newEditor('#sumary', 200);
newEditor('#description', 800);
//.............................................................................. 
ImgLoader.init("imgico", "imgicoF", Bycod.router.action("news/upload"),"imgicoS");
ImgLoader.init("imgfront", "imgfrontF", Bycod.router.action("news/upload"),"imgfrontS");