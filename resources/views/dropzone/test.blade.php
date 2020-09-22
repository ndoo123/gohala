<html>
<head>
<meta charset="utf-8">
<title> How to make dropzone sortable. </title>
{{-- <link href="{{ css/dropzone.css }}" type="text/css" rel="stylesheet" /> --}}
{{-- <link rel="stylesheet" href="{{ url('assets/js/plugins/dropzone/dist/dropzone.css') }}"> --}}
<link rel="stylesheet" href="https://www.dropzonejs.com/css/dropzone.css">
<style>
.dropzone .dz-preview:hover .dz-image img {
  -webkit-transform: scale(1.05, 1.05);
  -moz-transform: scale(1.05, 1.05);
  -ms-transform: scale(1.05, 1.05);
  -o-transform: scale(1.05, 1.05);
  transform: scale(1.05, 1.05);
  -webkit-filter: blur(0px);
  filter: blur(0px); 
}
</style>
</head>
<body>
    <center> <h3 >Dropzone Sortable Demo</h3> </center>        
    <!-- IMPORTANT enctype attribute! -->
    <form class="dropzone" action="/action-which-you-want/" method="post" enctype="multipart/form-data" style="border:1px solid #000;">
     
    </form>
    <br>
    <center> <button id="submit-all" style="height: 40px;"> Upload All the files </button> &emsp; <button id="remove-all" style="height: 40px;"> Remove All files </button> </center>
     <input type="hidden" id="dropzone_url">
    {{-- <script src="{{ url('assets/js/plugins/dropzone/dist/dropzone.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/manage/login/js/jquery.min.js') }}"></script> --}}

    <script src="https://www.dropzonejs.com/js/dropzone.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="js/dropzone.js"></script> --}}
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
            $(function(){
                $(".dropzone").sortable({
                    items:'.dz-preview', // item move by this
                    cursor: 'move',
                    opacity: 0.5,
                    containment: '.dropzone',
                    distance: 20,
                    tolerance: 'pointer'
                });
            });
          var dropzoneOptions = {
           // Prevents Dropzone from uploading dropped files immediately
                url: "/file/post",
                addRemoveLinks: true, // ปุ่มลบรูป
                autoProcessQueue : false, // progress ให้รันไฟล์สู่ php เลยไหม
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                maxFiles: 5,
                parallelUploads: 5, //อัพโหลดทีละเท่าไหร่
                uploadMultiple: true,
                init : function() {
                    var removeButton = document.querySelector("#remove-all")
                    var submitButton = document.querySelector("#submit-all")
                    myDropzone = this;
                    // removeButton.addEventListener('hidden.bs.modal',function(){

                    // });
                    removeButton.addEventListener('click', function(e){
                        // alert(113);
                        myDropzone.removeAllFiles();
                    });
                    submitButton.addEventListener("click", function(e) {

                        console.log(2 + ' start submit');
                        e.preventDefault();
                        e.stopPropagation();
                        // console.log(this); // button
                        // console.log(myDropzone); // dropzone
                        // console.log(myDropzone.files);
                        // console.log(myDropzone.files.length); // file length
                        $("#dropzone_url").val('asdf');
                        myDropzone.processQueue();
                        console.log(2 + ' end submit');
                        
                        // addRemoveLinks = true;
                    }); 

                    this.on("processing", function(file) {
                        console.log(3 + ' start processing');
                        this.options.url = $("#dropzone_url").val();
                        // this.options.url = "/some-other-url";
                        console.log(3 + ' end processing');
                    });
                   // to handle the added file event
                    this.on("addedfile", function(file) { // per one file
                        console.log(1 + ' start addedfile');

                        var _this = this;
                        if ($.inArray(file.type, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']) == -1) {
                            _this.removeFile(file);
                        }

                        console.log(1 + ' end addedfile');
                    });
                    this.on("sending", function (file, xhr, formData) {
                        console.log(4 + ' start sending');
                        console.log(4 + ' end sending');
                    });
                    this.on("complete",function(file){
                        console.log(5 + ' start complete');
                        $(file._removeLink).fadeOut();
                        console.log(5 + ' end complete');
                    });
                },
            };
            var uploader = document.querySelector('form.dropzone');
            var newDropzone = new Dropzone(uploader, dropzoneOptions);
            // $(document).on('click','#remove-all',function(e){
            //     console.log(document.getElementsByClassName("dropzone"));
            //     console.log(document.getElementsByClassName("dropzone").removeAllFiles(true));
            //     // $(".dropzone").removeAllFiles(true);
            //     // removeFile(file);
            // });
   </script>
</body>
</html>