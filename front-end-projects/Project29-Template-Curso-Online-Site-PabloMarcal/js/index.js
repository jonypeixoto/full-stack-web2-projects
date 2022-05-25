$(document).ready(function () {
  if (logged == 'true') {
    goToWelcome();
  } else {
    $('.form-signin h1').text(platform.name);

    const token = GetURLParameter('token');

    const email = GetURLParameter('email');

    configsPlatform(fixTemplate, false);

    if (token !== undefined) showFormReset(token, email);
    else showFormLogin();
  }

  $('#button-singin').click(() => logInto());

  $('#a-recover').click(() => showFormRecoverPassword());

  $('#a-login').click(() => showFormLogin());

  $('#button-send-link-reset').click(() => send_link_reset());

  $('#button-password-reset').click(() => password_reset());

  $('#button-back-login').click(() => window.location.replace('/'));

  $('.cpf').mask('000.000.000-00', { reverse: true });
});

let emailEvent = '';
let isSpamProvider = false;
let isFormRecovery = false;

/*
window.addEventListener('load', () => {
  emailEvent = document.querySelector('#email');
  emailEvent.addEventListener('keyup', verifyEmailProvider);
});

function verifyEmailProvider(e) {
  let provider = e.target.value;
  if (provider.match('@outlook') || provider.match('@hotmail')) {
    isSpamProvider = true;
    if (isFormRecovery) {
      $('#cpf-field').removeClass('d-none');
    }
  } else {
    isSpamProvider = false;
    $('#cpf-field').addClass('d-none');
  }
}
*/

const fixTemplate = (configs) => {
  let image_logo = configs.image_logo_login
    ? configs.logo_login_filename
    : `assets/images/logo.png`;
  let image_template = configs.template_filename
    ? configs.template_filename
    : `assets/images/template.jpg`;

  $('#image_logo').prop('src', configs.logo_login_filename);
  if (configs.login_template == 'C') {
    $('#content').addClass('border-default-2px bg-color-secondary');

    if (configs.status_background_image_login == 1) {
      $('#model_right').removeClass('bg-login');
      $('body').css({
        background: `url('${image_template}') no-repeat center top fixed`,
        '-webkit-background-size': 'cover',
        '-moz-background-size': 'cover',
        '-o-background-size': 'cover',
        'background-size': 'cover',
      });
    }
  } else {
    $('#image_template').prop('src');
    $('#div_image_template').removeClass('d-none');
  }

  $('#image_logo').prop('src', image_logo);
  $('#image_template').prop('src', image_template);
  $('#loading').hide();
  $('#div_form_login').show();
};

const showFormReset = (token, email) => {
  isFormRecovery = false;
  $(
    '#a-login, #form-group-password_confirmation, #button-password-reset'
  ).removeClass('d-none');
  $('#email').val(email);
  $('#token').val(token);
  $('#password, #password_confirmation').val('');
};

const showFormRecoverPassword = () => {
  isFormRecovery = true;
  $('#email').val('');
  $('#form-group-password, #button-singin, #a-recover').addClass('d-none');
  $('#title-recover, #button-send-link-reset, #a-login').removeClass('d-none');
};

const showFormLogin = () => {
  isFormRecovery = false;
  $(
    '#form-group-password, #button-singin, #a-recover, #form-group-img-logo'
  ).removeClass('d-none');
  $(
    '#title-recover, #button-send-link-reset, #a-login, #button-password-reset, #form-group-password_confirmation, #cpf-field'
  ).addClass('d-none');
};

const send_link_reset = () => {
  const email = $('#email').val();
  const cpf = null;

  const url_site = `${location.protocol}//${window.location.host}`;

  const data = {
    user_type: 'subscribers',
    url_site,
    email,
    cpf,
  };

  if (!(email && email.includes('@'))) alertError('E-mail incorreto');
  else {
      checksIfEmailExists(data, function (response) {
        if (response.status == 'error') {
          alertError(response.message);
        } else {
          loadingIcon('button-send-link-reset', 'show');
          sendPasswordResetLink(
            data.user_type,
            url_site,
            email,
            cpf,
            function () {
              alertSuccess('Link de redefinição de senha enviado com sucesso');
              $('#button-send-link-reset').addClass('d-none');
              $('#a-login').addClass('d-none');
              $('#button-back-login').removeClass('d-none');
              loadingIcon('button-send-link-reset', 'hide');
            }
          );
        }
      });
  }
};

const password_reset = () => {
  const token = GetURLParameter('token');
  const email = $('#email').val();
  const password = $('#password').val();
  const password_confirmation = $('#password_confirmation').val();
  const url_site = `${location.protocol}//${window.location.host}`;

  const validations = [];
  validations.push([email && email.includes('@'), 'Email inválido']);
  validations.push([
    password && password.length >= 5,
    'Senha deve ter ao menos 5 caracteres',
  ]);
  validations.push([
    password_confirmation && password_confirmation == password,
    'Repetição de senha não confere',
  ]);

  const errors = checkValid(validations);
  if (errors !== undefined) {
    alertError(errors[1]);
  } else {
    let cpf = '';
    const data = {
      user_type: 'subscribers',
      token,
      password,
      password_confirmation,
      email,
      cpf,
    };

    // console.log(data);

    checksIfEmailExists(data, function (response) {
      if (response.status === 'error') {
        alertError(response.message);
      } else {
        loadingIcon('button-password-reset', 'show');
        setPasswordRequest(
          data.email,
          data.cpf,
          data.password,
          url_site,
          function () {
            alertSuccess('Senha alterada com sucesso');
            loadingIcon('button-password-reset', 'hide');
            $(
              '#button-send-link-reset, #button-password-reset, #a-login, #email, #cpf-field, #password, #password_confirmation'
            ).addClass('d-none');
            $('#button-back-login').removeClass('d-none');
          }
        );
      }
    });
  }
};
