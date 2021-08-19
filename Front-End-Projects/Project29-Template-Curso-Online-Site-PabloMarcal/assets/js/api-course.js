//Retorna todos os cursos da plataforma
function getCourses(callback) {
    $.ajax({
        type: 'get',
        url: `${url_api}seed-courses`,
        data: {token, platform_id},
        dataType: 'json',
        success: function (response) {
            callback(response.courses);
        },
        error: function (data) {
            console.log(data);
        },
        error: function (xhr) {
            if (xhr.status == 401) {
                logOut();
            }
        },
    });
}

//Retorna aula pela classe
function getClassById(id, course_id, callback) {
    $.ajax({
        type: 'get',
        url: `${url_api}seed-class-by-id`,
        data: {token, platform_id, course_id, id},
        dataType: 'json',
        success: function (response) {
            callback(response);
        },
        error: function (xhr) {
            if (xhr.status == 401) {
                logOut();
            }
        },
    });
}

//Retorna modules organizados por aula
function getModulesAndClasses(course_id, callback) {
    $.ajax({
        type: 'get',
        url: `${url_api}seed-modules-and-classes`,
        data: {token, platform_id, course_id},
        dataType: 'json',
        success: function (response) {
            callback(response.modules);
        },
        error: function (data) {
            console.log(data);
        },
    });
}

//Marca aula como assistida
function setClassWatched(content_id, watched, callback = null) {

    $.ajax({
        type: 'get',
        url: `${url_api}seed-set-class-watched`,
        data: {token, platform_id, content_id, watched},
        dataType: 'json',
        success: function (response) {
            if (callback != null) {
                callback(response);
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function saveNote(content_id, note, callback) {
    $.ajax({
        type: 'post',
        url: `${url_api}seed-save-note`,
        data: {token, platform_id, note, content_id},
        dataType: 'json',
        success: function (response) {
            callback(response);
        },
    });

}

function getVerifyUrl(course_id, callback) {
    $.ajax({
        type: 'get',
        url: `${url_api}get-verify-url`,
        data: {token, platform_id, course_id},
        dataType: 'json',
        success: function (response) {
            callback(response);
        },
    });

}

//FunÃ§Ã£o que salva o log de acesso as aulas
function saveContentLog(route, ip, user_id, user_type, content_id, course_id) {
    const section_id = '';
    const section_key = '';
    $.ajax({
        url: `${url_api}save-access-course-log`,
        method: 'POST',
        dataType: 'json',
        data: {
            token,
            platform_id,
            content_id,
            course_id,
            route,
            ip,
            user_id,
            user_type,
            section_id,
            section_key,
        },
        success: function (response) {
            //   console.log(response.data);
        },
        error: function (response) {
            console.log(response.message);
        },
    });
}