
    //for multyple files
    Dropzone.autoDiscover = false;
    
    var myDropzone = new Dropzone('.dropzone', {
        autoProcessQueue: false,
        parallelUploads: 10,
        maxFilesize: 2,
        addRemoveLinks: true,
    });

    $('.sendFiles').click(function(){
        myDropzone.processQueue();
        myDropzone.on("complete", function(file) {
            myDropzone.removeFile(file);
        });
    });

    $('.clear-dropzone').click(function(){
        myDropzone.removeAllFiles(true);
    });