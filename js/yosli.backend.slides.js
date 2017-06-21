/**
 * yosli.backend.slides.js
 * Module yosliBackendSlides
 */

/*global $, yosliBackendSlides */

var yosliBackendSlides = (function () { 'use strict';
    //---------------- BEGIN MODULE SCOPE VARIABLES ---------------
    var
        htmlCharsDecode, makeYosliForm, makeYosliInput, makeYosliDiv, makeYosliFieldBlock, uploadTmpimage,
        onFormSubmit, onDeleteHandler, onCreateHandler, onEditHandler, onFileChange,
        initModule;
    //----------------- END MODULE SCOPE VARIABLES ----------------

    //--------------------- BEGIN DOM METHODS ---------------------
    htmlCharsDecode = function (val) {
        return $('<div/>').html(val).text();
    }
    
    makeYosliForm = function (slide, url, h1Header) {
        var
            wrapper, header, fileFrame, fileForm, fileInput, form, id, oldFile, newFile, title, uploadIcon, file, link, sort, submit, image, titleBlock, fileBlock, linkBlock, sortBlock, submitBlock, deleteIcon, deleteHandler, sbmBtn;

        wrapper = makeYosliDiv('fields form');

        header = $('<h1 />');
        header.html( h1Header );

        fileFrame = $('<iframe />');
        fileFrame.attr( { 'id': 'yosli-file-frame', 'name': 'yosli-file-frame', 'width': '1', 'height': '1' } );

        fileForm = $('<form />');
        fileForm.attr( { 'id': 'yosli-file-form', 'target': 'yosli-file-frame', 'method': 'post', 'enctype': 'multipart/form-data', 'action': '?plugin=yosli&action=tmpimage' } );

        fileForm.append('{$wa->csrf()}');

        fileInput = makeYosliInput('file', 'filename', '');
        fileForm.append(fileInput);

        form = $('<form />');
        form.attr( { 'id': 'yosli-form', 'method': 'post', 'enctype': 'multipart/form-data', 'action': url } );

        id         = makeYosliInput('hidden', 'id', slide.id);
        oldFile    = makeYosliInput('hidden', 'old_filename', slide.filename);
        newFile    = makeYosliInput('hidden', 'is_new_filename', '');
        title      = makeYosliInput('text', 'title', slide.title);
        uploadIcon = $('<i />').attr('class', 'icon16 upload');
        file       = $('<a />').attr( { 'href': '#', 'id': 'file-upload-link' } ).append(uploadIcon, '{_wp("Upload")}');
        link       = makeYosliInput('text', 'link', slide.link);
        sort       = makeYosliInput('number', 'sort', slide.sort);
        submit     = makeYosliInput('submit', '', '{_wp("Save")}');
        submit.attr('class', 'button green').attr('id', 'sbmBtn');

        if (slide.filename) {
            image = $('<img />');
            image.attr( { 'src': '{$wa_url}wa-data/public/shop/yosli/'+slide.filename, 'class': 'edit-image' } );
        }

        titleBlock  = makeYosliFieldBlock('{_wp("Title")}', title);
        fileBlock   = makeYosliFieldBlock('{_wp("Image")}', file);
        linkBlock   = makeYosliFieldBlock('{_wp("Link")}', link);
        sortBlock   = makeYosliFieldBlock('{_wp("Sort")}', sort);
        submitBlock = makeYosliFieldBlock('', submit);

        form.append('{$wa->csrf()}');

        if (image) {
            form.append(image);
        }
        form.append(id, oldFile, newFile, titleBlock, fileBlock, linkBlock, sortBlock, submitBlock);

        wrapper.append(header, fileFrame, fileForm, form);

        if (slide.id) {
            deleteIcon = $('<i />');
            deleteIcon.attr('class', 'icon16 delete');
            
            deleteHandler = $('<a />');
            deleteHandler.attr( { 'href': '#', 'id': 'yosli-delete' } ).html('{_wp("Delete")}').prepend(deleteIcon);

            sbmBtn = submitBlock.find('.value');
            sbmBtn.prepend(deleteHandler);
        }

        return wrapper;
    };

    makeYosliInput = function (type, name, value) {
        var input = $('<input />');
        
        input.attr( { 'type': type, 'name': name } ).val( htmlCharsDecode(value) );

        return input;
    };

    makeYosliDiv = function (className) {
        var div = $('<div />');

        div.attr('class', className);

        return div;
    };

    makeYosliFieldBlock = function (name, value) {
        var divWrap = makeYosliDiv('field');
        var divName = makeYosliDiv('name');
        var divValue = makeYosliDiv('value');

        divName.html( name );
        divValue.append( value );

        divWrap.append(divName, divValue);

        return divWrap;
    };

    uploadTmpimage = function () {

        var t = $('iframe#yosli-file-frame');
        var url = t.contents().find('body').html();
        
        var filename = '';

        t.closest('.fields').find('.errormsg').remove();

        if (url.substr(0, 6) == 'error:') {
            var errorBlock = makeYosliDiv('errormsg');

            $('#file-upload-link i').removeClass('loading').addClass('icon16, upload');

            errorBlock.html('Error uploading image: ' + url.substr(6));            
            t.after(errorBlock);

            $('.imageform')[0].reset();
            return;
        }

        var urlArray = url.split('/');

        var image = $('<img />');
        image.attr('src', url.replace(/&amp;/g, '&'));
        image.attr('class', 'edit-image');

        $('#yosli-form .edit-image').remove();
        $('#yosli-form').prepend(image);

        $('#file-upload-link i').removeClass('loading').addClass('icon16, upload');

        $('input[name="is_new_filename"]').val('1');
    
        return false;
    }
    //--------------------- END DOM METHODS -----------------------

    //------------------- BEGIN EVENT HANDLERS --------------------
    onFormSubmit = function (event) {
        var 
            t, titleInput, fileInput, oldFileInput, idInput, errorBlock;

        t = $(this);
        titleInput   = t.find('input[name="title"]');
        fileInput    = t.find('input[name="is_new_filename"]');
        oldFileInput = t.find('input[name="old_filename"]');
        idInput      = t.find('input[name="id"]');            

        t.closest('.fields').find('.errormsg').remove();

        if ( titleInput.val().length === 0 ) {
            if ( t.closest('.fields').find('.errormsg').length == 0 ) {
                errorBlock = makeYosliDiv('errormsg');
                errorBlock.html('{_wp("Fill in the title field")}');
                t.before(errorBlock);

                titleInput.focus();
            }

            return false;
        } else if ( oldFileInput.val().length === 0 && fileInput.val().length === 0 ) {
            if ( t.closest('.fields').find('.errormsg').length == 0 ) {
                errorBlock = makeYosliDiv('errormsg');
                errorBlock.html('{_wp("Download image")}');
                t.before(errorBlock);
            }

            return false;
        }
    };

    onDeleteHandler = function (event) {
        if(confirm('{_wp("Delete?")}')) {

            event.preventDefault();

            var form        = $(this).closest('#yosli-form');
            var id          = form.find('input[name="id"]').val();
            var oldFilename = form.find('input[name="old_filename"]').val();

            $('#s-content').empty().addClass('loading');

            if (id) {
                $.get('?plugin=yosli&action=delete&id='+id+'&old_filename='+oldFilename, function (response) {
                    if (response.data === true) {
                        $('#s-content').removeClass('loading').html('<div class="block double-padded align-right gray"><strong>{_wp("The image is removed.")}</strong></div>');

                        $('input.slide-id[value="'+id+'"]').closest('li').hide(600, function() {
                            $(this).show('normal');
                            $(this).remove();
                        });
                    }
                }, 'json');
            }

        }
    };

    onCreateHandler = function (event) {
        event.preventDefault();

        var slide = { title: '', filename: '', link: '', sort: '' };
        var url   = '?plugin=yosli&action=create';
        var form  = makeYosliForm(slide, url, '{_wp("To create a slide")}');

        $('#s-content').empty().addClass('loading');

        $('.yosli-edit-wrap').removeClass('selected');

        $('#s-content').removeClass('loading').html(form);
    };

    onEditHandler = function (event) {
        var t  = $(this);
        var id = t.find('.slide-id').val();

        $('#s-content').empty().addClass('loading');

        $('.yosli-edit-wrap').removeClass('selected');
        t.closest('li').addClass('selected');

        $.get('?plugin=yosli&action=read&id='+id, function (result) {
            if (result) {
                var slide = result.data;
                var url   = '?plugin=yosli&action=update';
                var form  = makeYosliForm(slide, url, '{_wp("To edit the slide")} '+slide.title);
                $('#s-content').removeClass('loading').html(form);
            }
        }, 'json');
    };

    onFileChange = function (event) {
        $('#file-upload-link i').removeClass('icon16, upload').addClass('loading');
        
        $('#yosli-file-form').submit();
    };
    //------------------- END EVENT HANDLERS ----------------------

    //------------------- BEGIN PUBLIC METHODS --------------------
    initModule = function () {
        $(document).on('submit', '#yosli-form', onFormSubmit);

        $(document).on('click', '#yosli-delete', onDeleteHandler);

        $(document).on('click', '#yosli-create', onCreateHandler);

        $(document).on('click', '.yosli-edit', onEditHandler);

        $(document).on('change', '#yosli-file-form input[name="filename"]', onFileChange);

        $(document).on('click', '#file-upload-link', function() {
            $('#yosli-file-form input[name="filename"]').trigger('click');
        });
    };

    return {
        initModule: initModule,
        uploadTmpimage: uploadTmpimage
    };
    //------------------- END PUBLIC METHODS ----------------------
}());