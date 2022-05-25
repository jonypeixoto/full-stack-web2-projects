
//API Video
function videoFrame(url_video, navigation){
    let html = 'Formato de vÃ­deo nÃ£o reconhecido';
    
    if(matchYoutubeUrl(url_video)){
        const url_id = youtube_parser(url_video);
        html = `<iframe width="100%" frameborder="0" height="400" id="player"
        src="https://www.youtube.com/embed/${url_id}?autoplay=1&enablejsapi=1" 
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen></iframe>`;
        $(`#main-content`).prepend(html);
        onYouTubeIframeAPIReady(navigation);
    }
    else{
        /*
        const url_id = vimeo_parser(url_video);
        html = `<iframe src="https://player.vimeo.com/video/${url_id}?autoplay=1"
        width="100%" height="400"
        frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>`
        */
        html = `<iframe src="${url_video}?autoplay=1"
        width="100%" height="400"
        frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>`
        $(`#main-content`).prepend(html); 
       setVimeoPlayer(navigation);
    }

}


//API Youtube
function matchYoutubeUrl(url) {
    var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    if(url.match(p)){
        return url.match(p)[1];
    }
    return false;
}

function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}

//var player;

function onYouTubeIframeAPIReady(navigation = 'api') {
    if(navigation ==  'auto'){
        player = new YT.Player( 'player', {
            events: { 
            'onStateChange': onPlayerStateChange 
            }
        });

        setInterval(showButtonSetWatched, 5000)
    }
}

function showButtonSetWatched(){
    current_time =  player.getCurrentTime();
    duration =  player.getDuration();
    half_duration = duration / 2;
    if(current_time > half_duration)
        $('#goToNextClass').removeClass('d-none');
    else
        $('#goToNextClass').addClass('d-none');
}
    


function onPlayerStateChange(event) {
    switch(event.data) {
        case 0:
        setClassWatchedAndRedirect();
        break;
    }
}




//API Vimeo
function matchVimeoUrl(url) {
    var p = /^(http\:\/\/|https\:\/\/)?(www\.)?(vimeo\.com\/)([0-9]+)$/;
    if(url.match(p)){
        return url.match(p)[1];
    }
    return false;
}

function vimeo_parser(url){
    result = url.match(/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:[a-zA-Z0-9_\-]+)?/i);
    return result[1];
}

function setVimeoPlayer(navigation = 'auto'){
    

    if(navigation == 'auto'){

        var iframe = document.querySelector('iframe');
        var player = new Vimeo.Player(iframe);

        const TOLERANCE = 0.002;

        player.on('timeupdate', function (data) {
            if (data.percent >= (0.5 - TOLERANCE)) {
                $('#goToNextClass').removeClass('d-none');
            } else {
                $('#goToNextClass').addClass('d-none');
            }
        });
    
        player.on('ended', function () {
            setClassWatchedAndRedirect()
        });
    }
    
}


