function validateForm(idx) {

    if(idx === 2){
        let name = document.forms["insertCentro"]["Nombre"].value;
        let phone = document.forms["insertCentro"]["Telefono"].value;
        let address = document.forms["insertCentro"]["Direccion"].value;
        let email = document.forms["insertCentro"]["Email"].value;
        if (!!name && !!phone && !!address && !!email) {
            return true;
        }else{
            alert("Valor faltante"); 
            return false;
        }
        
    }else if(idx === 21){
        let name = document.forms["updateCentro"]["Nombre"].value;
        let phone = document.forms["updateCentro"]["Telefono"].value;
        let address = document.forms["updateCentro"]["Direccion"].value;
        let email = document.forms["updateCentro"]["Email"].value;
        if (!!name && !!phone && !!address && !!email) {
            return true;
        }else{
            alert("Valor faltante"); 
            return false;
        }
    }else if(idx === 3){
        let name = document.forms["insertSala"]["Nombre"].value;
        let tipo = document.forms["insertSala"]["Tipo"].value;
        let descrip = document.forms["insertSala"]["Descripcion"].value;
        let idCentro = document.forms["insertSala"]["IdCentro"].value;
        if (!!name && !!tipo && !!descrip && !!idCentro) {
          return true;
        }else alert("Valor faltante"); return false;
    }else if(idx === 31){
        let name = document.forms["updateSala"]["Nombre"].value;
        let tipo = document.forms["updateSala"]["Tipo"].value;
        let descrip = document.forms["updateSala"]["Descripcion"].value;
        let idCentro = document.forms["updateSala"]["IdCentro"].value;
        if (!!name && !!tipo && !!descrip && !!idCentro) {
          return true;
        }else alert("Valor faltante"); return false;
    }
}  
