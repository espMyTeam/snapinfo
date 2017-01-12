<?php
	$file_path = "../uploads/";
    
    if(isset($_FILES)){
    	$fileName = basename( $_FILES['uploaded_file']['name']);
    	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
    	$taille = filesize($_FILES['uploaded_file']['tmp_name']);
    	

        $filePath = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $filePath = preg_replace('/([^.a-z0-9]+)/i', '-', $filePath);
        $filePath = "uploads/$filePath";

	    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $filePath) ){
	    	
	        echo "success";
	    } else{
	        echo "fail" . $_FILES['uploaded_file']['name'];
	    }
    } 
    else{
    	echo "mdrrr";
    }
    

?>