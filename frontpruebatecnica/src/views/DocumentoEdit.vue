<template>
  <div class="row mt-3">
      <div class="col-md-6 offset-md-3">
          <div class="card">
              <div class="card-header bg-dark text-white text-center">
                  Editar documento
              </div>
              <div class="card-body" >
                  <div v-if="cargando">Cargando datos...</div>
                  <div v-else>

                      <form  @submit.prevent="editarDocumento">
                          <div class="input-group mb-3">
                              <span class="input-group-text">
                                  <i class="fa-solid fa-file-signature"></i>
                              </span>
                              <input type="text" v-model="doc_nombre" id="doc_nombre" placeholder="Ingresar nombre de documento" class="form-control" required>
                          </div>
                          
                          <div class="input-group mb-3">
                              <span class="input-group-text">
                                  <i class="fa-solid fa-comment"></i>
                              </span>
                              <input type="text" v-model="doc_contenido" id="doc_contenido" placeholder="Ingresar contenido" class="form-control" required>
                          </div>

                          
                          <div class="input-group mb-3">
                              <span class="input-group-text">
                                  Tipo documento
                              </span>
                              <select v-model="doc_id_tipo" class="form-control" required>
                                  <option value=null>Seleccionar tipo de documento</option>
                                  <option v-for="tipo in dataTipoDocs" :value="tipo.id">{{tipo.tip_nombre}}</option>
                               
                              </select>

                          </div>
                          <div class="input-group mb-3">
                              <span class="input-group-text">
                                  Proceso
                              </span>
                              <select v-model="doc_id_proceso" class="form-control" required>
                                  <option value=null>Seleccionar proceso</option>
                                  <option v-for="proceso in dataProcesos" :value="proceso.id">{{ proceso.pro_nombre }}</option>
                              </select>
                          </div>

                          

                          <div class="d-grid col-6 mx-auto mb-3">
                              <button type="submit" class="btn btn-success">Guardar cambios</button> 
                          </div>
                      </form>
                  </div>
              </div>

          </div>
      </div>

  </div>
</template>

<script>

import { enviarSolicitud} from '../funciones';
import {useRoute} from 'vue-router';
import axios from "axios";



// Logica de peticion
export default{
data(){
  return{
    cargando:false,
    linkApi:'http://pruebatecnica.test/api/v1/documentos',
    doc_id:0,
    dataProcesos:[],
    dataTipoDocs:[],
    doc_nombre:'',
    doc_contenido:'',
    doc_id_tipo:null,
    doc_id_proceso:null
    
  }
},

mounted(){
  this.consultaProcesos();
  this.consultaTipos();
  

  //Extrae el id de la URL
  const ruta=useRoute();
  this.doc_id=ruta.params.id;
  this.linkApi+="/"+this.doc_id; //Creamos la URL

  this.buscarDoc();
  
},
methods:{
  consultaTipos(){
     
     this.cargando=true;
     // Consulta 1 - URL/API 1
     // Aquí debes realizar la solicitud HTTP para obtener los datos de la primera consulta
     // utilizamos Axios
     axios.get('http://pruebatecnica.test/api/v1/tipodocs').then(
       //Obtenemos la respuesta
       res=>{
           // Actualizamos this.dataTipoDocs con los datos recibidos
         this.dataTipoDocs=res.data;
         this.cargando=false;
       }
     );
   },

  consultaProcesos(){
    //Indicamos que se debe esperar a que cargue toda la informacion de la pagina
    this.cargando=true;
    //Asignamos la url donde realizaremos la petición
    axios.get('http://pruebatecnica.test/api/v1/proprocesos').then(
      //Obtenemos la respuesta
      res=>{
        this.dataProcesos=res.data;
        this.cargando=false;
      }
    );

  },
  
  //---Buscar documento----------
  buscarDoc(){
    //Indicamos que se debe esperar a que cargue toda la informacion de la pagina
    this.cargando=true;
    //Asignamos la url donde realizaremos la petición
    axios.get(this.linkApi).then(
      //Obtenemos la respuesta
      res=>{
        
        // poblar datos formulario del documento especifico
        this.doc_nombre=res.data.data.doc_nombre;
        this.doc_contenido=res.data.data.doc_contenido;
        this.doc_id_tipo=res.data.data.doc_id_tipo;
        this.doc_id_proceso=res.data.data.doc_id_proceso;

        this.cargando=false;
      }
    );
  },
  //---Metodo lista de documentos-----------
  editarDocumento() {

    event.preventDefault();
    var parametros = {
      doc_nombre: this.doc_nombre,
      doc_contenido: this.doc_contenido,
      doc_id_proceso: this.doc_id_proceso,
      doc_id_tipo: this.doc_id_tipo
    };
    //Guardamos los datos obtenidos del formulario
    
    enviarSolicitud('PUT',parametros,this.linkApi,'Documento actualizado!!');


  }
}
}
</script>



