<? 
	define('ID_MODULO',41,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'alunos',
		'tabela'=>'tbalunos',
		'titulo'=>'titulo',
		'id'=>'id_aluno',
		'urlfixo'=>'', 
		'pasta'=>'alunos',
	);

?>
<?
include('../includes/Mensagem.php');
$ondeestou = 'alunos';
?>
                	<div class="conthead">
                        <h2>alunos</h2>
                    </div>
<div id="conteudo">
<a  id="btnalt" href="alunos_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar novo Aluno</a>
<br />
<br />
<?



	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'TITULO',			'titulo',			''),
		array('resumo',		'SOBRE',		'sobre',			''),
	);


	# Consulta SQL
	#$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y %H:%i') as data1 FROM tbnoticias  ORDER BY data DESC";

	$SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as data1 FROM tbalunos ORDER BY data DESC, titulo ASC";

	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar','status','fotos'),$Config,false);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';









?>
</div>
<? include('../includes/Rodape.php'); ?>