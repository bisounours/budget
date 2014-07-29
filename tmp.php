$liste_user = user::select($database,null);
		//il existe au moins un user
		if(sizeof($liste_user) > 0){
			if(isset($_GET["bad"])){
				$template->assign("message","Utilisateur inconnu");
			}else{
				$template->assign("message","");
			}
			$template->draw('identification');
		}else{
			//pas d'utilisateur, on redirige vers le formulaire de création de user
			$template->draw('first_create_user');
		}
		exit;