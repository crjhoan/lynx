function alerta(b){
    var id = b.id;
    var mostrarid=id+"mostrar";
    var mostrar=document.getElementById(id+"mostrar").value;
    var usernam=document.getElementById(id+"username").value;
    document.getElementById("mensaje").innerHTML = mostrar;
    document.getElementById("username").innerHTML = usernam;
}

function eliminar(b){
    valor=b.id;
    location.href="eliminar2.php?id="+valor+"";
}