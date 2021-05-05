$(obtener_registros());

function obtener_registros(products)
{
	$.ajax({
		url : 'sql.php',
		type : 'POST',
		dataType : 'html',
		data : { products: products },
		})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	})
}

$(document).on('keyup', '#busqueda', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros(valorBusqueda);
	}
	else
		{
			obtener_registros();
		}
});
