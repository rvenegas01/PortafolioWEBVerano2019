//Arrays de datos:

meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]

lasemana = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];

diassemana = ["lun", "mar", "mié", "jue", "vie", "sáb", "dom"];

window.onload = function() {
    //fehca actual
    hoy = new Date();
    diasemhoy = hoy.getDay(); //objeto fecha actual
    diahoy = hoy.getDate(); //dia mes actual
    meshoy = hoy.getMonth(); //mes actual
    annohoy = hoy.getFullYear(); //año actual

    // Elementos del DOM: en cabecera de calendario
    tit = document.getElementById("titulos"); //cabeceradel calendario
    ant = document.getElementById("anterior"); //mes anterior
    pos = document.getElementById("posterior"); //mes posterior

    // Elementos del DOM en primera fila
    f0 = document.getElementById("fila0");

    // Pie de calendario
    pie = document.getElementById("fechaactual");
    pie.innerHTML += " " + lasemana[diasemhoy] + ", " + diahoy + " de " + meses[meshoy] + " de " + annohoy;

    // formulario: datos iniciales
    document.buscar.buscaanno.value = annohoy;

    // Definir elementos inciales:
    mescal = meshoy; //mes principal
    annocal = annohoy; //año principal

    // iniciar calendario:
    cabecera();
    primeralinea();
    escribirdias();
}

function cabecera() {
    tit.innerHTML = meses[mescal] + " de " + annocal;
    mesant = mescal - 1; //mes anterior
    mespos = mescal + 1; //mes posterior
    if (mesant < 0) {
        mesant = 11;
    }
    if (mespos > 11) {
        mespos = 0;
    }
    ant.innerHTML = meses[mesant];
    pos.innerHTML = meses[mespos];
}

// primera línea de la tabla: días de la semana
function primeralinea() {
    for (i = 0; i < 7; i++) {
        celda0 = f0.getElementsByTagName("th")[i];
        celda0.innerHTML = diassemana[i];
    }
}

function escribirdias() {
    // Buscar día de la semana del día 1 del mes:
    primeromes = new Date(annocal, mescal, "1"); // buscar primer día del mes
    prsem = primeromes.getDay(); //buscar día de la semana del día 1
    prsem--; //adaptar al calendario español (empezar por lunes)
    if (prsem == -1) {
        prsem = 6;
    }
    // buscar fecha para primera celda:
    diaprmes = primeromes.getDate();
    prcelda = diaprmes - prsem; // restar días que sobran de la semana
    empezar = primeromes.setDate(prcelda); // empezar = timepo UNIX primera celda
    diames = new Date(); // convertir en fecha
    diames.setTime(empezar); //diames = fecha primera celda.
    // Recorrer las celdas para escribir el día: 
    for (i = 1; i < 7; i++) {
        fila = document.getElementById("fila" + i);
        for (j = 0; j < 7; j++) {
            midia = diames.getDate();
            mimes = diames.getMonth();
            mianno = diames.getFullYear();
            celda = fila.getElementsByTagName("td")[j];
            celda.innerHTML = midia;
            // Recuperar estado inicial al cambiar de mes:
            celda.style.backgroundColor = "#9bf5ff";
            celda.style.color = "#492736";
            // Domingos en rojo
            if (j == 6) {
                celda.style.color = "#f11445";
            }
            // días restantes del mes en gris
            if (mimes != mescal) {
                celda.style.color = "#a0bac";
            }
            // destacar la fecha actual
            if (mimes == meshoy && midia == diahoy && mianno == annohoy) {
                celda.style.backgroundColor = "#f0b19e";
                celda.innerHTML = "<cite title='Fecha Actual'>" + midia + "</cite>";
            }
            // pasar al día siguiente
            midia = midia + 1;
            diames.setDate(midia);
        }
    }

}

// Ver mes anterior
function mesantes() {
    nuevomes = new Date();
    primeromes--;
    nuevomes.setTime(primeromes);
    mescal = nuevomes.getMonth();
    annocal = nuevomes.getFullYear();
    cabecera();
    escribirdias();
}

// ver mes posterior
function mesdespues() {
    nuevomes = new Date();
    tiempounix = primeromes.getTime();
    tiempounix = tiempounix + (45 * 24 * 60 * 60 * 1000);
    nuevomes.setTime(tiempounix);
    mescal = nuevomes.getMonth();
    annocal = nuevomes.getFullYear();
    cabecera();
    escribirdias();
}

function actualizar() {
    mescal = hoy.getMonth();
    annocal = hoy.getFullYear();
    cabecera();
    escribirdias();
}

function mifecha() {
    mianno = document.buscar.buscaanno.value;
    listameses = document.buscar.buscames;
    opciones = listameses.options;
    num = listameses.selectedIndex;
    mimes = opciones[num].value;

    if (isNaN(mianno) || mianno < 1) {
        alert("El años no es válido: \n debe ser un número mayor que 0");
    } else {
        mife = new Date();
        mife.setMonth(mimes);
        mife.setFullYear(mianno);
        mescal = mife.getMonth();
        annocal = mife.getFullYear();
        cabecera();
        escribirdias();
    }
}