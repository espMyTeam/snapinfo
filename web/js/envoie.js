function envoieEnregStructure()
   {
       $(function()
       {
           var param="../web/admin.php?nomStruct="+$('#addNomStructure').val()+"&longStruct="+$('#addLongStructure').val()+"&latStruct="+$('#addLatStructure').val()+"&action=ajouter";
           $.ajax({
           type: 'POST',
           url: param, timeout: 3000,
           success: function(data)
           {

           }, error: function() {
           alert('La requête n\'a pas abouti'); } });
       });
   }
   function envoieModifStructure(id)
      {
          $(function()
          {
              var param="../web/admin.php?nomStruct="+$('#nomStruct'+id).val()+"&longStruct="+$('#long'+id).val()+"&latStruct="+$('#lat'+id).val()+"&idStruct="+id+"&action=modifier";
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
