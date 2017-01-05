<?php
    //fonction de calcul d'age
	function age($date)
	{
		$now=date("Y-m-d");
        
        $diffjour=floor((strtotime($now)-strtotime($date))/86400);
        if ($diffjour<30)
        {
            $jour=$diffjour." jours";
        }
        else if($diffjour<30*24)
        {
            $moiss=floor($diffjour/30)." mois";
			$jour=floor($diffjour%30)." jours";
			
        }
        else 
		{
		  $an=floor($diffjour/(365))." ans";
		  $jourrestant=floor($diffjour%(365));
		  $moiss=floor($jourrestant/30)." mois";
		  $jour=floor($jourrestant%30)." jours";
        }
        return $an." ".$moiss;
	}

	//fonction de formatage de date
	function formatDate($date)
	{
		$ladate=explode("-",$date); 
		return $ladate[2]."/".$ladate[1]."/".$ladate[0];
	}
	//fonction de formatage de date
	function formatDateHeure($date)
	{
		$donnees=explode(" ",$date);
		$ladate=explode("-",$donnees[0]);
		return $ladate[2]."/".$ladate[1]."/".$ladate[0]." ".$donnees[1];
	}

?>
	
