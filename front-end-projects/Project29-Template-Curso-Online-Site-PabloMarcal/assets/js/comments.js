function setUpCommentable(contentId) {

    $("#commentable").addClass("card card-color");


    var html = `
        <h2 class="container">Escreva um comentÃ¡rio</h2>
        <div class="row w-100 container">
            <div  class="p-4 w-100 card-color" style="margin-top: 10px;">
                <div class="commentsArea">
                    <textarea class="form-control" id="mainComment" placeholder="Adicionar comentÃ¡rio pÃºblico" cols="30" rows="5" maxlength="5000"></textarea><br>
                    
                    <button style="float:right;font-size: 20px;" class="btn button-color" onclick="isReply = false;" id="addComment">Enviar</button>
                </div>
                
            </div>
        </div>
        <h2 class="">ComentÃ¡rios recentes</h2>
        <div class="row w-100 commentsArea" style="margin-top:10px;padding-left: 20px;max-height: 500px;
        overflow-y: auto;">
            <div class="userComments w-100">
            
            </div>

           
        </div>
        <div class="replyRow container" style="display:none;">
            <div style="background: #F8F8F8 0% 0% no-repeat padding-box;
            border-radius: 5px;margin-left: 80px;" class="w-75 d-flex">
                <input type="text" class="form-control" id="replyComment" maxlength="5000" placeholder="Escreva uma resposta..."
                    style=" background: transparent;
                border: none;">
                <a class="" href="javascript:void(0)" onclick="isReply = true;" id="addReply" style="padding: 5px;">Enviar</a>
            </div>
        </div>
    
    `;

    $("#commentable").append(html);

    getAllComents(contentId, function (comments, num, replies, totalReplies) {
        let html = "";

        comments.forEach(comment => {
            html += createRowComment(comment, replies, comment.id);
        });
        $(".userComments").append(html);
        $("#num_comments").text(num);

        totalReplies.forEach(total => {
            $(`#number_answer_${total.id_comment_sub}`).text(total.qtd);
        });

        //console.log(response);
    }, function (response) {
        // console.log(response.message);          
    }
    );

    $("#addComment").on('click', function () {
        commentParentID = 0;
        sendComment(isReply);
    });

    $("#addReply").on('click', function () {
        console.log('click resposta')
        sendComment(isReply);
    });

}




function createRowComment(comment, replies, comment_parent_id) {

    let perfil_image = image_profile_default
    if (comment.subscriber_type == 'subscriber') {
        const { subscriber } = comment;
        author_name = subscriber.name;
        if (subscriber.thumb !== null) {
            perfil_image = subscriber.thumb.filename
        }
    }
    else {
        const { platform_user } = comment;
        author_name = platform_user.name;
        if (platform_user.thumb !== null) {
            perfil_image = platform_user.thumb.filename
        }
    }

    let html = `<div class="w-100 comment card-color" style="padding:0 25px;">

    <div class="row">
        <div class="">
            <img src="${perfil_image}" alt="user"  class="border-default-2px rounded-circle img-fluid" />
        </div>
        <div style="margin-left:10px;margin-top:5px;width: 75%;">
            <div class="user" style="margin-left: 5px;"><h5>${author_name}</h5></div>
            <div class="userComment" style="margin-left: 5px;">${comment.text}</div>
        </div>                                
    </div>
   
    <div class="" style="padding: 0;">
        <div>
           
            <div class="d-flex" style="margin-left:65px;">
                    <div class="reply">
                        <a href="javascript:void(0)" data-commentID="${comment.id}" data-commentParentID="${comment_parent_id}" onclick="reply(this)"
                            class="small comment-link-btn" style="padding:3px;font-size:15px;">
                            <i class="fa fa-reply mr-2" aria-hidden="true"></i>Responder
                        </a>
                    </div> 
                    <div class="showRespostas" style="margin-left: 10px;">
                        <a href="javascript:void(0)" class="small comment-link-btn txt_${comment.id}" data-commentID="${comment.id}"
                            onclick="showResposta(this);" style="padding:3px;"><i class="fa fa-comment mr-2" aria-hidden="true"></i>
                            Ver
                            Respostas
                        </a>
                        <a href="javascript:void(0)" class="small comment-link-btn" style="margin-top: 2px;">(<span id="number_answer_${comment.id}">0</span>)</a>
                    </div>
            </div>

            <div id="reply_container_${comment.id}" style="display:none;">

            </div>

          
            <div class="replies" id="reply_${comment.id}" style="display:none;margin-top:15px;">`;


    replies.forEach(reply => {
        if (reply.id_comment_sub == comment.id) {
            html += createRowComment(reply, replies, comment_parent_id);

        }
    });

    html += ` </div>
            </div>
        </div>
    </div>
    <hr>
`;

    return html;
}




