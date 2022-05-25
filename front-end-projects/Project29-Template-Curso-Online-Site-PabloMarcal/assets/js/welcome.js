$(document).ready(
    function () {
        setUpPage();
        getWelcome(showWelcome);
    }
);

function showWelcome(response) {
    if (response.widgets) {

        let widgets = response.widgets
          if (widgets.length == 1 && widgets[0].widget_type == 5 && widgets[0].content.length === undefined)
            redirectClass(widgets[0].content.id, widgets[0].content.template.course_model);

        response.widgets.forEach(widget => {
            const { widget_type, id, content } = widget
            if (widget_type == 1 || widget_type == 4) {
                $('#main').append(setWidgetTypeSection(widget))
            }
            else if (widget_type == 2) {
                $('#main').append(setWidgetTypeContent(widget))
            }
            else if (widget_type == 3) {
                $('#main').append(setWidgetTypeImage(widget))
            }
            else if (widget_type == 5) {
                $('#main').append(setWidgetTypeCourse(widget))
            }
            else if (widget_type == 6) {
                $('#main').append(setWidgetTypeCategory(widget))
            }
        });
    }
}

const setWidgetTypeSection = widget => {

    const { content, model_id, id, widget_type } = widget;
    const { title, color, font, icon } = widget;

    html = `
    

            <div class="widget widget-carousel">
            <div class="widget-title d-flex">
                        ${getTitle(widget)}
                        <hr style="border: none;
                                background-color:${color};
                                color: ${color};
                                height: 2px;width: 80%;
                                margin-left: 5px;
                                margin-top: 13px;
                            ">
                    </div>
                    <div class="widget-articles">
            `;

    html += content.map(content => {
        const { filename, copyright, title, description, id, name_slug, template_id, folder } = content;
        const url = `content?id=${id}`;
        const image = `${filename}`;
        const path = slugSectionByModeEnv(name_slug, template_id, folder);
        const link_path = `${path}/${url}`;
        return setArticle(title, description, link_path, image, copyright);
    }).join('');

    html += `
                </div>
                </div>`;

    return html;
}

const setWidgetTypeImage = widget => {
    if (widget) {
        html = `
        <div class="widget"><img src="${widget.image.filename}" class="img-fluid" ></div>
        `;
        return html;
    }
}

const setWidgetTypeContent = widget => {

    if (widget) {
        const {
            content: { title, id, thumb_small: { filename }, description },
            section: { template, name_slug }
        } = widget;

        const path = slugSectionByModeEnv(name_slug, template.id, template.folder);
        const url = `${path}/content?id=${id}`;
        const image = `${filename}`;
        const widget_title = getTitle(widget);

        return getContentModel(widget_title, title, url, image, description);
    }
}

const setWidgetTypeCourse = widget => {

    if (widget) {

        const { content, model_id, id, widget_type, title, color, font, icon } = widget;

        if (widget.model_id == 0) { //todos os curso

            html = `<div class="widget widget-carousel">

                        <div class="widget-title d-flex">
                            ${getTitle(widget)}
                            <hr style="border: none;
                                    background-color:${color};
                                    color: ${color};
                                    height: 2px;width: 80%;
                                    margin-left: 5px;
                                    margin-top: 13px;
                                ">
                         </div>
                        
                        <div class="widget-articles">    
                    `;

            html += content.map(content => {

                const { id, name, template: { course_model }, thumb: { filename, copyright } } = content;

                const link_path = `javascript:redirectClass(${id}, ${course_model})`;

                let html = setArticle(name, null, link_path, filename, copyright);

                return html;

            }).join('');

            html += `
                        </div>
                        </div>`;

        }
        else { //curso Ãºnico
            const {
                content: { name, id, thumb: { filename, copyright }, template: { course_model }, description },
            } = widget;

            const url = `javascript:redirectClass(${id}, ${course_model})`;
            const image = `${filename}`;
            const widget_title = getTitle(widget);

            html = getContentModel(widget_title, name, url, image, copyright, description, 0);
        }

        return html;

    }
}

const setWidgetTypeCategory = widget => {

    if (widget) {

        const { content, model_id, id, widget_type, title, color, font, icon } = widget;


        html = `<div class="widget widget-carousel">

                        <div class="widget-title d-flex">
                            ${getTitle(widget)}
                            <hr style="border: none;
                                    background-color:${color};
                                    color: ${color};
                                    height: 2px;width: 80%;
                                    margin-left: 5px;
                                    margin-top: 13px;
                                ">
                         </div>
                        
                        <div class="widget-articles">    
                    `;

        html += content.map(content => {

            const { title, thumb, copyright } = content;

            const  path = getPathLinkCategory(content);

            let html = setArticle(title, null, path, thumb, copyright);

            return html;

        }).join('');

        html += `
                        </div>
                        </div>`;


        return html;

    }
}

const getContentModel = (widget_title, title, url, image, copyright, description, tracking = 1) => {

    html = `
        <div class="widget widget-content card-color container-fluid">
            <div class="row widget-content-title widget-title">
                ${widget_title}
            </div>
            <div class="col col-md-10 offset-md-1">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-5 col-sm-12 col-xs-12 widget-content-img">
                            <a href="${url}">
                                <img style="border-radius: 0;"  src="${image}" ${imageCredits(copyright)}>
                            </a>
                    </div>
                    <div class="col-12 col-md-6 col-sm-12 col-xs-12 widget-content-data">
                        <div class="widget-content-data-header">
                            <h5>${title}</h5>
                            ${(description != null) ? description : ''}
                        </div>
                        <div class="widget-content-data-footer article-content">
                            <div>${(tracking == 1) ?
            `<button class="btn button-color">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                        <span id="qtdLikeCard">0</span>
                                    </button>
                                    <button class="btn button-color ml-3">
                                        <i class="fa fa-comments" aria-hidden="true"></i>
                                        <span id="qtdCommentCard">0</span>
                                    </button>`: ''
        }
                            </div>
                            <div>
                                    <a href="${url}" class="link">
                                        Acessar <i class="fa fa-play-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;

    return html;

}

const setArticle = (title, description, link_path, image, copyright) => {

    html = `
            <div class="widget-articles-img">
                <a href="${link_path}">    
                    <img  src="${image}" class='img-fluid' ${imageCredits(copyright)}>
                </a>
            </div>
        `;

    return html;
}

function getTitle(widget) {
    const { title, color, font, icon } = widget;
    return `<h5 style="color:${color}; font-family: ${font};letter-spacing: -1px;">${(icon) ? `<img src="${icon.filename}">` : ``} ${title}</h5>`;
}