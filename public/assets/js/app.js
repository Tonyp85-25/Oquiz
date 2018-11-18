var app = {

   init: function() {


    // J'intercepte l'event "submit" du formulaire de login
    $('#formLogin').on('submit', app.submitFormLogin);

    // J'intercepte l'event "submit" du formulaire de quiz
    $('#formQuiz').on('submit', app.submitFormQuiz);

    },
    
    submitFormLogin: function(evt) {
    // Ne pas oublier d'annuler le fonctionnement par défaut (= rechargement de la page)
    evt.preventDefault();

    // Je récupère toutes les données du formulaire
    var formData = $(this).serialize();



    // Appel Ajax
    $.ajax({
      url: BASE_PATH+'/signin/', // URL appelée par Ajax
      dataType: 'json', // le type de donnée reçue
      method: 'POST', // la méthode HTTP de l'appel Ajax
      data: formData // Les données envoyés avec l'appel Ajax
    }).done(function(response) {
      console.log(response);
      // Si tout est ok
      if (response.code == 1) {
        alert('Connexion réussie');
        // redirection vers l'url fournie
        location.href = response.url;
      }
      // Sinon, il y a eu des erreurs
      else {
        // Je vide la div des "erreurs"
        $('#errorsDiv').html('');
        // Je parcours la liste des erreurs
        response.errorList.forEach(function(value, index) {
          $('#errorsDiv').append(value+'<br>');
        });
        // J'affiche ma div cachée
        $('#errorsDiv').show();
      }
    }).fail(function() {
      alert('Error in ajax');
    });
  },

  //traitement du formulaire de quiz
  // submitFormQuiz : function (evt) {
  //   evt.preventDefault();

  //   // Je récupère toutes les données du formulaire
  //   var formData = $(this).serialize();

  //   $.ajax({
  //     url: BASE_PATH+'/quiz/[i:id]', // URL appelée par Ajax
  //     dataType: 'json', // le type de donnée reçue
  //     method: 'POST', // la méthode HTTP de l'appel Ajax
  //     data: formData // Les données envoyés avec l'appel Ajax

  //     }).done(function(response) {
  //       console.log(response);
  //       // Si tout est ok
  //       if (response.code == 1) {
  //         alert('Connexion réussie');
  //         $('#newgame').hide();
  //         $('#result').show();
  //         $('#score').text('');
  //         $('#score').text(score);
  //       }
  //     }).fail(function() {
  //     alert('Error in ajax');
  //   });
 // },


};



$(app.init);
