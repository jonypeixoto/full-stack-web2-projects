//autenticaÃ§Ã£o do usuÃ¡rio
var checkLogin = (data, callback) => {
  $.ajax({
    type: 'post',
    url: `${url_api}login`,
    dataType: 'json',
    data,
    success: function (response) {
      callback(response);
    },
  });
};

//logout do usuÃ¡rio
var setLogOut = (route, callback, callbackError) => {
  $.ajax({
    type: 'post',
    url: `${url_api}logout`,
    data: { token, platform_id, route },
    dataType: 'json',
    success: function (response) {
      callback(response);
    },
    error: function (response) {
      callbackError(response);
    },
  });
};

//checa se email existe
var checksIfEmailExists = (data, callback) => {
  $.ajax({
    type: 'post',
    url: `${url_api}checks-if-email-exists`,
    dataType: 'json',
    data,
    success: function (response) {
      callback(response);
    },
    error: function (response) {
      console.log('error');
      console.log(response);
    },
  });
};

checksIfExists = (data, callback) => {
  $.ajax({
    type: 'post',
    url: `${url_api}checks-if-exists`,
    dataType: 'json',
    data,
    success: function (response) {
      //console.log(response);
      callback(response);
    },
    error: function (response) {
      console.log(response);
    },
  });
};

//solicita link de redefiniÃ§Ã£o de senha
function sendPasswordResetLink(user_type, url_site, email, cpf, callback) {
  $.ajax({
    type: 'post',
    url: `${url_api}recovery-password`,
    dataType: 'json',
    data: { platform_id, user_type, url_site, email, cpf },
    success: function (response) {
      console.log(response);
      callback();
    },
    error: function (response) {
      //nÃ£o alterar aqui (erro esperado)
      console.log(response);
    },
  });
}

//reseta senha
setPasswordRequest = (email, cpf, password, url_site, callback) => {
  $.ajax({
    type: 'post',
    url: `${url_api}subscriber-password`,
    dataType: 'json',
    data: { platform_id, email, cpf, password, url_site },
    success: function (response) {
      console.log(response);
      callback();
    },
    error: function (response) {
      console.log(response);
    },
  });
};

var repasswd = (data, callback) => {
  $.ajax({
    type: 'post',
    url: `${url_api}password/repasswd`,
    data,
    success: function (response) {
      console.log(response);
      callback(response);
    },
    error: function (response) {
      console.log(response);
    },
  });
};