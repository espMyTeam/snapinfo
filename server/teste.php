<?php
	$file_path = "uploads/";
    if(isset($_POST['name']))
	echo "bienvenue " . $_POST['name'];
    else if(isset($_FILES)){
    	$fileName = basename( $_FILES['photo']['name']);
    	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
    	$taille = filesize($_FILES['photo']['tmp_name']);
    	

        $filePath = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $filePath = preg_replace('/([^.a-z0-9]+)/i', '-', $filePath);
        $filePath = "uploads/$filePath";

	    if(move_uploaded_file($_FILES['photo']['tmp_name'], $filePath) ){
	    	
	        echo "success";
	    } else{
	        echo "fail" . $_FILES['photo']['name'];
	    }
    } 
    else{
    	echo "mdrrr";
    }
    

?>
