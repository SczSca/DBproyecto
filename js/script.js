function validateForm(idx) {
    if(idx === 1){
        let uName = document.forms["login"]["username"].value;
        let password = document.forms["login"]["password"].value;
        if(!!uName && !!password){
            return true;
        }else{
            alert("valor faltante");
            return false;
        }
    }
    else if(idx === 2){
        let name = document.forms["insert"]["nombre"].value;
        let descript = document.forms["insert"]["descripcion"].value;
        let cant = document.forms["insert"]["cantidad"].value;
        let precio = document.forms["insert"]["precio"].value;
        if (!!name && !!descript && !!cant && !!precio) {
          return true;
        }else alert("Valor faltante"); return false;
    }else if(idx === 3){

    }
  }
         
