last_menu_update = 0;

function configsPlatform(callback){
    callback(config_template);
    /*
    $.ajax({
        type: "get",
        url: `${url_api}seed-config`,
        data: { token, platform_id },
        dataType: "json",
        success: function (response) {
            if (response.logout) { 
                logOut(); 
            }
            callback(response.config);
        },
        error: function (data) {
            console.log(data);
        }
    });
    */
}

//Pega seções
function getMenu(callback){
    /*
        callback(config_menu);
    */    
    menu_update_time = window.localStorage.getItem('menu_update_time');
    last_menu_update = (Date.now() - menu_update_time) / 1000
    console.log(last_menu_update);

    //atualiza menu a cada 5 min
    if(last_menu_update > 300){
        $.ajax({
            type: "get",
            url: `${url_api}seed-menu`,
            data: { token, platform_id},
            dataType: "json",
            success: function (response) {
                console.log('set cache')
                var cache_menu = response.menu
                window.localStorage.setItem('cache_menu', JSON.stringify(cache_menu));
                window.localStorage.setItem('menu_update_time', Date.now());
                callback(cache_menu);
            },
            error: function (data) {
               logOut();
            }
        });
    }
    else{
        console.log('get cache')
        callback(JSON.parse(window.localStorage.getItem('cache_menu')));
    }
}


//Pega última aula assistada por um aluno em determinado curso (vinculado ao menu)
function getStartContent(course_id, callback){
    $.ajax({
        type: "get",
        url: `${url_api}seed-get-start-content`,
        data: { token, platform_id, course_id},
        dataType: "json",
        success: function (response) {
            callback(response);
        },
        error: function (data) {
            console.log(data);
        }
    });
}


//Pega widgets da home
function getWelcome(callback){
    $.ajax({
        type: "get",
        url: `${url_api}seed-welcome`,
        data: { token, platform_id},
        dataType: "json",
        success: function (response) {
            callback(response);
        },
        error: function(xhr){
            if(xhr.status == 401){
                logOut();
            }
            else{
                callbackError(xhr);
            }
        }
    });
}


//Pega todos conteúdos do site
function getAllContents(amount, callback){
    $.ajax({
        type: "get",
        url: `${url_api}seed-all-contents`,
        data: { token, platform_id, amount},
        dataType: "json",
        success: function (response) {
            callback(response);
        },
        error: function (data) {
            console.log(data);
        }
    });
}


//pega dados do assinante
function getUserInfo(callback)
{
    $.ajax({
        type:"get",
        url:`${url_api}get-user-info`,
        data:{token, platform_id},
        dataType:"json",
        success:function(response){
            callback(response);
        }
    });
}

//atualiza dados do assinante
function setUserInfo(data, callback, callbackError)
{
    $.ajax({
        type: "POST",
        url: `${url_api}seed-user-info`,
        data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response)
        {
            callback(response)                        
        },
        error:function(data){
            callbackError(data)
        }
    });
}

//pesquisa conteudo pelo site/comunidade inteira
function searchContents(text,callback){
    $.ajax({
        type:"get",
        url: `${url_api}research`,
        dataType: "json",
        data:{token,platform_id,text},
        success: function (response) {
            callback(response);
        },
        error:function(response){
            console.log(response);
            console.log('erro pesquisa');
        }
    });
}


//pega o destaque de uma seção de acordo com ordem enviada
function getContentByCategory(id,callback){
    $.ajax({
        type: "get",
        url: `${url_api}seed-get-content-by-category`,
        data: { token, platform_id, id},
        dataType: "json",
        success: function (response) {
            callback(response);
        }
    });
}



