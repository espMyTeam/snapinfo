function envoieEnregStructure()
   {
       $(function()
       {
           var param="../web/admin.php?nomStruct="+$('#addNomStructure').val()+"&longStruct="+$('#addLongStructure').val()+"&latStruct="+$('#addLatStructure').val()+"&action=ajouter";
           console.log("je pense");
           $.ajax({
           type: 'POST',
           url: param, timeout: 3000,
           success: function(data)
           {

           }, error: function() {
           alert('La requête n\'a pas abouti'); } });
       });
   }
