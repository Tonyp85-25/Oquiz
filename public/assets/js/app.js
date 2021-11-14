var app = {

  init: function() {


    // J'intercepte l'event "submit" du formulaire de login
    $('#formLogin').on('submit', app.submitFormLogin);

    // J'intercepte l'event "submit" du formulaire de quiz
    $('#formQuiz').on('submit', app.submitFormQuiz);
    //on affiche ou non le compte test
    $('#see').on('click', app.toggleIds);

  },
    
  submitFormLogin: function(evt) {
    // Ne pas oublier d'annuler le fonctionnement par défaut (= rechargement de la page)
    evt.preventDefault();

    // Je récupère toutes les données du formulaire
    var formData = $(this).serialize();
    // Appel Ajax
    $.ajax({
      url: BASE_PATH +'/signin/', // URL appelée par Ajax
      dataType: 'json', // le type de donnée reçue
      method: 'POST', // la méthode HTTP de l'appel Ajax
      data: formData // Les données envoyés avec l'appel Ajax
    }).done(function(response) {
      
      // Si tout est ok
      if (response.code === 1) {
        alert('Connexion réussie! Vous allez être redirigé(e) vers la page d\'accueil');
        // redirection vers l'url fournie
        location.href = response.url;        
      }
      // Sinon, il y a eu des erreurs
      else {
        // Je vide la div des "erreurs"
        $('#errorsDiv').html('');
        // Je parcours la liste des erreurs
        response.errorList.forEach(function(value) {
          $('#errorsDiv').append(value+'<br>');
        });
        // J'affiche ma div cachée
        $('#errorsDiv').show();
      }
    }).fail(function(object, text) {
      
      alert('Error in ajax: '+ text);
     
      
    });
  },

  toggleIds: function(){
    $('#identifiers').toggle();
  },

  //traitement du formulaire de quiz
  submitFormQuiz : function (evt) {
    evt.preventDefault();

    // Je récupère toutes les données du formulaire
    var formData = $(this).serialize();

    $.ajax({
      url: BASE_PATH+'/quiz/'+quizId, // URL appelée par Ajax
      dataType: 'json', // le type de donnée reçue
      method: 'POST', // la méthode HTTP de l'appel Ajax
      data: formData // Les données envoyés avec l'appel Ajax

    }).done(function(response) {
      // console.log(response);
      // Si tout est ok
      if (response.code == 2) {
        // alert('Connexion réussie');
        $('.newgame').hide();
        $('.result').show();
        $('#score').text('');
        $('#score').text(response.score + ' / '+ response.total );
        
        //on affiche la bonne couleur selon la réponse et on affiche l'anecdote si l'utilisateur a répondu à la question
        for (prop in response.results) {
          // console.log(response.results[prop]);
          
         if (response.results[prop] === 'true') {
           $('#header_'+prop).css('background-color', '#d4edda');
           $('#anecdote_'+prop).show();
         }
         if (response.results[prop] === 'false') {
          $('#header_'+prop).css('background-color', '#e48f6f');
          $('#anecdote_'+prop).show();
        }  
        } 
       
      }
    }).fail(function() {
      alert('Error in ajax');
    });
  },


};



$(app.init);