var isReply = false, commentID = 0;

function reply(caller) {
    commentID = $(caller).attr('data-commentID');
    commentParentID = $(caller).attr('data-commentParentID');

    console.log(commentParentID);

    qtd_answer = $(`#reply_${commentID} .user`);
    $(`#number_answer_${commentID}`).html(qtd_answer.length);

    $(`#reply_container_${commentID}`).show();

    $(".replyRow").prependTo($(`#reply_container_${commentID}`));
    $('.replyRow').show();

}

function showResposta(caller) {
    let id = $(caller).attr('data-commentID');
    $(`#reply_${id}`).toggle();



}


function sendComment(isReply) {
    const id = GetURLParameter('id');
    var comment;

    if (!isReply) {
        comment = $("#mainComment").val();
    } else {
        comment = $("#replyComment").val();
    }
    console.log(commentParentID)
    if (comment.length > 0) {

        seedContentsComments(id, comment, commentID, commentParentID,
            function (comment) {
                const comment_text = comment.approved == 1 ? comment.text : '<span class="alert alert-warning">ComentÃ¡rio aguardando moderaÃ§Ã£o</span>'
                html = `<div class="w-100 comment card-color" style="padding:0 25px;">

                <div class="row">
                    <div class="">
                        <img src="${image_profile}" alt="user" class="border-default-2px rounded-circle img-fluid" />
                    </div>
                    <div style="margin-left:10px;margin-top:5px;width: 75%;">
                        <div class="user" style="margin-left: 5px;"><h5>${comment.name}</h5></div>
                        <div class="userComment" style="margin-left: 5px;">${comment_text}</div>
                    </div>                                
                </div>
               
                <div class="" style="padding: 0;">
                    <div>
                       
                        <div class="d-flex" style="margin-left:65px;">
                                <div class="reply">
                                    <a href="javascript:void(0)" data-commentID="${comment.id}" data-commentParentID="${comment.id_comment_sub}" onclick="reply(this)"
                                        class="small comment-link-btn" style="padding:3px;font-size:15px;">
                                        <i class="fa fa-reply mr-2" aria-hidden="true"></i>Responder
                                    </a>
                                </div> 
                                <div class="showRespostas" style="margin-left: 10px;">
                                    <a href="javascript:void(0)" class="small comment-link-btn txt_${comment.id}" data-commentID="${comment.id}"
                                        onclick="showResposta(this);" style="padding:3px;"><i class="fa fa-comment mr-2" aria-hidden="true"></i>
                                        Ver
                                        Respostas
                                    </a>
                                    <a href="javascript:void(0)" class="small comment-link-btn" style="margin-top: 2px;">(<span id="number_answer_${comment.id}">0</span>)</a>
                                </div>
                        </div>
            
                        <div id="reply_container_${comment.id}" style="display:none;">
                                
                        </div>
            
                      
                        <div class="replies" id="reply_${comment.id}" style="display:none;margin-top:15px;">`;


                html += ` </div>
                                </div>
                            </div>
                        </div>
                        <hr>`;

                if (!isReply) {

                    $(".userComments").prepend(html);
                    $("#mainComment").val("");


                } else {

                    $("#replyComment").val("");

                    $(".replyRow").hide();

                    $(`#reply_${commentID}`).append(html);

                    $(`#reply_${commentID}`).toggle();


                    commentID = 0;

                }

            },
            function (response) {
                alert('ocorreu um erro tente novamente mais tarde');
                // console.log('erro add');
                // console.log(response);
            }
        );

    } else {
        alert("comentÃ¡rio nÃ£o pode ser vazio");
    }

}
