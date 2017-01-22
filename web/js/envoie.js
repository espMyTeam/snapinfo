function envoieEnregStructure()
 {
     $(function()
     {
         //var param="../web/admin.php?nomStruct="+$('#addNomStructure').val()+"&longStruct="+$('#addLongStructure').val()+"&latStruct="+$('#addLatStructure').val()+"&action=ajouter";
         var param="../web/admin.php?nomStruct="+$('#addNomStructure').val()+"&longStruct="+$('#addLongStructure').val()+"&latStruct="+$('#addLatStructure').val()+"&action=ajouter&adresse="+$('#addAddStructure').val()+"&contact1="+$('#addLatStructure').val()+"&contact2="+$('#addCon1Structure').val()+"&mail="+$('#addEmailStructure')+"&type="+$('#addTypeStructure');
         $.ajax({
         type: 'POST',
         url: param,
         timeout: 3000,
         //data: {'nomStruct':$('#addNomStructure').val(),'longStruct':$('#addLongStructure').val(),'latStruct':$('#addLatStructure').val(),'adresse':$('#addAddStructure').val(),'contact1':$('#addLatStructure').val(),'contact2':$('#addCon1Structure').val(),'mail':$('#addEmailStructure'),'action':"ajouter"},
         success: function(data)
         {

         }, error: function() {
         alert('La requête n\'a pas abouti'); } });
     });
 }

function envoieTypeStructure()
{
  $(function()
   {
       var param = "../web/admin.php?typeStructure="+$('#addTypeStructure').val()+"&action=ajouterType";
       $.ajax({
         type: 'POST',
         url: param,
         timeout: 3000,
         //data: {'nomStruct':$('#addNomStructure').val(),'longStruct':$('#addLongStructure').val(),'latStruct':$('#addLatStructure').val(),'adresse':$('#addAddStructure').val(),'contact1':$('#addLatStructure').val(),'contact2':$('#addCon1Structure').val(),'mail':$('#addEmailStructure'),'action':"ajouter"},
         success: function(data)
         {

         }, error: function() {
         alert('La requête n\'a pas abouti'); } });
    });

}



function envoieModifStructure(id,id2)
      {
          $(function()
          {
              var param="../web/admin.php?nomStruct="+$('#nomStruct'+id).val()+"&longStruct="+$('#long'+id).val()+"&latStruct="+$('#lat'+id).val()+"&idStruct="+id2+"&action=modifier";
              console.log($('#nomStruct'+id).val());
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
    {
        var param="../web/admin.php?idStruct="+id+"&action=supprimer";
        $.ajax({
        type: 'POST',
        url: param, timeout: 3000,
        success: function(data)
        {
           //window.location.href="../web/admin.php";
        }, error: function() {
        alert('La requête n\'a pas abouti'); } });
    });
}
