var logged = window.localStorage.getItem('logged');
var image_profile = window.localStorage.getItem('image_profile');
var token = window.localStorage.getItem('token');
var subscriber_name = window.localStorage.getItem('subscriber_name');
var root = window.location.protocol + "//" + window.location.host + "/";
var folder = getLevel();

var { mode, url_web, id: platform_id } = platform;
var url_api = `${url_web}api/`;
var img_uploads = `${url_web}uploads/`;
var image_profile_default = `${root}/assets/images/profile.jpg`;
var url_template = window.location.protocol + '//' + window.location.host;

var goToWelcome = () => self.location = `${folder}welcome.html`;
var goToHome = () => self.location = `${folder}index`;
var goToLive = () => self.location = `${folder}live.html`;

var logInto = () => {
    var email = $('#email').val();
    var password = $('#password').val();
    var validations = [];
    validations.push([email && email.includes("@"), "Email incorreto"]);
    validations.push([password && password.length >= 5, "Senha deve ter ao menos 5 caracteres"]);

    loadingIcon('button-singin', 'show');
    var errors = checkValid(validations);
    if (errors !== undefined) {

        alertError(errors[1])
        loadingIcon('button-singin', 'hide');
    }
    else {
        var form = $('#form-login');
        var data_to_login = form.serialize() + '&platform_id=' + platform_id + "&route=login"; // Fernanda
        checkLogin(data_to_login, response => {
            var { error, message } = response
            if (error === undefined) {
                LoginWithSuccess(response);
            }
            else {
                alertError(message);
                loadingIcon('button-singin', 'hide');
            }
        });
    }
}


var logOut = () => {
    window.localStorage.removeItem('token');
    window.localStorage.removeItem('name');
    window.localStorage.removeItem('logged');
    var route = 'logout';
    setLogOut(route, goToHome, goToHome)
}


var LoginWithSuccess = response => {
    var { token, subscriber: { name } } = response
    window.localStorage.setItem('token', token);
    window.localStorage.setItem('subscriber_name', name);
    window.localStorage.setItem('logged', true);
    goToWelcome();
    // if (window.location.host == 'mentoria.produtividade40.com.br') {
    //     var data = new Date();
    //     var hora = data.getHours();// 0-23
    //     var min = data.getMinutes();// 0-59
    //     if ((hora >= 20 && min >= 50) && (hora < 21 && min < 35)) {
    //         goToLive();
    //     } else {
    //         goToWelcome();
    //     }
    // } else {
    //     goToWelcome();
    // }


}

var alertError = message => {
    $('.alert').removeClass('d-none alert-success');
    $('.alert').html(message);
    $('.alert').addClass('show alert-danger');
}

var alertSuccess = message => {
    $('.alert').removeClass('d-none alert-danger');
    $('.alert').html(message);
    $('.alert').addClass(`show alert-success`);
}

var redirectClass = (course_id, course_model) => {
    getStartContent(course_id, content => {
        self.location = `${root}cursos/content-${course_model}?course_id=${course_id}&id=${content.id}&module_id=${content.module_id}`;
    });
};

var getPathLink = item => {
    var { type, id, name_slug, course } = item;
    let path = root;
    switch (type) {
        case 1: //seÃ§Ãµes
            path += name_slug;
            break;
        case 2:  //cursos
            path += "cursos"
            if (id > 0) {
                path = `javascript:redirectClass(${id}, ${course.course_model})`;
            }
            break;
        case 3:  //conteÃºdos
            path += `${name_slug}/content?id=${id}`;
            break;    
        case 4:  //categorias
            path += `category?id=${id}`;
            break;
        default: //fÃ³rum
            path += `forum`;
            break;

    }
    return path;
}

var getPathLinkCategory = item => {

    const { id, type, template, name_slug, curso_id, module_id } = item;

    switch (type) {
        case 1: //seÃ§Ãµes
            path = root + name_slug;
            break;
        case 2:  //cursos
            path = `javascript:redirectClass(${id}, ${template})`;
            break;
        default:  //conteÃºdos
            path = (template == 0) ? `${root + name_slug}/content?id=${id}` :
                `${root + name_slug}/content-${template}?course_id=${curso_id}&id=${id}}&module_id=${module_id}`;
            break;
    }

    return path;
}

function getImageProfile(callback) {
    if (image_profile !== null) {
        callback(image_profile);
    }
    else {
        getUserInfo(function (response) {
            var { info } = response;
            if (info.thumb !== null) {
                window.localStorage.setItem('image_profile', info.thumb.filename);
                callback(info.thumb.filename);
            }
            else {
                callback(image_profile_default);
            }
        });
    }
}


function getLevel() {
    var title = document.title;
    let folder = (title != 'index') ? "../" : "";
    /*
    switch (title) {
        case 'section':
            folder = "../"
            break;
    }
    */
    return folder;
}

function checkValid(validations) {
    return validations.find(condition => (!condition[0]));
}

var loadingIcon = (btn, action) => {
    var icon = '<i class="fa fa-spinner fa-spin"></i>';
    var button = $(`#${btn}`);
    var text = button.text();
    let content = text;
    if (action == 'show') {
        button.prop("disabled", true);
        content += ` ${icon}`;
    }
    else if (action == 'hide') {
        button.prop("disabled", false);
    }
    button.html(content);
}

var slugSectionByModeEnv = (slug_section, template_id = 0, template_folder) => {
    let slug = slug_section;
    if (mode == 'templates-base') {
        if (template_id == 0) {
            slug = section.name_slug;
        }
        else {
            slug = template_folder;
        }
    }
    return slug;
}



function setSeoTags(response) {

    var { seo_description, seo_title, seo_keywords, favicon_filename } = response;

    html = `
            <meta name="description" content="${seo_description}">
            <meta name="keywords" content="${seo_keywords}">
        `;

    $(html).insertAfter($("[charset=UTF-8]"));

    $("title").text(seo_title);

    favicon = `
            <link rel="shortcut icon" href="${favicon_filename}" />
        
        `;

    $(favicon).insertBefore("title");

}

//creditos imagens unsplash
function imageCredits(copyright) {
    return (copyright !== null) ? ` alt="Foto por ${copyright}" title="Foto por ${copyright}"` : "";
}

/*
window.onerror = function (msg, url, linenumber) {
    alert('Error message: ' + msg + '\nURL: ' + url + '\nLine Number: ' + linenumber);
    return true;
}
$.ajaxSetup({
    error: function (xhr) {
        //alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        alert(xhr.status);
        if (xhr.status == 401) {
            alert(xhr.status);
            logout_redirect();
        }
        dump(xhr, 'body')
    }
});
*/