function setUpContent() {
    setUpPage();
    id = GetURLParameter('id');
    course_id = GetURLParameter('course_id');
    module_id = GetURLParameter('module_id');
    content_id = (id === undefined) ? 0 : id;
    next_content_id = 0;
    next_module_id = 0;
    module_id = (module_id === undefined) ? 0 : module_id;
    getClassById(content_id, course_id, showContent);
    getModulesAndClasses(course_id, showModules);
    seedContentViews(course_id);
    $('#btn-save-note').click(
        () => {
            const note = $('#note').val();
            saveNote(id, note, function () {
                toastr.options.timeOut = 2000;
                toastr.success('AnotaÃ§Ã£o salva com sucesso');
            })
        }
    )
    gid = 0;
    getUserInfo(function (response) {
        const { id } = response.info;
        gid = id;
    });
    saveContentLog(
        window.location.href,
        window.location.hostname,
        gid,
        'subscribers',
        content_id,
        course_id
    );
}

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

function showContent(response) {
    const { content, next_content, alerts, certificate, token, note } = response;

    if (content !== undefined) {
        const {
            title, id, subtitle, thumb_big: { filename }, content_html, created_at, description, has_video_link, video_link,
            author, course, attachs
        } = content;

        const {
            id: content_id, module_id
        } = next_content;

        next_content_id = content_id;
        next_module_id = module_id;
        $('#title_class').text(title)

        if (has_video_link == 1) {
            videoFrame(video_link, 'auto');
            $("#nav-content").append(textContent(filename, subtitle, title, author.name_author, created_at, description, content_html));

        }
        else {
            $(`#main-content`).prepend(textContent(filename, subtitle, title, author.name_author, created_at, description, content_html));
            $("#nav-content-tab").addClass('d-none');
        }

        toggleCertificate(certificate, token);

        $('#nav-about').append(aboutCourse(course, author));

        if (note !== null)
            $('#note').val(note.note);

        showAttachs(attachs)
        showAlerts(alerts)

    }
    else {
        $(`#main-content`).prepend("Aula nÃ£o disponÃ­vel");
    }
}

function getClassesList(contents, module_id) {
    let html = "";
    var i = 1;
    contents.forEach(content => {
        const { id: content_id, title, subscribers: watcheds, published: { visibled, available_in, order_in_course } } = content;
        const url = `content-${course_model}?course_id=${course_id}&id=${content_id}&module_id=${module_id}`;
        if (visibled == 1) {
            html += `
                    <input type="checkbox" class="watcheds" data-content_id="${content_id}"
                    ${(watcheds > 0) ? " checked='checked'" : ""}>
                    <a href="${url}" class="course-primary-color text-capitalize content-hover-color" style="font-size: 17.5px;
                    padding: 10px;">${title}${checkCurrent(content_id)}</a><br />
            `;
        }
        else {
            html += `<span class="course-second-color"><i class="fa fa-clock-o mr-2" aria-hidden="true"></i> ${order_in_course}. ${title}${checkCurrent(content_id)}</span> 
            <span class="course-second-color pull-right" style="font-size: 10px;line-height: 16px">DisponÃ­vel em ${available_in}</span><br />`;
        }
        i++;
    });
    return html;
}

function checkCurrent(content_id) {
    return (content_id == GetURLParameter('id')) ? '<i class="fa fa-hand-o-left ml-2" aria-hidden="true"></i>' : '';
}

function showAttachs(attachs) {
    if (attachs.length > 0) {
        $('#nav-archive-tab > span').text(attachs.length)
        attachs.forEach(
            (archive, i) => {
                const order = i + 1;
                const { original_name, filename } = archive
                //${url_web}/file/download/${filename}
                let html = `
                <div class="archive course-card-color p-2" role="archive">
                    ${order} -  ${original_name} 
                    <a href="${filename}" target='_blank' class="button-color p-1 rounded download-file">
                        <i class="fa fa-download"></i>
                    </a><br />
                </div>`;
                $("#nav-archive").append(html);
            }
        )
    }
}


