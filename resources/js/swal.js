$(document).ready(function(){

   var contact_id;
   $('#add').on('click', function(){
                sendingform();//
    });//
    $('.show').on('click', function(){
        contact_id = $(this).parent().siblings(".id").text();
        getdataform(contact_id);
    });//
    $('.edit').on('click', function(){
        contact_id = $(this).parent().siblings(".id").text();
        getdataform(contact_id);
    });//
    $('#update').on('click', function(){
        updatedata(contact_id);
    });//
    $('.delete').on('click', function(){
        contact_id = $(this).parent().siblings(".id").text();
        confirmDeleteNotification(contact_id);
    });//

    var confirmCreateNotification = function(value) {
        swal({
            title: "Doublon",
            text: value + '\n Etes-vous sûr de vouloir ajouter ce contact? ',
            icon: "warning",       
            dangerMode: true,
            buttons: {
                cancel: {
                  text: "Annuler",
                  value: "cancel",
                  visible: true,
                  className: "",
                  closeModal: false,
                },
                confirm: {
                  text: "Confirmer",
                  value: "confirmation",
                  visible: true,
                  className: "",
                  closeModal: true
                }
              }
          })
          .then((value) => {
                switch (value) {
                    case "confirmation":
                        $("#confirmation").text("true");//
                        $('.errorsform').text('');//
                        sendingform();//
                    break;
                
                    case "cancel":               
                        $('#create_form')[0].reset();//
                        $('.modal').modal('toggle');//
                        $('.errorsform').text('');//
                        swal( "opération annulée");//
                    break;
                
                    default:
                    swal("Got away safely!");//
                }
            });//
    };//
    var confirmDeleteNotification = function(contact_id) {
        swal({
            title: "Supprimer le contact",
            text: '\n Etes-vous sûr de vouloir supprimer le contact? \n Cette opération est irreversible',
            icon: "warning",       
            dangerMode: true,
            buttons: {
                cancel: {
                  text: "Annuler",
                  value: "cancel",
                  visible: true,
                  className: "",
                  closeModal: false,
                },
                confirm: {
                  text: "Confirmer",
                  value: "confirmation",
                  visible: true,
                  className: "",
                  closeModal: true
                }
              }
          })
          .then((value) => {
                switch (value) {
                    case "confirmation":
                        $("#confirmation").text("true");//
                        deletedata(contact_id);//
                    break;
                
                    case "cancel":               
                        swal( "opération annulée");//
                    break;
                
                    default:
                    swal("Got away safely!");//
                }
            });//
    };//
    var succesNotification = function(value){
        if(value == 'create_modal') {
            $('#create_modal').modal('toggle');//
        }
        if(value == 'edit_modal') {
            $('#edit_modal').modal('toggle');//
        }

        $('form')[0].reset();//
        $('.errorsform').text('');
        swal({
            text: 'Opération effectuée avec succès',
            buttons: {
                confirm: {
                  text: "Confirmer",
                  visible: false,
                  className: "",
                  closeModal: true
                }
              }
        }).then(
            location.reload(true)
        );//
    }
    var sendingform = function() {
        $('.errorsform').text('');//
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//
        var data = new FormData();
        prenom= $("#create_modal #prenom").val();
        nom= $("#create_modal #nom").val();
        email= $("#create_modal #email").val();
        entreprise= $("#create_modal #entreprise").val();
        adresse= $("#create_modal #adresse").val();
        code_postal= $("#create_modal #code_postal").val();
        ville= $("#create_modal #ville").val();
        statut= $("#create_modal #statut").val();
        confirmation= $("#create_modal #confirmation").text();


        data.append('prenom', prenom);
        data.append('nom', nom);
        data.append('email', email);
        data.append('entreprise', entreprise);
        data.append('adresse', adresse);
        data.append('code_postal', code_postal);
        data.append('ville', ville);
        data.append('statut', statut);
        data.append('confirmation', confirmation);


            $.ajax({
                url: '/create-contact',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    $.each(data, function (key, value) {
                        if( value == 'success'){
                            succesNotification('create_modal');
                        }else {
                            confirmCreateNotification(value);
                        }

                    });//
                    
                },
                error: function (data) {
                    
                    $.each(data, function (key, value) {
                        if(value['message']){
                            $('.errorsform').empty();
                            $('.errorsform').append( value['message']+'\n' );
                        }
                    });//

                },
            
            });//
    };//
    var getdataform = function(contact_id) {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//

        var data = new FormData();//
        var id =contact_id;//
         data.append("contact_id", id);//

      $.ajax({
          url: '/contact',
          data: data ,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          type: 'POST',
          success: function (data) {
              $.each(data, function (key, value) {

                    $("#show_modal #prenom, #edit_modal #prenom").val( value[0].prenom );
                    $("#show_modal #nom, #edit_modal #nom").val( value[0].nom );
                    $("#show_modal #email, #edit_modal #email").val( value[0].e_mail );
                    $("#show_modal #entreprise, #edit_modal #entreprise").val( value[0].organisationNom );
                    $("#show_modal #adresse, #edit_modal #adresse").val( value[0].adresse );
                    $("#show_modal #code_postal, #edit_modal #code_postal").val( value[0].code_postal );
                    $("#show_modal #ville, #edit_modal #ville").val( value[0].ville );
                    $("#show_modal #statut, #edit_modal #statut").val( value[0].statut );

              });//
             
          },
      
      });//
    };//
    var updatedata = function(contact_id) {
        $('.errorsform').text('');//
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//
        var data = new FormData();
        var id= contact_id;
        prenom= $("#edit_modal #prenom").val();
        nom= $("#edit_modal #nom").val();
        email= $("#edit_modal #email").val();
        entreprise= $("#edit_modal #entreprise").val();
        adresse= $("#edit_modal #adresse").val();
        code_postal= $("#edit_modal #code_postal").val();
        ville= $("#edit_modal #ville").val();
        statut= $("#edit_modal #statut").val();
        confirmation= $("#edit_modal #confirmation").text();

        data.append('contact_id', id);
        data.append('prenom', prenom);
        data.append('nom', nom);
        data.append('email', email);
        data.append('entreprise', entreprise);
        data.append('adresse', adresse);
        data.append('code_postal', code_postal);
        data.append('ville', ville);
        data.append('statut', statut);
        data.append('confirmation', confirmation);


      $.ajax({
          url: '/contact/update',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          type: 'POST',
          success: function (data) {
              $.each(data, function (key, value) {
                if( value == 'success'){
                    succesNotification('edit_modal');
                }
              });// 
          },
          error: function (data) {
              $.each(data, function (key, value) {
                  if(value['message']){
            
                      $('.errorsform').append( value['message']+'\n' );
                  }
              });//
          },
      
      });//

    };//
    var deletedata = function(contact_id) {
        $('.errorsform').text('');//
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//
        var data = new FormData();
        var id= contact_id;
        data.append('contact_id', id);
        $.ajax({
            url: '/contact/delete',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            type: 'POST',
            success: function (data) {
                $.each(data, function (key, value) {
                    if( value == 'success'){
                        succesNotification('');
                    }
                });// 
            },
        
        });//

    };//
 
})