//pega o destaque de uma seÃ§Ã£o de acordo com ordem enviada
function getContentFeaturedByOrder(feature_order,callback){
    const {section_key} = section;
    $.ajax({
        type: "post",
        url: `${url_api}seed-feature-by-order`,
        data: { token, platform_id, section_key, feature_order},
        dataType: "json",
        success: function (response) {
            callback(response);
        }
    });
}

//pega conteÃºdos com limite de resultados
function getContentsFromSection(callback, limit = 0, different = 0){
    const {section_key} = section;
    $.ajax({
        type: "get",
        url: `${url_api}seed-contents-from-section`,
        data: { token, platform_id, section_key, limit, different},
        dataType: "json",
        success: function (response) {
            callback(response);
        }
    });
}

//pega conteÃºdos a partir de um destaque (apÃ³s)
function getContentsFromTheFeatureOrder(feature_order,limit,callback){
    const {section_key} = section;
    const url_access = window.location.href;
    $.ajax({
        type: "get",
        url: `${url_api}seed-get-contents-from-the-feature-order`,
        data: { token, platform_id, section_key, feature_order, limit, url_access},
        dataType: "json",
        success: function (response) {
            callback(response);
        }
    });
}

//Retorna preferÃªncias de exibiÃ§Ã£o da seÃ§Ã£o
function getSectionConfig(callback, callbackError){
    const {section_key} = section;
    $.ajax({
        type:"get",
        url:`${url_api}seed-get-section-config`,
        data:{token, platform_id,section_key},
        dataType:"json",
        success:function(response){
            callback(response);
        },
        error: function(xhr){
            if(xhr.status == 401){
                logOut();
            }
        }
    });
}