$(document).ready(
    function (){
        //setUpLikeable();
        getLike(GetURLParameter('id'),
        function(response){
            if(response.data=="true")
            {
                var btn = $("a#likeBtn > i");
                btn.removeClass("fa-thumbs-o-up").addClass("fa-thumbs-up");
                console.log("true no conteudo curtido");
            }
            $("#likeText").text(response.totalLikes);
        }
        ,function (response){ ///retorno erro
            console.log(response);
        })
    }
);

function likeBtn(event){
    event.preventDefault();
    var el = $("a#likeBtn > i");
    //console.log(el);
    if(el.hasClass("fa-thumbs-o-up")){
        el.removeClass("fa-thumbs-o-up").addClass("fa-thumbs-up");
        let likeText = parseInt($("#likeText").text())+1;
        $("#likeText").text(likeText);
        seedContentLikes(GetURLParameter('id'),1,
            function(response){
                console.log(response);
            },
            function(response){
                console.log(response);
            });
        
    }else{
        el.removeClass("fa-thumbs-up").addClass("fa-thumbs-o-up");
        let likeText = parseInt($("#likeText").text())-1;
        $("#likeText").text(likeText);
        seedContentLikes(GetURLParameter('id'),0,
            function(response){
                console.log(response);
            },
            function(response){
                console.log(response);
            });
            
    }
     
}





