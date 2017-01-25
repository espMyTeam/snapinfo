<!DOCTYPE html>
<html>
	<head></head>
	<body>
		<h1>Testes pour la communication entre le mobile et le serveur snapinfo</h1>
		<br/><br/>
		<form method="POST" action="http://10.3.3.119/workflow/snapInfo/snapinfo/server/traitement.php" enctype="multipart/form-data" >
			Photo: <input type="file" name="photo"/><br/><br/>
			Longitude: <input type="text" name="longitude"/><br/><br/>
			Latitude: <input type="text" name="latitude"/><br/><br/>
			Commentaire: <input type="text" name="commentaire"/><br/><br/>
			Structure: <input type="text" name="typeStructure"/><br/><br/>
			Telephone: <input type="text" name="telephone"/><br/><br/>
			CellID: <input type="text" name="CellID"/><br/><br/>
			MNC: <input type="text" name="MNC"/><br/><br/>
			MCC: <input type="text" name="MCC"/><br/><br/>
			LAC: <input type="text" name="LAC"/><br/><br/>
			Operateur: <input type="text" name="operateur"/><br/><br/>
			<input type="submit" name="btnValider" value="Valider">

		</form>
	</body>
</html>
