
function load(){
var deleteButton = document.querySelector('.delete_confirm');
var editButton = document.getElementById('editWorkshop');

deleteButton.addEventListener('click', function(event) {
      event.preventDefault();

      var choice = confirm(this.getAttribute('data-confirm'));

      if (choice) {
            	// Does the process using AJAX or something else

      	//window.location.href  = this.formAction
      	var server_message = "Votre atelier a bien été supprimé"
      	 confirm(server_message);

      }
  });


editButton.addEventListener('click', function(event) {
      if(document.getElementById('workshopSelector').selectedIndex == -1){
      		alert('Veuillez sélectionnez l\'atelier a modifié')
      		event.preventDefault();
      }

      
  });


}


