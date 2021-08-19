$('#txtBusca').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        goSearch();
    }
    //Stop the event from propogation to other handlers
    //If this line will be removed, then keypress event handler attached 
    //at document level will also be triggered
    event.stopPropagation();
});

function goSearch() {
    var texto = $("#txtBusca").val();
    console.log(texto);
    console.log(texto.length);
    if (texto.length > 0) {
        searchContents(texto, function (response) {
            console.log(response);
            $("main").empty();
            $("main").append(`<div class="container p-4">
            
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item p-2">
                  <a class="nav-link cabecalho-background-color cabecalho-primary-color font-weight-bold active" id="pills-content-tab" data-toggle="pill" href="#pills-content" role="tab" aria-controls="pills-content" aria-selected="true">ConteÃºdos</a>
                </li>
                <li class="nav-item p-2">
                  <a class="nav-link cabecalho-background-color cabecalho-primary-color font-weight-bold" id="pills-course-tab" data-toggle="pill" href="#pills-course" role="tab" aria-controls="pills-course" aria-selected="false">Cursos</a>
                </li>
                
            </ul>
            <div class="tab-content p-4" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-content" role="tabpanel" aria-labelledby="pills-home-tab">
                    


                </div>
                <div class="tab-pane fade" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
                 
                </div>
                
            </div>
        </div>`);

            // const {contents,courses} = response;
            if (response.contents) {
                response.contents.forEach(content => {
                    setContent(content);
                });
            }
            if (response.courses) {
                response.courses.forEach(course => {
                    setCourse(course);
                });
            }
        });

    } else {
        console.log("vazio");
        return;
    }
}


function setCourse(course) {

    const url = `/cursos/content?course_id=${course.id}`;


    html = ` <a href="${url}">

    <div class="card w-100 mb-3 d-flex flex-wrap flex-row">
            <div class="col-md-1" style="padding: 0;">
                <img alt="imagem ilustrativa curso" class="img-fluid" style="height: 100px;" src="${course.filename}" />
            </div>
            <div class="col-md-11 p-2 pesquisa-link">
                <h5 class="font-weight-bold">${course.name}</small></h5>
                <p style="display: block;display: -webkit-box;max-width:100%;-webkit-line-clamp:3;
                -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">
                ${(course.description != null) ? course.description : ''}
                </p>
            </div>
    </div>


</a>`


    $("#pills-course").append(html);
}


function setContent(content) {

    const url = `/${content.name_slug}/content?id=${content.id}`;
    html = `
    <a href="${url}">

    <div class="card w-100 mb-3 d-flex flex-wrap flex-row">
            <div class="col-md-1" style="padding: 0;">
                <img alt="${content.subtitle}" class="img-fluid" style="height: 100px;" src="${content.filename}" />
            </div>
            <div class="col-md-11 p-2 pesquisa-link">
                <h5 class="font-weight-bold">${content.title} - <small class="font-weight-bold">Autor : ${content.name_author}</small></h5>
                <p style="display: block;display: -webkit-box;max-width:100%;-webkit-line-clamp:3;
                -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">
                    ${(content.description != null) ? content.description : ''}
                </p>
            </div>
    </div>


</a>
                


            
        `;

    $("#pills-content").append(html);
}