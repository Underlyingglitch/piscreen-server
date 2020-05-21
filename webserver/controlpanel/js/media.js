$(document).ready(function(){
  Dropzone.options.imageUploadDropzone = {
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    init: function(){
      myDropzone = this;
      this.on("complete", function(){
        if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0){
          var _this = this;
          _this.removeAllFiles();
        }
      });
    }
  };

  $('.addMediaModalBtn').on('click', function(){
    
    var type = $(this).attr("php-type");

    switch (type) {
      case "text":
        $('#addMediaModal').modal('hide');
        $('#addTextModal').modal('show');
        break;
      case "image":
        $('#addMediaModal').modal('hide');
        $('#addImageModal').modal('show');
        break;
      case "url":
        $('#addMediaModal').modal('hide');
        $('#addUrlModal').modal('show');
        break;
    }
  });
});
