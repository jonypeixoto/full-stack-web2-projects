$(document).ready(
    function (){
        setUpPage();
       
        getUserInfo(function(response){
            const {info} = response;
            $("#name").val(info.name);
            $("#gender").val(info.gender);
            $("#birthday").val(info.birthday);
            $("#main_phone").val(info.main_phone);
            $("#cel_phone").val(info.cel_phone);
            $("#password").val('');

            $("#tax_id_number").val(info.tax_id_number); 

            if(info.type=="natural_person"){
                $('#legal_person').prop('checked',false);
                $('#natural_person').prop('checked',true);
                $("#tax_id_number_label").html('CPF')
                $("#company_data").hide();
            }
            else{
                const obj = JSON.parse(info.company_data);
                $("#company_name").val(obj.tax_id_br_im);
                $("#tax_id_br_ie").val(obj.tax_id_br_ie);
                $("#tax_id_br_im").val(obj.tax_id_br_im);
            }

            changeType(info.type)

            $("#cep").val(info.address_zipcode);
            $("#cidade").val(info.address_city);
            $("#uf").val(info.address_state);
            $("#rua").val(info.address_street);
            $("#address_number").val(info.address_number);

        });

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

       
        $('#ajax_form').submit(function(){
            Senha = document.getElementById('password').value;
            re_Senha = document.getElementById('re_password').value;

            if($('#change_password').prop('checked') == true && Senha == ''){
                toastr["warning"]("Informe a senha", "Erro");
            }
            else if (Senha != re_Senha) {
                toastr["warning"]("Senhas nÃ£o conferem", "Erro");
            }else{

                var input = document.getElementById("icon");

                if(input.value != ''){
                    var nome = input.files[0].name;
                    var extensao = comprova_extensao($('#ajax_form'), nome);
                }

                var data = new FormData($('#ajax_form')[0]);
                data.append('token', token);
                data.append('platform_id', platform_id);

                if(extensao!=false){
                    setUserInfo(data,
                        function(response)
                        {
                            console.log(response);
                            window.localStorage.removeItem('image_profile');
                            toastr["success"]("Dados atualizados com sucesso", "Sucesso");                          
                        },
                        function(response){
                            console.log(response);
                            console.log('error');
                        }
                    )
                }else{
                    toastr["warning"]("Comprova a extensÃ£o dos arquivos a subir. \nSÃ³ se podem subir arquivos com extensÃµes:.jpg,.png", "Erro");
                }
            }   
            return false;
        });

        $('#change_password').click(
            function (){
                $('#password, #re_password').val('')
                if($(this).prop('checked') == true)
                    $('#row_password').removeClass('d-none')
                else
                    $('#row_password').addClass('d-none')
            }
        )

        function limpa_formulÃ¡rio_cep() {
            // Limpa valores do formulÃ¡rio de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }

        $("#tax_id_number").change(function(){
            let string = $(this).val();
            if($("#tax_id_number_label").html()=="CPF")
            {
               var teste = TestaCPF(string);
            }else{
                var teste = validarCNPJ(string);
            } 

            if(teste == false)
            {
                $("#tax_id_number").val("");
                alert(`Campo ${$("#tax_id_number_label").html()} invÃ¡lido`);
            }
        });

        

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variÃ¡vel "cep" somente com dÃ­gitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //ExpressÃ£o regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado nÃ£o foi encontrado.
                            limpa_formulÃ¡rio_cep();
                            alert("CEP nÃ£o encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep Ã© invÃ¡lido.
                    limpa_formulÃ¡rio_cep();
                    alert("Formato de CEP invÃ¡lido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulÃ¡rio.
                limpa_formulÃ¡rio_cep();
            }
        });

        //mascaras
        $('.phone_with_ddd').mask('(00) 0000-0000');
        $(".cel_phone").mask('(00) 00000-0000');
        

        
    }

    
);

function changeType(type)
{
    if (type == 'legal_person') {
        $("#tax_id_number_label").html('CNPJ')
        $("input[name=tax_id_number]").mask('00.000.000/0000-00', {reverse: true});
        $("#company_data").show()
    } else {
        $("#tax_id_number_label").html('CPF');
        $("input[name=tax_id_number]").mask('000.000.000-00', {reverse: true});
        $("#company_data").hide();
    }
}
     

function comprova_extensao(formulario, arquivo) {
    extensoes_permitidas = new Array(".jpg",".png");
    
       //recupero a extensÃ£o deste nome de arquivo
       extensao = (arquivo.substring(arquivo.lastIndexOf("."))).toLowerCase();
       //alert (extensao);
       //comprovo se a extensÃ£o estÃ¡ entre as permitidas
       permitida = false;
       for (var i = 0; i < extensoes_permitidas.length; i++) {
          if (extensoes_permitidas[i] == extensao) {
           return true;
          break;
          }
       }
       
    
    
    return false;
 } 


 function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;

    strCPF = strCPF.replace(/[^\d]+/g,'');

  if (strCPF == "00000000000") return false;

  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}


function validarCNPJ(cnpj) {
 
            cnpj = cnpj.replace(/[^\d]+/g,'');
        
            if(cnpj == '') return false;
            
            if (cnpj.length != 14)
                return false;
        
            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" || 
                cnpj == "11111111111111" || 
                cnpj == "22222222222222" || 
                cnpj == "33333333333333" || 
                cnpj == "44444444444444" || 
                cnpj == "55555555555555" || 
                cnpj == "66666666666666" || 
                cnpj == "77777777777777" || 
                cnpj == "88888888888888" || 
                cnpj == "99999999999999")
                return false;
                
            // Valida DVs
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0,tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
                
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0,tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;
                
            return true;
    
}