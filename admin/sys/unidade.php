<? 
	define('ID_MODULO',17,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'unidade',
		'tabela'=>'tbdestaque',
		'titulo'=>'cidade',
		'id'=>'id_destaque',
		'urlfixo'=>'', 
		'pasta'=>'destaque',
	);

?>
<?

?>
                	
	
	 <section>
	        
	            	<header>
	                <a href="#menu" class="showmenu button">Menu</a>
					<h2 style="color:#fff; padding:0 20px">Unidades</h2>
					</header>
	              
<div id="conteudo">
	        <section style="min-height:600px">
		
		
<a  id="btnalt" href="unidade_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar nova unidade</a>
<br />
<br />
<?
include('../includes/Mensagem.php');


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		
		array('texto',		'CIDADE',		'cidade',			''),
		array('texto',		'ENDERECO',		'endereco',			''),
		array('texto',		'CEP',		'cep',			''),
		array('texto',		'TELEFONE',		'telefone',			''),
		

	);


	# Consulta SQL
	$SQL = "SELECT * FROM tbdestaque ORDER BY cidade DESC";



	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>