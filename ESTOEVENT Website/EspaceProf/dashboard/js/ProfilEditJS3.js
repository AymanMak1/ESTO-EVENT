$("#formEditUser").submit(function(e){
    e.preventDefault();    
    nom = $.trim($("#nom").val());
    prenom = $.trim($("#prenom").val());
    discipline = $.trim($("#discipline").val());
    password = $.trim($("#password").val());
    photoProfil = $('#pdp').prop('files')[0];
    var form_data = new FormData();
    form_data.append("nom",nom);
    form_data.append("prenom",prenom);
    form_data.append("discipline",discipline);
    form_data.append("password",password);
    form_data.append("photoProfil",photoProfil);
    console.log (nom + " " + prenom + " " + discipline + " " + password + " " + photoProfil);
        var respuesta = Swal.fire({
        title: 'Vous êtes sure de modifier votre profil?',
        text: "Vous ne serez pas en mesure de revenir !",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Annuler',   
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Modifier !'
      }).then((result) => {
        if (result.value) {
          $.ajax('./php/editProfil.php', {
            type: 'POST',  // http method
            data: form_data,  // data to submit
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, status, xhr) {
                console.log(data);
                $("#nomProf").html(nom);
                $("#prenomProf").html(prenom);
                console.log($(".img-profile"));
                //$(".img-profile").attr('src','../../../SignUpProf/php/uploads/'+photoProfil);
            
                Swal.fire({
                    icon: 'success',
                    title: 'Votre Profil a été bien modifiée',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $("#modalUser").modal("hide");            
               },

            });
        }
      })
})  