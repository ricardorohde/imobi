<? 
	define('ID_MODULO',0,true);
	include("../includes/Config.php");
	foreach ($_POST as $campo => $valor) $$campo = processaString($valor);
	
	$Config = array(
		'arquivo'=>'professores',
		'tabela'=>'tbmaterias',
		'titulo'=>'titulo',
		'id'=>'id_materia',
		'urlfixo'=>'', 
		'pasta'=>'materias',
		'imagem'=>array(
			'x'=>500, 'y'=>500, 'corte'=>0, 
			'mini'=>array(
				'x'=>500, 'y'=>500, 'corte'=>0
			)
		),
	);

#echo db_entrada($texto); 
#exit;

	// -----------------------------------------------------------------------------------------------------------
	// Incluir ou alterar dados no banco de dados
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="dados") {


		# Testes
		$Erros='';


		# Se houver erro, SAI
		if (strlen($Erros)) { header('Location: ../sys/'.$Config['arquivo'].'_dados.php?ID='.$$cnf['id'].$Config['urlfixo'].'&erro='.urlencode("<b>Dados inv�lidos:</b>|".$Erros),true); exit; }


		# Dados
		$dados = array( 'id_categoria'=>$id_categoria, 'nome'=>$nome, 'sobre'=>$sobre, 'reel'=>$reel);


		# Arquivos
		if (!empty($_FILES['imagem']['name'])) {
			$dados['imagem'] = processaArquivo('imagem',$Config,$_FILES);
			if ($dados['imagem']==false) { header("Location: ../sys/".$Config['arquivo'].".php?erro=".urlencode('Erro processando Imagem.'),true); exit; }
		}


		# Executando 
		if ($$Config['id']>0) {

			# Apagando a Imagem se houver uma nova cadastrada
			if (strlen($dados['imagem'])>0) db_apagaArquivo('imagem',$Config,$$Config['id']);

			db_executa($Config['tabela'],$dados,'update', $Config['id'].'='.$$Config['id']);

		} else {

			$dados['data']='now()';
			$dados['id_materia']=$_SESSION['Admin']['id_materia'];
			db_executa($Config['tabela'],$dados);
			
			# Cadastrar novo endere�o
			$dados_end = array('id_categoria'=>$id_categoria);




				$$Config['id'] = db_insert_id();
			}
		
		# Permiss�es
		db_consulta("DELETE FROM liga_prof WHERE id_materia=".$$Config['id']);
		foreach ($cursos as $valor) {
			if ($valor > 0) db_executa('liga_prof',array('id_materia'=>$$Config['id'], 'id_galeria'=>$valor));
		
		}


		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito.'),true); exit;

	}












	// -----------------------------------------------------------------------------------------------------------
	// Excluir um registro e seus arquivos
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			# Apagando os arquivos 
			db_apagaArquivo('imagem',$Config,$id);
			
			# Apagando v�nculos 
			db_consulta("DELETE FROM liga_prof WHERE id_materia=".$id);
			
			# Excluindo do Bando de dados
			db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);
			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Excluido.'),true); exit;

		}
	}



	// -----------------------------------------------------------------------------------------------------------
	// Apaga v�rios itens de uma vez s�
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="excluir_massa") {
	
		if (is_array($check)) 
		foreach ($check as $id) {
			if ($id>0) {

				# Apagando os arquivos 
				db_apagaArquivo('imagem',$Config,$id);
				
				# Apagando v�nculos 
				db_consulta("DELETE FROM liga_prof WHERE id_materia=".$id);
	
				# Excluindo do Bando de dados
				db_consulta("DELETE FROM ".$Config['tabela']." WHERE ".$Config['id']."=".$id);

			}
		}
		header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Feito').$Config['urlfixo'],true); exit;
	}







	// -----------------------------------------------------------------------------------------------------------
	// Apaga um arquivo ou imagem n�o obrigat�rio
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="apaga_arquivo") {
		$id=(int)$_GET['id'];
		if ($id>0) {

			# Apagando os arquivos 
			db_apagaArquivo($_GET['coluna'],$Config,$id);

			# Excluindo do Bando de dados
			db_executa($Config['tabela'],array($_GET['coluna']=>''),'update',$Config['id']."=".$id);

			# Hist�rico
			cadHistorico(ID_MODULO,5,$id);

			header("Location: ../sys/".$Config['arquivo'].".php?msg=".urlencode('Arquivo exclu�do.').$Config['urlfixo'],true); exit;

		}
	}





	// -----------------------------------------------------------------------------------------------------------
	// Alterando flags
	// -----------------------------------------------------------------------------------------------------------
	if ($_GET['faz']=="flag") {
		list($valor) = db_dados("SELECT ".$_GET['flag']." FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['id']);
		if ($valor==1) $valor='0'; else $valor='1';
		
		db_executa($Config['tabela'],array($_GET['flag']=>$valor),'update', $Config['id'].'='.$_GET['id']);
		header("Location: ".urldecode($_GET['origem'])."?&msg=Atualizado",true); exit;
	}






	// Se nada for feito...
	header("Location: ../sys/".$Config['arquivo'].".php?info=".urlencode('Nada feito'),true); exit;
	
?>