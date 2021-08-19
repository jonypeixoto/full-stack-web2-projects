//Layout menu sidebar
function setUpPage() {
    configsPlatform(setUpheader);
    getImageProfile(image => $("#img-profile").prop('src', image));
}

function setUpheader(response) {
    const { research_bar, user_profile, suport } = response;
    html = `
    <nav style="padding: 0;width: 100%;" class="d-flex justify-content-between flex-nowrap navbar navbar-expand-md navbar-dark  cabecalho">
            <span id="toggle-icon" onclick="toggleSidebar()" style="position: fixed;">   
                <a href="#"><i class="fa fa-bars cabecalho-primary-color" aria-hidden="true" style="font-size: 20px;"></i></a>
            </span>
            <div class="d-flex align-items-center w-100 justify-content-end">
                ${(research_bar == 1) ? `
                <!--barra pesquisa-->
                <div id="divBusca" class="d-flex justify-content-between">
                    <input class="w-100 color-txtBusca" type="text" id="txtBusca" placeholder="Pesquisar no site"/>
                    <a href="#" class="color-txtBusca" onclick="goSearch()">
                        <i class="fa fa-search" style="margin-top:6px;margin-right: 6px;"aria-hidden="true"></i>
                    </a>
                </div>` : ``}
                ${(user_profile == 1) ? `<div class="dropdown profile-pic-container" id="userProfileIcon" style="padding: 10px;">
                <a id="img-profile-link"class="profile-pic-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!--imagem de perfil-->
                    <img id="img-profile" src="${image_profile_default}" alt="user" 
                    style="height: 40px;
                width: 40px;" class="border-default-2px profile-pic img-fluid" />
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="img-profile-link">
                        <a href="/edit-user.html" class="dropdown-item"><i class="fa fa-user"></i> Meu perfil</a>
                        ${(suport == 1) ? `<a href="mailto:${response.email_support}" id="profileSuport" class="dropdown-item"><i class="fa fa-cog"></i> Suporte</a>` : ''}
                        <a href="javascript:void[0]" onclick="logOut()" class="dropdown-item"><i class="fa fa-power-off"></i> Sair</a>
                </div>
            </div>`: ''}    
                
            </div> 
        </nav>
    `;
    $('.topbar').append(html);
    setSeoTags(response); //aponta para app.js
    setUpFooter(response);
    setUpSidebar();
    fixTemplate(response);
}



function setUpSidebar() {
    html = `

    <div class="form-group d-flex justify-content-center image_logo_sidebar" style="margin:0">
            <a href="${root}welcome" id="image_logo_sidebar"
                class="pb-4 pt-5">



               
            </a>
    </div>

    


    <ul id="sectionNavs" style="list-style-type: none;padding: 0;padding-top:50px;"
            class="navbar-default-custom">
        
    </ul>

    `;
    $("#mySidenav").append(html);
    $("#mySidenav").addClass("cabecalho-background-color");
    getMenu(setUpMenuNav);

}

function setUpMenuNav(response) {

        list = "";
        response.forEach(
            item => {
                const { short_title, title, image, has_external_link } = item;

                const path = getPathLink(item);

                const label = title.toUpperCase();

                list += `
                    <li class="font-weight-bold">
                        <a class="cabecalho-primary-color section-name" href="${path}" ${ (has_external_link == 1) ? ' target="_blank"' : '' }>
                            <img src="${image}" alt="" style="width: 26px; margin: 0px 5px 0px 0px;"/>
                            <span>${label}</span>
                        </a>
                    </li>
                `;
            }
        )

        $('#sectionNavs').append(list);
        $("#sectionNavs").addClass('navbar-default-custom');
}

function setUpFooter(response) {
    html = `
    <div class="footer_container container d-flex flex-row justify-content-center align-items-center flex-wrap"
    style="text-align: center;padding: 50px;padding-top: 20px;">
                <img alt="logo da comunidade" class="img-fluid p-2" src="${response.logo_rodape_filename}" style="width: 150px;
                height: 50px;">
                <span class="p-2">${(response.copyright != null) ? response.copyright : ''}</span>
                <!--<img alt="logo da fandone" class="img-fluid p-2" src="assets/images/logo.png" style="width: 150px;">-->
            </div>
    `;
    $('footer').append(html);

    $('footer').css("z-index", "-1");
}



const fixTemplate = configs => {

    let image_logo = (configs.logo_filename) ? configs.logo_filename : '';

    html = `
    <img class="img-fluid" src="${image_logo}" style="max-height:90px;min-width: 50px;" alt="">
    `;

    $("#image_logo_sidebar").append(html);


    if (configs.status_background_image == 1 && configs.background_image_id != 0) {
        $('body').css({
            "background": `url('${configs.background_filename}') no-repeat center top fixed`,
            "-webkit-background-size": "cover",
            "-moz-background-size": "cover",
            "-o-background-size": "cover",
            "background-size": "cover"
        });
    }

}





var mini = false;

if ($(window).width() <= 540) {
    this.mini = true;
}

function toggleSidebar() {
    if (mini) {
        console.log("opening sidebar");
        document.getElementById("mySidenav").style.width = "190px";
        document.getElementById("main").style.marginLeft = "190px";
        document.getElementById("toggle-icon").style.marginLeft = "200px";
        $(".material-icons").css("margin", "0 10px 0 0");
        $(".section-name span").show();
        $('.section-name').addClass('d-flex align-items-center');
        $('.section-name').removeClass('justify-content-center');
        

        this.mini = false;
    } else {
        console.log("closing sidebar");
        document.getElementById("mySidenav").style.width = "65px";
        document.getElementById("main").style.marginLeft = "65px";
        document.getElementById("toggle-icon").style.marginLeft = "85px";
        $(".material-icons").css("margin", "0px 25px 0px 9px;");
        $('.section-name').removeClass('d-flex align-items-center');
        $('.section-name').addClass('justify-content-center');
        $(".section-name span").hide();
        this.mini = true;
    }
}







