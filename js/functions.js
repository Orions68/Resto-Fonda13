var invoices = "";
var kitchen = "";
var array = [];
var array2 = [];

let plate = document.getElementById("plate");
let platos = document.getElementById("platos");
let invoice = document.getElementById("invoice");

function add_plate()
{
    let meal = document.getElementById("meal");
    let qtty = document.getElementById("qtty");

	if (window.meal.value !== "")
	{
		invoices += "m:" + meal.value + "," + qtty.value + ",";
		kitchen += meal.value + " Cantidad : " + qtty.value + ", ";
        meal.value = "";
        qtty.value = 1;
		window.plate.innerHTML = invoices;
		window.platos.innerHTML = kitchen;
		window.invoice.value = invoices;
	}
}

function add_bebida()
{
    let beverage = document.getElementById("bev");
    let qtty2 = document.getElementById("qtty2");

	if (beverage.value !== "")
	{
		invoices += "b:" + beverage.value + "," + qtty2.value + ",";
        beverage.value = "";
        qtty2.value = 1;
		window.plate.innerHTML = invoices;
		window.invoice.value = invoices;
	}
}

function add_postre()
{
    let dessert = document.getElementById("dess");
    let qtty3 = document.getElementById("qtty3");

	if (dessert.value !== "")
	{
		invoices += "d:" + dessert.value + "," + qtty3.value + ",";
        kitchen += dessert.value + " Cantidad : " + qtty3.value + ", ";
        dessert.value = "";
        qtty3.value = 1;
		window.plate.innerHTML = invoices;
        window.platos.innerHTML = kitchen;
		window.invoice.value = invoices;
	}
}

function addData(data)
{
	array = data.split(';');

    switch (array[0])
    {
        case "0":
            inside = array[1].split(",");
            for (i = 0; i < inside.length; i+=4)
            {
                invoices += "m:" + inside[i] + "," + inside[i + 1] + "," + inside[i + 2] + "," + inside[i + 3] + ",";
            }
            break;
        case "1":
            inside = array[1].split(",");
            for (i = 0; i < inside.length; i+=4)
            {
                invoices += "b:" + inside[i] + "," + inside[i + 1] + "," + inside[i + 2] + "," + inside[i + 3] + ",";
            }
            break;
        default:
            inside = array[1].split(",");
            for (i = 0; i < inside.length; i+=4)
            {
                invoices += "d:" + inside[i] + "," + inside[i + 1] + "," + inside[i + 2] + "," + inside[i + 3] + ",";
            }
    }

	if (array[0] != 1)
	{
        array2 = array[1].split(',');
		for (i = 0; i < array2.length; i+=4)
		{
			kitchen += array2[i + 1] + " Cantidad : " + array2[i + 3] + " ";
		}
		window.platos.innerHTML = kitchen;
		window.plate.innerHTML = invoices;
		window.invoice.value = invoices;
	}
    else
    {
		window.plate.innerHTML = invoices;
		window.invoice.value = invoices;
    }
}

