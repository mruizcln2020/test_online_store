$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();

    logina = $("#usuarioinput").val();
    clavea = $("#passwordinput").val();

    $.post("../ajax/LoginAjax.php?op=checkLogin", {"logina":logina, "clavea":clavea}, function(data)
    {
        console.log(data);
        if (data > 0)
        {
            $.post("../ajax/LoginAjax.php?op=checkPermisos&usuarioId=" + data, function(r){
                $(location).attr("href","prestamosView.php");  
            });       
        }
        else
        {
            bootbox.alert("Usuario y/o Password incorrectos. Asegurese de que el usuario exista y las credenciales sean correctas.");
            $("#usuarioinput").val('');
            $("#passwordinput").val('');
        }
    });
})