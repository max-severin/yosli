/**
 * yosli.backend.slides.js
 * Module yosliBackendSlides
 */

/*global $, yosliBackendSlides */

var yosliBackendSlides = (function () { "use strict";
    //---------------- BEGIN MODULE SCOPE VARIABLES ---------------
    var
        makeYosliForm, makeYosliInput, makeYosliDiv, makeYosliFieldBlock, uploadTmpimage,
        onFormSubmit, onDeleteHandler, onCreateHandler, onEditHandler, onFileChange,
        initModule;
    //----------------- END MODULE SCOPE VARIABLES ----------------

    //--------------------- BEGIN DOM METHODS ---------------------
    makeYosliForm = function (slide, url, h1Header) {
        var wrapper = makeYosliDiv("fields form");

        var header = document.createElement("h1");
        header.innerHTML = h1Header;

        var form = document.createElement("form");
        form.setAttribute("id", "yosli-form");
        form.setAttribute("method", "post");
        form.setAttribute("enctype", "multipart/form-data");
        form.setAttribute("action", url);

        var id = makeYosliInput("hidden", "id", slide.id);
        var title = makeYosliInput("text", "title", slide.title);
        var link = makeYosliInput("text", "link", slide.link);
        var old_file = makeYosliInput("hidden", "old_filename", slide.filename);
        var file = makeYosliInput("file", "filename", "");
        var submit = makeYosliInput("submit", "", "{_wp('Save')}");
        submit.setAttribute("class", "button green");
        submit.setAttribute("id", "sbmBtn");

        if (slide.filename) {
            var image = document.createElement("img");
            image.setAttribute("src", "{$wa_url}wa-data/public/shop/yosli/"+slide.filename);
            image.setAttribute("class", "edit-image");
        }

        var titleBlock = makeYosliFieldBlock("{_wp('Title')}", title);
        var linkBlock = makeYosliFieldBlock("{_wp('Link')}", link);
        var fileBlock = makeYosliFieldBlock("{_wp('Image')}", file);
        var submitBlock = makeYosliFieldBlock("", submit);

        form.appendChild(id);
        form.appendChild(old_file);
        if (image) {
            form.appendChild(image);
        }
        form.appendChild(titleBlock);
        form.appendChild(linkBlock);
        form.appendChild(fileBlock);
        form.appendChild(submitBlock);

        wrapper.appendChild(header);
        wrapper.appendChild(form);

        if (slide.id) {
            var deleteIcon = document.createElement("i");
            deleteIcon.setAttribute("class", "icon16 delete");
            
            var deleteHandler = document.createElement("a");
            deleteHandler.setAttribute("href", "#");
            deleteHandler.setAttribute("id", "yosli-delete");
            deleteHandler.innerHTML = "{_wp('Delete')}";
            deleteHandler.insertBefore(deleteIcon, deleteHandler.firstChild);
            var sbmBtn = submitBlock.children[1];
            sbmBtn.insertBefore(deleteHandler, sbmBtn.firstChild);
        }

        return wrapper;
    };

    makeYosliInput = function (type, name, value) {
        var input = document.createElement("input");
        
        input.type = type;
        input.name = name;
        input.value = value;

        return input;
    };

    makeYosliDiv = function (className) {
        var div = document.createElement("div");
        div.setAttribute("class", className);

        return div;
    };

    makeYosliFieldBlock = function (name, value) {
        var wrapper = makeYosliDiv("field");
        var nameDiv = makeYosliDiv("name");
        var valueDiv = makeYosliDiv("value");

        nameDiv.innerHTML = name;
        valueDiv.appendChild(value);

        wrapper.appendChild(nameDiv);
        wrapper.appendChild(valueDiv);

        return wrapper;
    };
    uploadTmpimage = function () {

        var t = $('iframe.wall-photo-iframe');
        var url = t.contents().find("body").html();
        
        var filename = '';

        if (url.substr(0, 6) == 'error:') {
            alert('Error uploading image: ' + url.substr(6));
            // Reset the file upload selector
            $('.imageform')[0].reset();
            return;
        }

        var urlArray = url.split('/');

        var image = $("<img />");
        image.attr("src", url.replace(/&amp;/g, '&'));
        image.attr("class", "edit-image");

        $('body').find('#yosli-form').prepend(image);
    
        return false;
    }
    //--------------------- END DOM METHODS -----------------------

    //------------------- BEGIN EVENT HANDLERS --------------------
    onFormSubmit = function (event) {
        var t = $(this);
        var titleInput = t.find("input[name='title']");
        var fileInput = t.find("input[name='filename']");
        var oldFileInput = t.find("input[name='old_filename']");
        var idInput = t.find("input[name='id']");            

        t.closest(".fields").find(".errormsg").remove();

        if ( titleInput.val().length === 0 ) {
            if ( t.closest(".fields").find(".errormsg").length == 0 ) {
                var errorBlock = makeYosliDiv("errormsg");
                errorBlock.innerHTML = "{_wp('Fill in the title field')}";
                t.before(errorBlock);

                titleInput.focus();
            }

            return false;
        } else if ( oldFileInput.val().length === 0 && fileInput.val().length === 0 ) {
            if ( t.closest(".fields").find(".errormsg").length == 0 ) {
                var errorBlock = makeYosliDiv("errormsg");
                errorBlock.innerHTML = "{_wp('Download image')}";
                t.before(errorBlock);
            }

            return false;
        }
    };

    onDeleteHandler = function (event) {
        if(confirm("{_wp('Delete?')}")) {

            event.preventDefault();

            var form = $(this).closest("#yosli-form");
            var id = form.find("input[name='id']").val();
            var oldFilename = form.find("input[name='old_filename']").val();

            if (id) {
                $.get('?plugin=yosli&action=delete&id='+id+'&old_filename='+oldFilename, function (response) {
                    if (response.data === true) {
                        $("#s-content").html('<div class="block double-padded align-right gray"><strong>{_wp("The image is removed.")}</strong></div>');

                        $("input.slide-id[value='"+id+"']").closest("li").hide(600, function() {
                            $(this).show("normal");
                            $(this).remove();
                        });
                    }
                }, "json");
            }

        }
    };

    onCreateHandler = function (event) {
        event.preventDefault();

        var slide = { title: '', link: '', filename: '' };
        var url = "?plugin=yosli&action=create";
        var form = makeYosliForm(slide, url, "{_wp('To create a slide')}");

        $('.yosli-edit-wrap').removeClass('selected');

        $("#s-content").html(form);
    };

    onEditHandler = function (event) {
        var t = $(this);
        var id = t.find(".slide-id").val();

        $('.yosli-edit-wrap').removeClass('selected');
        t.closest('li').addClass('selected');

        $.get('?plugin=yosli&action=read&id='+id, function (result) {
            if (result) {
                var slide = result.data;
                var url = "?plugin=yosli&action=update";
                var form = makeYosliForm(slide, url, "{_wp('To edit the slide')} "+slide.title);
                $("#s-content").html(form);
            }
        }, "json");
    };

    onFileChange = function (event) {
        // add loading gif
        $(this).closest('.value').find('.imageform').submit();
    };
    //------------------- END EVENT HANDLERS ----------------------

    //------------------- BEGIN PUBLIC METHODS --------------------
    initModule = function () {
        $(document).on('submit', "#yosli-form", onFormSubmit);

        $(document).on('click', "#yosli-delete", onDeleteHandler);

        $(document).on('click', "#yosli-create", onCreateHandler);

        $(document).on('click', ".yosli-edit", onEditHandler);

        $(document).on('change', "input[name='filename']", onFileChange);
    };

    return {
        initModule: initModule,
        uploadTmpimage: uploadTmpimage
    };
    //------------------- END PUBLIC METHODS ----------------------
}());