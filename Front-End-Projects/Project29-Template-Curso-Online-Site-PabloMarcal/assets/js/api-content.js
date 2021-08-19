//pega detalhes de conteÃºdo
function getContentById(id, callback, callbackError) {
    const url_access = window.location.href;
    $.ajax({
        type: "get",
        url: `${url_api}seed-content-by-id`,
        data: { token, platform_id, id, url_access },
        dataType: "json",
        success: function (response) {
            callback(response);
        },
        error: function (xhr) {
            if (xhr.status == 401) {
                logOut();
            }
            else {
                console.log(xhr);
                //callbackError(response);
            }
        }
    });
}

//pega todos os comentarios do conteudo
function getAllComents(id, callback, callbackError) {

    $.ajax({
        type: "get",
        url: `${url_api}seed-all-comments`,
        data: { token, platform_id, id },
        dataType: "json",
        success: function (response) {
            callback(response.comments, response.totalComments, response.replies, response.totalReplies);

        },
        error: function (response) {
            callbackError(response.message);

        }
    });

}


//gera like no banco
function seedContentLikes(id, status, callback, callbackError) {

    $.ajax({
        type: "POST",
        url: `${url_api}seed-content-likes`,
        data: { token, platform_id, id, status },
        dataType: "json",
        success: function (response) {
            callback(response);
        },
        error: function (response) {
            callbackError(response);
        }
    });

}


//recupera o like
function getLike(id, callback, callbackError) {
    $.ajax({
        type: "GET",
        url: `${url_api}check-like-content`,
        dataType: "json",
        data: { token, platform_id, id },
        success: function (response) {
            callback(response)
        },
        error: function (response) {
            callbackError(response)
        }
    })

}

//recupera respostas de comentÃ¡rios
function getContentsReplies(id, callback, callbackError) {
    $.ajax({
        type: "GET",
        url: `${url_api}seed-contents-comments-replies`,
        dataType: "json",
        data: { token, platform_id, id },
        success: function (response) {
            callback(response)
        },
        error: function (response) {
            callbackError(response)
        }
    })

}


function seedContentsComments(contents_id, text, id_comment_sub, comment_id, callback, callbackError) {
    $.ajax({
        url: `${url_api}seed-contents-comments`,
        method: "POST",
        dataType: 'json',
        data: {
            token,
            platform_id,
            text,
            id_comment_sub,
            comment_id,
            contents_id,
        },
        success: function (response) {
            console.log("data do comentario");
            console.log(response);
            callback(response.data);
        },
        error: function (response) {
            console.log('erro add comentario');
            console.log(response);
            callbackError(response.message);
        }
    });
}

function seedContentViews(id) {
    $.ajax({
        url: `${url_api}seed-content-views`,
        method: "POST",
        dataType: 'json',
        data: { token, platform_id, id },
        success: function (response) {
            console.log(response.data);
            console.log('view adicionado');
        },
        error: function (response) {
            console.log(response.message);
        }
    });
}

