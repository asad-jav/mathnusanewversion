

    //for multyple files
    Dropzone.autoDiscover = false;
    
    var myDropzone = new Dropzone('.dropzone', {
        autoProcessQueue: false,
        parallelUploads: 10,
        maxFilesize: 2,
        addRemoveLinks: true,
    });

    $('.clear-dropzone').click(function(){
        myDropzone.removeAllFiles(true);
    });

    