function Textreduce(){
	
}
 var previewimage = function(event) {
    var output = document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
 };