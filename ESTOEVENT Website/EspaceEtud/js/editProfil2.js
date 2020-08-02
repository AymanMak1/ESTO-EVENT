$("#editProfilSubmit").click(function(e){
    console.log("test");
      e.preventDefault();    
      nom = $.trim($("#nom").val());
      prenom = $.trim($("#prenom").val());
      password = $.trim($("#password").val());
      if(nom == '' || prenom == '' ){
          alert("il faut remplir les deux chmps");
        
      }else if(nom.length < 4 || prenom.length < 4){     
          alert("Votre nom ou prenom sont tres court");
      }else{
        document.querySelector('#modal').style.visibility="hidden";
        console.log (nom + " " + prenom + " " + password);
            var respuesta = Swal.fire({
            title: 'Vous etes sure de modifier votre profil?',
            text: "Vous ne serez pas en mesure de revenir !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Annuler',   
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modifier !'
          }).then((result) => {
            if (result.value) {
              $.ajax('../php/editProfil.php', {
                type: 'POST',  // http method
                data: { nom:nom, prenom:prenom, password,password },  // data to submit
                success: function (data, status, xhr) {
                    console.log(data);
                    $("#nomPrenomEtud").html(nom + " " + prenom);
                    Swal.fire({
                        icon: 'success',
                        title: 'Votre Profil a été bien modifiée',
                        showConfirmButton: false,
                        timer: 1500
                      })
                   },
    
                });
                  
            }
          })
          document.querySelector('#modal').style.visibility="visible";    
      }
    
  })  