function showAlerts(alerts) {
    if (alerts.length > 0) {
        $('#nav-alert-tab > span').text(alerts.length)
        alerts.forEach(
            alert => {
                const { name, description, views } = alert;
                let html = `
                <div class="alert course-card-color p-2" role="alert">
                    <strong>${name}</strong><br />
                    ${description}<br />
                </div>`;
                if (views == 0) {
                    toastr.success(description, name);
                }
                $("#nav-alert").append(html);
            }
        )
    }
    else {
        $(`#nav-alert`).prepend("Nenhum aviso no momento");
    }
}

function aboutCourse(course, author) {
    //console.log(course);
    const { name, description, total_hours } = course;
    const { name_author, author_photo, author_insta, author_linkedin, author_desc, author_youtube } = author
    html = `
            
            <h3><strong>${name}</strong></h3>
            ${(description !== null) ? `
            <h5>Sobre o curso:</h5>
            <div>${description}</div>
            <hr>` : ''}
            <h5>Detalhes</h5>
            ${ (total_hours > 0) ? `<p><strong>DuraÃ§Ã£o:</strong> ${total_hours}h</p>` : ''}
            <hr>
            <h5>Professor</h5>
            <div class="p-2">
                <div class="row">
                ${(author_photo != null) ? `<img id="img-profile" src="${img_uploads}/authors_profiles/${author_photo}" alt="user" style="height: 80px;
                width:80px;" class="border-default-2px profile-pic img-fluid" />`
            :
            `<img id="img-profile" src='${image_profile_default}' alt="user" style="height: 80px;
                    width: 80px;" class="border-default-2px profile-pic img-fluid" />`
        }
                    <div class="ml-4">
                        <p class="" style="font-size:20px">${name_author}</p>
                        ${(author_linkedin != null) ? `<a href="${author_linkedin}" class="mr-2"><i class="fab fa-linkedin course-primary-color" style="font-size: 20px;" aria-hidden="true"></i></a>` : ''}
                        ${(author_insta != null) ? `<a href="${author_insta}"><i class="fab fa-instagram course-primary-color" style="font-size: 20px;" aria-hidden="true"></i></a>` : ''}
                        ${(author_youtube != null) ? `<a href="${author_youtube}"><i class="fab fa-youtube course-primary-color" style="font-size: 20px;" aria-hidden="true"></i></a>` : ''}
                    </div>
                </div>
                
                <div class="row container p-2">
                    <p>${(author_desc != null) ? author_desc : ''} </p>
                </div>
            </div>
        `
    return html;
}

function textContent(img, subtitle, title, name_author, created_at, description, content_html) {
    html = `
    <div class="p-3">
        <div class="card-body row course-primary-color" style="padding-left:0;">
            <div class="col col-sm-6">
                <h5 class="card-title">${title}</h5>
                <p class="card-text">
                    <small class="text-muted">${name_author} em ${created_at}</small>
                </p>
                <p class="card-text">${(subtitle != null) ? subtitle : ''}</p>
                
            </div>
        </div>
        <div class="row p-2">
            ${(content_html != null) ? content_html : ''}
        </div>
    </div>
    `;
    return html;
}

function setClassWatchedAndRedirect() {
    setClassWatched(content_id, 'true', function (response) {
        const { certificate, token } = response;
        toggleCertificate(certificate, token)
        if (certificate == 0) {
            self.location = `content-${course_model}?course_id=${course_id}&id=${next_content_id}&module_id=${next_module_id}`
        }
    });
}

function toggleCertificate(certificate, token) {
    $('#nav-certificate').empty();
    if (certificate == 1) {
        $('#nav-certificate-tab').removeClass('d-none');
        $('#nav-certificate').removeClass('d-none');
        $('#nav-certificate').append(setCertificate(token));
    }
    else {
        $('#nav-certificate-tab').addClass('d-none');
        $('#nav-certificate').addClass('d-none');
    }
}

function setCertificate(token) {
    content = `
        <h6>Certificado</h6><br />
        ParabÃ©ns vocÃª completou o curso.<br /><br />
        <a href="${url_web}certificate/${token}" target='_blank'>Clique aqui</a> para visualizar ou realizar o download.        
        `;
    return content;
}