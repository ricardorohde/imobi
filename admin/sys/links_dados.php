<? 
	define('ID_MODULO',25,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'links',
		'tabela'=>'tblinks',
		'titulo'=>'texto',
		'id'=>'id_link',
		'urlfixo'=>'', 
		'pasta'=>'links',
	);


	if ($_GET['ID']>0) $dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");

?>
<?

?>
  
		 <section>

		            	<header>
		                <a href="#menu" class="showmenu button">Menu</a>
						<h2 style="color:#fff; padding:0 20px">Criar Páginas</h2>
						</header>

	<div id="conteudo">
		        <section style="min-height:600px">
<?

 include('../includes/Mensagem.php');


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		
 
			array('text',		'Título',		'titulo',			'500',			'',					' ',											''),
							array('file',		'Imagem',		'imagem',			'500',			'',					'',											''),
				array('textarea',		'Texto',		'descricao',			'500',			'',					' ',											''),

	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);






?>
</div>
<?
	include('../includes/Rodape.php');
?>