<?php
require_once("DataBase.php");
class Article
{

	public function __construct()
	{	
		$this->now = date("Y-m-d");
	}
	
	
	
public function total_article()
	{
		$select = DataBase::connect()->query("select * from article ");
		
		$nbr = $select->rowcount();
		
		return $nbr;

	}

public function liste_article($id)
	{
		$select = DataBase::connect()->query("select * from article where id_jour=$id   ORDER BY id_article DESC");
		
		while($donnees = $select->fetch(PDO::FETCH_OBJ))
		{
			$id_article= $donnees->id_article;
			$titre= $donnees->titre;
			$type= $donnees->type;
			
			echo "<tr>";
			echo "<td>";
			echo $id_article;
			echo "</td>";
			echo "<td>";
			echo $titre;
			echo "</td>";
			echo "<td>";
			echo $type;
			echo "</td>";
			echo "<td>";
			echo "<a href='consulter_article.php?id=$id_article'>"; 
			echo " <img src='img/chercher.png' width='30' height='30'></img> </a>";                    
			echo "</td>";
			echo "<td>";
			echo "<a href='modifier_article.php?id=$id_article'>"; 
			echo " <img src='img/modif.jpg' width='30' height='30'></img> </a>";                    
			echo "</td>";
			echo "<td>";
			echo "<a href='supprimer_article.php?id=$id_article'  onclick='if (confirm(&quot;Voulez vous vraiment supprimer le Personnel: ".$titre."  ?&quot;)) { return true; } return false;'>"; 
			echo " <img src='img/del.png' width='30' height='30'></img> </a>";                    
			echo "</td>";
			echo "</tr>";
		}
	}
	

		public function ajouter_article($titre,$type,$texte,$img,$id)
	{
		$insert = DataBase::connect()->prepare('insert into article VALUES
		(NULL,:date,:titre,:type,:texte,:img,:id_jour)');
try {		
	$ins = $insert->execute(
	array(
	'date'=>$this->now,
	'titre'=>$titre,
	'type'=>$type,
	'texte'=>$texte,
	'img'=>$img,
	'id_jour'=>$id
	)
	);
}
		catch( Exception $e )
			{
	  
					echo 'Erreur de requète : ', $e->getMessage();
	
			}
			
		return true;
	}
	

	public function select_article($id)
	{
		
		$select = DataBase::connect()->query("select * from article where id_article=$id");
		$liste = $select->fetchAll(PDO::FETCH_ASSOC);
		return $liste;
		
	}


	public function supprimer_article($id)
	{
		$delete = DataBase::connect()->query("delete from article where id_article = '$id'");
		if($delete)
		{
			return true;
		}
	}



public function chercher_article($id,$titre)
	{	
	
	if($titre!=NULL){
		$select = DataBase::connect()->query("select * from article  where (titre like '%$titre%') and (id_jour=$id) ");
		
		if($select->rowcount()>0){
			echo"<br><br><table class='table table-responsive table-bordered table-hover'>";
		echo "<thead>
		<tr>
		<th>ID</th><th>Titre</th><th>Type</th><th></th><th></th><th></th>
		</tr>
		</thead>";
		while($donnees = $select->fetch(PDO::FETCH_OBJ))
		{
			$id_article= $donnees->id_article;
			$titre= $donnees->titre;
			$type= $donnees->type;
			
			echo "<tr>";
			echo "<td>";
			echo $id_article;
			echo "</td>";
			echo "<td>";
			echo $titre;
			echo "</td>";
			echo "<td>";
			echo $type;
			echo "</td>";
			echo "<td>";
			echo "<a href='consulter_article.php?id=$id_article'>"; 
			echo " <img src='img/chercher.png' width='30' height='30'></img> </a>";                    
			echo "</td>";
			echo "<td>";
			echo "<a href='modifier_article.php?id=$id_article'>"; 
			echo " <img src='img/modif.jpg' width='30' height='30'></img> </a>";                    
			echo "</td>";
			echo "<td>";
			echo "<a href='supprimer_article.php?id=$id_article'  onclick='if (confirm(&quot;Voulez vous vraiment supprimer le Personnel: ".$titre."  ?&quot;)) { return true; } return false;'>"; 
			echo " <img src='img/del.png' width='30' height='30'></img> </a>";                    
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		} else 
		{
			echo "<br><br><center><h4>Aucun resultat</center></h4>";
		}
	
	}

 }
 

 
 public function modifier_article($id,$titre,$texte,$img)
	{
	
		$up = DataBase::connect()->prepare('update  article SET
		titre=:titre,texte=:texte,img=:img where id_article=:id');
try {		
	$update = $up->execute(
	array(
	'titre'=>$titre,
	'texte'=>$texte,
	'img'=>$img,
	'id'=>$id
	
	)
	);
	
}
		catch( Exception $e )
			{
	  
					echo 'Erreur de requète : ', $e->getMessage();
	
			}
			
		return true;
		
	}








 }
 
?>