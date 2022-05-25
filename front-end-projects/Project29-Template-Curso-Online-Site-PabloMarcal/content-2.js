$(document).ready(
    function () {
        course_model = 2;
        setUpContent()
    } 
)

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": 1000,
    "hideDuration": 1000,
    "timeOut": 100000,
    "extendedTimeOut": 100000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

function showModules(modules){
    if(modules !== undefined){

        html = ` <div class="accordion course-card-color" id="accordion">
                        <div class="card-header course-second-card-color" style="border-radius: 0;padding: 20px;box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);">
                                <h5 class="mb-0" style="cursor: pointer;font-size:20px;">   
                                    <strong class="" style="font-weight: initial;"> 
                                            ConteÃºdo do Curso
                                    </strong>            
                                </h5>
                        </div>
                    <div style="overflow-y: auto;height: 340px;">
                        
    `;

        a = 0;
        
        

        modules.map(module => {
            const {name, id, contents} = module;
           
            var qtdConteudo = 0;
            var qtdAssistidas = 0;
            contents.for
            contents.forEach(content =>{
                const {id: content_id, title, subscribers:watcheds, published: {visibled, available_in}} = content;
                qtdConteudo++;
                if(watcheds > 0){
                    qtdAssistidas++;
                }

            });


            html +=  `<div>
                                <div class="card-header course-card-color" id="heading${id}" style="border-radius: 0;padding: 15px;padding-bottom:0;border: none;">
                                    <h5 class="mb-0" style="cursor: pointer;font-size:18px;" data-toggle="collapse" data-target="#collapse${id}" 
                                    aria-expanded="true" aria-controls="collapse${id}">  
                                        <strong id="title-module${id}" class="title-module" style="font-weight: normal;
                                            border: 2px solid;
                                            padding: 8px;
                                            border-radius: 5px;
                                            width: 100%;
                                            display: inherit;">
                                            ${name}
                                            <p style="margin:0;"><small id="classWatched${id}">${qtdConteudo} aulas / ${qtdAssistidas} assistidas</small></p>
                               
                                        </strong>    
                                                
                                    </h5>
                                </div>
                                <div id="collapse${id}" class="collapse ${(id == module_id || (a == 0 && module_id == 0)) ? ' show': ''} course-second-card-color" aria-labelledby="heading${id}" data-parent="#accordion" style="padding: 8px;
                                    margin-right: 17px;
                                    margin-left: 17px;
                                    border-radius: 0px 0px 5px 5px;">
                                            <div class="card-body" style="padding: 0;">
                                                ${getClassesList(contents, id)}
                                            </div>
                                </div>
                     </div>`;

            a++;
            
            
            
            return html;
        });

        html += `</div>
        </div>`;
       
        $('#list_modules').append(html);

        $('.watcheds').click(function(){
           
            setClassWatched($(this).data('content_id'), $(this).prop('checked'), function (response){ 
                toggleCertificate(response.certificate, response.token)
            })
        });

    }
    else{
        $(`#main`).prepend("Aula nÃ£o disponÃ­vel"); 
    }
}