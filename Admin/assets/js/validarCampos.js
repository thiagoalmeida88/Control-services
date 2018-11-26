function Validar(tipo_tela) {

    var ret = true;    

    switch(tipo_tela){
        
        case 1:
            if ($("#nome").val().trim() == "") {            
                ret = false;
                $("#val_nome").show();
                $("#val_nome").html("* Preencher o campo nome ");
            }
            else{
                $("#val_nome").hide();
            }
            if ($("#email").val().trim() == "") {            
                ret = false;
                $("#val_email").show();
                $("#val_email").html("* Preencher o campo e-mail");
            }
            else{
                $("#val_email").hide();
            }
            if ($("#perfil").val().trim() == "") {            
                ret = false;
                $("#val_perfil").show();
                $("#val_perfil").html("* Preencher o campo perfil");
            }
            else{
                $("#val_perfil").hide();
            }
            if ($("#senha").val().trim() == "") {            
                ret = false;
                $("#val_senha").show();
                $("#val_senha").html("* Preencher o campo senha");
            }
            else{
                $("#val_senha").hide();
            }
            if ($("#senhaconfirma").val().trim() == "") {            
                ret = false;
                $("#val_senhaconfirma").show();
                $("#val_senhaconfirma").html("* Preencher o campo senha confirma");
            }
            else{
                $("#val_senhaconfirma").hide();
            }
            return ret; 
        
        case 2:
            if ($("#nome").val().trim() == "") {            
                ret = false;
                $("#val_nome").show();
                $("#val_nome").html("* Preencher o campo nome ");
            }
            else{
                $("#val_nome").hide();
            }
            return ret; 
            
        case 3:
            if ($("#email").val().trim() == "") {            
                ret = false;
                $("#val_email").show();
                $("#val_email").html("* Campo email obrigatório");
            }
            else{
                $("#val_email").hide();
            }
            if ($("#senha").val().trim() == "") {            
                ret = false;
                $("#val_senha").show();
                $("#val_senha").html("* Campo senha obrigatório");
            }
            else{
                $("#val_senha").hide();
            }                                    
            return ret;
        
        case 4:
            if ($("#nome").val().trim() == "") {            
                ret = false;
                $("#val_nome").show();
                $("#val_nome").html("* Campo nome obrigatório");
            }
            else{
                $("#val_nome").hide();
            }
            if ($("#email_registro").val().trim() == "") {            
                ret = false;
                $("#val_email_registro").show();
                $("#val_email_registro").html("* Campo email obrigatório");
            }
            else{
                $("#val_email_registro").hide();
            }
            if ($("#senha_registro").val().trim() == "") {            
                ret = false;
                $("#val_senha_registro").show();
                $("#val_senha_registro").html("* Campo senha obrigatório");
            }
            else{
                $("#val_senha_registro").hide();
            }            
            if ($("#senhaconfirma_registro").val().trim() == "") {            
                ret = false;
                $("#val_senhaconfirma_registro").show();
                $("#val_senhaconfirma_registro").html("* Campo confirmar senha obrigatório");
            }
            else{
                $("#val_senhaconfirma_registro").hide();
            }            
            return ret;
        
        case 5:
            if($("#tipo").val().trim() == ""){
                ret = false;
                $("#val_tipo").show();
                $("#val_tipo").html("* Campo tipo de serviço obrigatório");
            }
            else{
                $("#val_tipo").hide();
            }
            if($("#descricao").val().trim() == ""){
                ret = false;
                $("#val_descricao").show();
                $("#val_descricao").html("* Campo descrição obrigatório")
            }
            else{
                $("#val_descricao").hide();
            }
            if($("#valor").val().trim() == ""){
                ret = false;
                $("#val_valor").show();
                $("#val_valor").html("* Campo valor obrigatório");                
            }
            else{
                $("#val_valor").hide();
            }
            if($("#data").val().trim() == ""){
                ret = false;
                $("#val_data").show();
                $("#val_data").html("* Campo data obrigatório");
            }
            else{
                $("#val_data").hide();
            }            
            return ret;
        
        default:
            return ret;
        }
    }
    
    


                