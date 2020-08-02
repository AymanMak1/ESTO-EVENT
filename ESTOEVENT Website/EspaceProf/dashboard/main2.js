$.getScript("./js/sweetalert2.all.min.js", function () {
  console.log("Script loaded but not necessarily executed.");
});

$(document).ready(function () {
  tableEvents = $("#tableEvents").DataTable({
    columnDefs: [
      {
        width: "100%",
        // "targets": -1,
        data: null,
        // "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEdit'>Modifier</button><button class='btn btn-danger btnDelete'>Supprimer</button></div></div>"
      },
    ],

    language: {
      lengthMenu: "Afficher les enregistrements _MENU_",
      zeroRecords: "Aucun résultat trouvé",
      info:
        "Affichage des enregistrements de _START_ à _END_ sur un total de _TOTAL_ enregistrements",
      infoEmpty:
        "Affichage des enregistrements de 0 à 0 sur un total de 0 enregistrements",
      infoFiltered: "(filtré un total d'enregistrements _MAX_)",
      sSearch: "Chercher:",
      oPaginate: {
        sFirst: "Premier",
        sLast: "Dernier",
        sNext: "Suivant",
        sPrevious: "Précedent",
      },
      sProcessing: "Traitement ...",
    },
  });

  $("#btnAdd").click(function () {
    $("#formEvents").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nouveau évenement");
    $("#modalCRUD").modal("show");
    //ID_Evenement=0;
    option = 1; //ajouter
  });

  var fila; //capturer la ligne pour modifier ou supprimer l'enregistrement

  $("#formEvents").submit(function (e) {
    e.preventDefault();
    document.querySelector("#photoEvent").required = true;
    document.querySelector("#ddEvent").required = true;
    document.querySelector("#ddtEvent").required = true;
    document.querySelector("#dfEvent").required = true;
    document.querySelector("#dftEvent").required = true;
    ID_Evenement = parseInt($(this).closest("tr").find("td:eq(0)").text());
    ID_Departement = $.trim($("#nomDept").val());
    Nom_Departement = "";
    if (ID_Departement == 1) {
      Nom_Departement = "genie informatique";
    } else if (ID_Departement == 2) {
      Nom_Departement = "genie applique";
    } else {
      Nom_Departement = "management";
    }

    sujetEvent = $.trim($("#sujetEvent").val());
    descriptionEvent = $.trim($("#descriptionEvent").val());
    photoEvent2 = $("input[type=file]").val().split("\\").pop();
    photoEvent = $("#photoEvent").prop("files")[0];
    dateDebut =
      $.trim($("#ddEvent").val()) + " " + $.trim($("#ddtEvent").val());
    dateFin = $.trim($("#dfEvent").val()) + " " + $.trim($("#dftEvent").val());
    var form_data = new FormData();
    form_data.append("ID_Evenement", ID_Evenement);
    form_data.append("ID_Departement", ID_Departement);
    form_data.append("sujetEvent", sujetEvent);
    form_data.append("descriptionEvent", descriptionEvent);
    form_data.append("photoEvent", photoEvent);
    form_data.append("dateDebut", dateDebut);
    form_data.append("dateFin", dateFin);
    form_data.append("option", option);

    action =
      "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEdit'>Modifier</button><button class='btn btn-danger btnDelete'>Supprimer</button></div></div>";

    if (dateFin <= dateDebut) {
      alert("Veuillez saisir une date fin superieure a date debut");
    } else {
      if (/\s/.test(photoEvent2)) {
        alert(
          "Le nom de photo ne peut pas contenir d'espace. S’il vous plaît renommer la photo."
        );
      } else {
        $.ajax("bd/crud.php", {
          type: "POST", // http method
          //  processData: false, contentType: false,
          // data: { ID_Evenement: ID_Evenement, ID_Departement:ID_Departement, sujetEvent:sujetEvent, descriptionEvent:descriptionEvent,photoEvent:photoEvent,dateDebut:dateDebut,dateFin:dateFin,option:option },  // data to submit
          data: form_data,
          dataType: "script",
          cache: false,
          contentType: false,
          processData: false,
          success: function (data, status, xhr) {
            console.log(data);
            if (option == 1) {
              tableEvents.row
                .add([
                  Nom_Departement,
                  sujetEvent,
                  descriptionEvent,
                  dateDebut,
                  dateFin,
                  action,
                ])
                .draw();
              Swal.fire({
                icon: "success",
                title: "L'évènement a été bien ajoutée",
                showConfirmButton: false,
                timer: 1500,
              });
              $("#modalCRUD").modal("hide");
            } else {
              tableEvents
                .row(fila)
                .data([
                  ID_Evenement,
                  Nom_Departement,
                  sujetEvent,
                  descriptionEvent,
                  dateDebut,
                  dateFin,
                ])
                .draw();
            }
          },
          error: function (jqXhr, textStatus, errorMessage) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
            });
          },
        });
      }
    }
  });

  //bouton supprimer

  $(document).on("click", ".btnDelete", function () {
    fila = $(this);
    ID_Evenement = parseInt($(this).closest("tr").find("td:eq(0)").text());
    option = 3; //supprimer
    var respuesta = Swal.fire({
      title: "Vous êtes sure de supprimer cet évènement?",
      text: "Vous ne serez pas en mesure de revenir !",
      icon: "warning",
      showCancelButton: true,
      cancelButtonText: "Annuler",
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Supprimer !",
    }).then((result) => {
      if (result.value) {
        $.ajax("bd/crud.php", {
          type: "POST",
          data: { option: option, ID_Evenement: ID_Evenement },
          success: function () {
            tableEvents.row(fila.parents("tr")).remove().draw();
          },
        });
        Swal.fire("Supprimé !", "l'évènement a été supprimé.", "success");
      }
    });
    /*
    if(respuesta){
        $.ajax('bd/crud.php', {
            type: "POST",
            data: {option:option, ID_Evenement:ID_Evenement},
            success: function(){
                tableEvents.row(fila.parents('tr')).remove().draw();
            }
        });
    }  
    */
  });

  //bouton modifier

  $(document).on("click", ".btnEdit", function () {
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Modifier");
    $("#modalCRUD").modal("show");
    option = 2; //modifier
    document.querySelector("#photoEvent").required = false;
    document.querySelector("#ddEvent").required = false;
    document.querySelector("#ddtEvent").required = false;
    document.querySelector("#dfEvent").required = false;
    document.querySelector("#dftEvent").required = false;

    fila = $(this).closest("tr");
    ID_Evenement = parseInt($(this).closest("tr").find("td:eq(0)").text());
    Nom_Departement = fila.find("td:eq(1)").text();
    valDept = 0;
    if (Nom_Departement == "genie informatique") {
      valDept = 1;
    } else if (Nom_Departement == "genie applique") {
      valDept = 2;
    } else {
      valDept = 3;
    }
    sujetEvent = fila.find("td:eq(2)").text();
    descriptionEvent = fila.find("td:eq(3)").text();
    photoEvent = fila.find("td:eq(4)").text();
    dateDebut = fila.find("td:eq(5)").text();
    dateFin = fila.find("td:eq(6)").text();

    $("#nomDept").val(valDept);
    ID_Departement = $.trim($("#nomDept").val());

    $("#sujetEvent").val(sujetEvent);

    //alert($("span#threePoints").text());
    $("#descriptionEvent").val(descriptionEvent);

    $("#photoEvent").val(photoEvent);
    /*
    $("#ddEvent").val(dateDebut);
    $("#dFEvent").val(dateFin);
    
    $.ajax('bd/crud.php', {
        type: 'POST',  // http method
        data: { ID_Departement:ID_Departement, sujetEvent:sujetEvent, descriptionEvent:descriptionEvent,photoEvent ,dateDebut:dateDebut,dateFin:dateFin, option:option },  // data to submit
        success: function (data, status, xhr) {
            console.log(data);
            if(option == 1){tableEvents.row.add([Nom_Departement,sujetEvent,descriptionEvent,dateDebut, dateFin]).draw();}
            else{tableEvents.row(fila).data([Nom_Departement,sujetEvent,descriptionEvent,dateDebut, dateFin]).draw();}          
        },
        error: function (jqXhr, textStatus, errorMessage) {
               // $('p').append('Error' + errorMessage);
        }
    });
    */
  });
});
