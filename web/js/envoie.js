function envoieEnregQuartier()
{
    $(function()
     {
         var param="../web/LoadAdmin.php?nomQuartier="+$('#addNomQuartier').val()+"&structure="+$('#addStrucureQuartier').val()+"&typeStructure="+$('#addTypeStrucureQuartier').val()+"&action=ajouterQuartier";
        $.ajax({
         type: 'POST',
         url: param,
         timeout: 3000,
         //data: {'nomStruct':$('#addNomStructure').val(),'longStruct':$('#addLongStructure').val(),'latStruct':$('#addLatStructure').val(),'adresse':$('#addAddStructure').val(),'contact1':$('#addLatStructure').val(),'contact2':$('#addCon1Structure').val(),'mail':$('#addEmailStructure'),'action':"ajouter"},
         success: function(data)
         {            
             //document.reload.href="LoadAdmin.php";
             location.reload();
         }, error: function() {
         alert('La requête n\'a pas abouti'); } });
     });
    
}
  
function alertBi()
    {
        $( "#dialogue" ).dialog({
            //position:
            modal: false,
            position: { my: "center", at: "center", of: window },
            buttons: {
                "Oui": function() { 
                    location.reload();
                    document.location.href="accueil.php?";
                    
                },
                "Non": function() {
                    $( this ).dialog( "close" ); 
                }
            } 
        });
    }    


function envoieEnregStructure()
 {
     $(function()
     {
         //var param="../web/admin.php?nomStruct="+$('#addNomStructure').val()+"&longStruct="+$('#addLongStructure').val()+"&latStruct="+$('#addLatStructure').val()+"&action=ajouter";
         //$typeStruture, $libelle, $adresse, $contact1, $contact2, $mail, $latitude, $longitude, $zone
         var param="../web/LoadAdmin.php?nomStruct="+$('#addNomStructure').val()+"&longStruct="+$('#addLongStructure').val()+"&latStruct="+$('#addLatStructure').val()+"&action=ajouter&adresse="+$('#addAddStructure').val()+"&contact1="+$('#addCon1Structure').val()+"&contact2="+$('#addCon2Structure').val()+"&mail="+$('#addEmailStructure').val()+"&type="+$('#addTypeStructure').val()+"&zone="+$('#addZoneStructure').val();
         $.ajax({
         type: 'POST',
         url: param,
         timeout: 3000,
         //data: {'nomStruct':$('#addNomStructure').val(),'longStruct':$('#addLongStructure').val(),'latStruct':$('#addLatStructure').val(),'adresse':$('#addAddStructure').val(),'contact1':$('#addLatStructure').val(),'contact2':$('#addCon1Structure').val(),'mail':$('#addEmailStructure'),'action':"ajouter"},
         success: function(data)
         {
             //document.reload.href="LoadAdmin.php";
             location.reload();
         }, error: function() {
         alert('La requête n\'a pas abouti'); } });
     });
 }
 
 
 function envoieEnregUser()
 {
     $(function()
     {
         var param="../web/LoadAdmin.php?nomUser="+$('#addNomuser').val()+"&prenomUser="+$('#addPrenomUser').val()+"&loginUser="+$('#addLoginUser').val()+"&action=ajouterUser&passwdUser="+$('#addPasswdUser').val()+"&telUser="+$('#addTeluser').val()+"&mailUser="+$('#addMailUser').val()+"&StructUser="+$('#addStrucureUser').val();
         $.ajax({
         type: 'POST',
         url: param,
         timeout: 3000,
         //data: {'nomStruct':$('#addNomStructure').val(),'longStruct':$('#addLongStructure').val(),'latStruct':$('#addLatStructure').val(),'adresse':$('#addAddStructure').val(),'contact1':$('#addLatStructure').val(),'contact2':$('#addCon1Structure').val(),'mail':$('#addEmailStructure'),'action':"ajouter"},
         success: function(data)
         {
             location.reload();
             //document.reload.href="LoadAdmin.php";       
         }, error: function() {
         alert('La requête n\'a pas abouti'); } });
     });
 }
 

function envoieTypeStructure()
{
  $(function()
   {
       var param = "../web/admin.php?typeStructure="+$('#addNewTypeStructure').val()+"&action=ajouterType";
       $.ajax({
         type: 'POST',
         url: param,
         timeout: 3000,
         //data: {'nomStruct':$('#addNomStructure').val(),'longStruct':$('#addLongStructure').val(),'latStruct':$('#addLatStructure').val(),'adresse':$('#addAddStructure').val(),'contact1':$('#addLatStructure').val(),'contact2':$('#addCon1Structure').val(),'mail':$('#addEmailStructure'),'action':"ajouter"},
         success: function(data)
         {
             location.reload();
         }, error: function() {
         alert('La requête n\'a pas abouti'); } });
    });

}



function envoieModifStructure(id,id2)
{
    $(function()
    {
        var param="../web/admin.php?nomStruct="+$('#nomStruct'+id).val()+"&longStruct="+$('#long'+id).val()+"&latStruct="+$('#lat'+id).val()+"&idStruct="+id2+"&action=modifier";
        $.ajax({
        type: 'POST',
        url: param, timeout: 3000,
        success: function(data)
        {

        }, error: function() {
        alert('La requête n\'a pas abouti'); } });
    });
}

function envoieDeleteStructure(id)
{   
    $(function()
    {   $( "#loading" ).show();
        var param="../web/admin.php?idStruct="+id+"&action=supprimer";
        $.ajax({
            type: 'POST',
            url: param, timeout: 3000,
            success: function(data)
            {
               //window.location.href="../web/admin.php";
               location.reload();
               $("#loading").hide();
            }, error: function() {
                alert('La requête n\'a pas abouti');
                $("#loading").hide();
            } 
        });
        
    });
}
