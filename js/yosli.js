function makeYosliForm(slide, url, h1Header) {

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
    var submit = makeYosliInput("submit", "", "Сохранить");
    submit.setAttribute("class", "button green");

    if (slide.filename) {
        var image = document.createElement("img");
        image.setAttribute("src", "/wa-data/public/shop/yosli/"+slide.filename);
        image.setAttribute("class", "edit-image");
    }

    var titleBlock = makeYosliFieldBlock("Заголовок", title);
    var linkBlock = makeYosliFieldBlock("Ссылка", link);
    var fileBlock = makeYosliFieldBlock("Изображение", file);
    var submitBlock = makeYosliFieldBlock("", submit);

    form.appendChild(id);
    form.appendChild(old_file);
    if (slide.id) {
        var deleteHandler = document.createElement("a");
        deleteHandler.setAttribute("href", "#");
        deleteHandler.setAttribute("id", "yosli-delete");
        deleteHandler.innerHTML = "Удалить";
        form.appendChild(deleteHandler);
    }
    if (image) {
        form.appendChild(image);
    }
    form.appendChild(titleBlock);
    form.appendChild(linkBlock);
    form.appendChild(fileBlock);
    form.appendChild(submitBlock);

    wrapper.appendChild(header);
    wrapper.appendChild(form);

    return wrapper;

}

function makeYosliInput(type, name, value) {
    var input = document.createElement("input");
    input.type = type;
    input.name = name;
    input.value = value;

    return input;
}

function makeYosliDiv(className) {
    var div = document.createElement("div");
    div.setAttribute("class", className);

    return div;
}

function makeYosliFieldBlock(name, value) {
    var wrapper = makeYosliDiv("field");
    var nameDiv = makeYosliDiv("name");
    var valueDiv = makeYosliDiv("value");

    nameDiv.innerHTML = name;
    valueDiv.appendChild(value);

    wrapper.appendChild(nameDiv);
    wrapper.appendChild(valueDiv);

    return wrapper;
}

$(document).on('submit', "#yosli-form", function() {
    var t = $(this);
    var titleInput = t.find("input[name='title']");
    var idInput = t.find("input[name='id']");

    if ( titleInput.val().length == 0 && (titleInput.val().length == 0 || t.find("input[name='filename']").val().length == 0) ) {
        if ( t.closest(".fields").find(".errormsg").length == 0 ) {
            var errorBlock = makeYosliDiv("errormsg");
            errorBlock.innerHTML = 'Заполните, пожалуйста, обязательные поля: "заголовок" и "изображение"';
            t.before(errorBlock);

            if (titleInput.val().length == 0) {
                titleInput.focus();
            }
        }

        return false;
    } 

});

$(document).on('click', "#yosli-delete", function() {
    if(confirm('Удалить?')) {

        var form = $(this).closest("#yosli-form");
        var id = form.find("input[name='id']").val();
        var oldFilename = form.find("input[name='old_filename']").val(); 
        
        if (id) {
            $.get('?plugin=yosli&action=delete&id='+id+'&old_filename='+oldFilename, function (result) {
                if (result && result.data == true) {
                    $("#s-content").html('YO!');
                    $("input.slide-id[value='"+id+"']").closest("li").hide(600, function() {
                        $(this).show("normal");
                        $(this).remove();
                    });
                }
            }, "json");
        }
    }

});

$(document).ready(function() {

    $("#yosli-create").on("click", function() {
        var slide = { title: '', link: '', filename: '' };
        var url = "?plugin=yosli&action=create";
        var form = makeYosliForm(slide, url, "Создать слайд");
        $("#s-content").html(form);

        return false;
    });

    $(".yosli-edit").on("click", function() {
        var t = $(this);
        var id = t.find(".slide-id").val();

        $.get('?plugin=yosli&action=read&id='+id, function (result) {
            if (result) {
                var slide = result.data;
                var url = "?plugin=yosli&action=update";
                var form = makeYosliForm(slide, url, "Редактировать слайд "+slide.title);
                $("#s-content").html(form);
            }
        }, "json");

    });

});