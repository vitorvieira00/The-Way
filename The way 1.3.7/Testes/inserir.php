<?php

?>

 <meta charset="utf-8">

<form name="dadospessoa" action="conexao.php" method="POST">
	<tr>
		<td> Nome: </td>
		<td><input type="text" name="Nome"      value=""></td>
	</tr>
	<tr>
		<td> Sobrenome: </td>
		<td><input type="text" name="Sobrenome" value=""></td>
	</tr>
	<tr>
		<td> Telefone: </td>
		<td><input type="tel" name="Telefone"   value=""></td>
	</tr>
	<tr>
		<td> G-mail </td>
		<td><input type="email" name="G-mail"   value=""></td>
	</tr>
	<tr>
		<td><input type="hidden" name="acao"   value="inserir"></td>
		<td><input type="submit" name="Enviar" value="Enviar" ></td>
	</tr>
</form>