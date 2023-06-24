import Swal from "sweetalert2";
import axios from "axios";
import Cookies from 'js-cookie';
// Este metodo genera una alerta personalizada
export function mostrarAlerta(titulo, icono, foco=''){
    if(foco!=''){
        document.getElementById(foco).focus();
    }

    Swal.fire({
        title:titulo,
        icon:icono,
        customClass:{confirmButton:'btn btn-primary',popup:'animated zoomIn'},
        buttonsStyling:false
        
    });
}


// Este metodo muestra un popup donde se solicita confirmar la eliminacion de un documento
export function confirmar(URL,id,titulo,mensaje){
    var url=URL+id;
    const swalWithBootstrapButton=Swal.mixin({
        customClass:{
            confirmButton:'btn btn-success me-3',
            cancelButton:'btn btn-danger'
        }
    });

    swalWithBootstrapButton.fire({

        title:titulo,
        text:mensaje,
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((res)=>{
        if(res.isConfirmed){
            enviarSolicitud('DELETE',{id:id},url,'Eliminado con éxito!'); //metodo para eliminar elemento de base de datos
        }else{
            mostrarAlerta('Operación cancelada','info')
        }
    });


}


// Creamos metodo de eliminacion 
export function enviarSolicitud(metodo,parametros,link,mensaje){
    var token=null;
    axios({method:metodo,url:link,data:parametros}).then(function(res){
        console.log(res);
        
        var estado=res.status; // consultamos el estado del servidor
        console.log("El estado de actualizacion es: "+estado);
        if(estado==200 || estado==201){
            //Validamos y guardamos el token de autenticacion
            token=res.data.token;
            if(token!=null){
                console.log("Se creo token: "+res.data.token);
                Cookies.set('token', res.data.token);

                
            }

            mostrarAlerta(mensaje,'success');
            window.setTimeout(function(){
                window.location.href='/home'; // redireccionamos a la lista de documentos
            },1000); // le damos un tiempo para que espere y realice esta accion
            
        }else{
            mostrarAlerta('Servidor no disponible','error');
        }
    }).catch(function(error){
        console.log(error);
        mostrarAlerta('Email o contraseña incorrectos','error');
    });
}