function printIt(form)
{
	form.submit();
	var prtContent = document.getElementById("printable");
	var WinPrint = window.open('', '', '');
	WinPrint.document.write('<html><head><title>Print Invoice</title>');
	WinPrint.document.write('<link rel="stylesheet" type="text/css" href="css/style.css" />');
	WinPrint.document.write('</head><body>');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

function deleting(number)
{
	window.open("delete.php?table=" + number, "_self");
}

function verify(form)
{
	if (form.pass.value != form.pass2.value)
	{
    	alert(`Las contraseñas no coinciden, por favor escríbelas nuevamente. ${form.pass.value} y ${form.pass2.value}`);
    }
    else
    {
    	form.submit();
    }
}

function verifyShow(form)
{
    if (form.table.value == "")
    {
        if (form.date.value == "")
        {
            toast(1, "Ambos Campos en Blanco", "Debes Seleccioar al Menos una Fecha o una Mesa.");
            return false;
        }
        else
        {
            return true;
        }
    }
    else
    {
        return true;
    }
}

function screen() // Establece el tamaño de las vistas en la pantalla.
{
    let view1 = document.getElementById("view1"); // Recoge las ID de todas las vistas.
    let view2 = document.getElementById("view2");
    let view3 = document.getElementById("view3");
    let view4 = document.getElementById("view4");
    let screen = window.innerHeight; // Obtiene el tamaño vertical de la pantalla.
    var body = document.body, html2 = document.documentElement; // Asigno a la variable body el body y a html2 el contenido.
    var height = Math.max(body.scrollHeight, body.offsetHeight, html2.clientHeight, html2.scrollHeight, html2.offsetHeight); // Asigno a la variable height el valor máximo de la pantalla con todo el contenido.

    if (view1.offsetHeight < screen) // Si el tamaño vertical de la vista es menor que el tamaño vertical de la pantalla.
    {
        view1.style.height = screen + "px"; // Le asigno el tamaño de la pantalla a la vista 1, si es mayor lo dejo como está.
    }

    if (view2 != null) // Si existe el div view2
    {
        if (view2.offsetHeight < screen) // Si el tamaño vertical de la vista es menor que el tamaño vertical de la pantalla.
        {
            view2.style.height = screen + "px"; // Le asigno el tamaño de la pantalla a la vista 2, si es mayor lo dejo como está.
        }
        if (view3 != null)
        {
            if (view3.offsetHeight < screen)
            {
                view3.style.height = screen + "px";
            }
            if (view4 != null)
            {
                if (view4.offsetHeight < screen)
                {
                    view4.style.height = screen - 200 + "px";
                }
            }
            
        }
    }
    else // Si la vista 2 no existe.
    {
        view1.style.height = height - 80 + "px"; // Le asigno a la vista 1 el tamaño de todo el contenido de la pantalla menos 80 pixels.
    }
}

function resolution() // Esta función comprueba si el ancho de la pantalla es de Ordenador o de Móvil.
{
    let mobile = document.getElementById("mobile");
    let pc = document.getElementById("pc");
    let width = innerWidth;
    if (width < 965) // Si el ancho es inferior a 965.
    {
        pc.style.visibility = "hidden"; // Oculta el menú de Ordenador
        mobile.style.visibility = "visible"; // Muestra el menú de Teléfono.
    }
    else // Si es mayor o igual a 965;
    {
        pc.style.visibility = "visible"; // Muestra el menú para Ordenador
        mobile.style.visibility = "hidden"; // Oculta el menú para Teléfono.
    }
}

function toast(warn, ttl, msg) // Función para mostrar el Dialogo con los mensajes de alerta, recibe, Código, Título y Mensaje.
{
    var alerta = document.getElementById("alerta"); // La ID del botón del dialogo.
    var title = document.getElementById("title"); // Asigno a la variable title el h4 con id title.
    var message = document.getElementById("message"); // Asigno a la variable message el h5 con id message;
    if (warn == 1) // Si el código es 1, es una alerta.
    {
        title.style.backgroundColor = "#000000"; // Pongo los atributos, color de fondo negro.
        title.style.color = "yellow"; // Y color del texto amarillo.
    }
    else if (warn == 0) // Si no, si el código es 0 es un mensaje satisfactorio.
    {
        title.style.backgroundColor = "#FFFFFF"; // Pongo los atributos, color de fondo blanco.
        title.style.color = "blue"; // Y el color del texto azul.
    }
    else // Si no, viene un 2, es una alerta de error.
    {
        title.style.backgroundColor = "#000000"; // Pongo los atributos, color de fondo negro.
        title.style.color = "red"; // Y color del texto rojo.
    }
    title.innerHTML = ttl; // Muestro el Título del dialogo.
    message.innerHTML = msg; // Muestro los mensajes en el diálogo.
    alerta.click(); // Lo hago aparecer pulsando el botón con ID alerta.
}