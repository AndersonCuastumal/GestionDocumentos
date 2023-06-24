<template>
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="table-responsive mx-auto">
        <table id="listarDocumentos" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">id</th>
              <th scope="col">Nombre</th>
              <th scope="col">Codigo</th>
              <th scope="col">Contenido</th>
              <th scope="col">Proceso</th>
              <th scope="col">Tipo</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="contenido">
            <tr v-if="this.cargando"> <!--Se muestra un mensaje en el caso que aun no se hayan importado los datos-->
              <td colspan="7" ><h3>Cargando...</h3></td>
            </tr>
            <tr v-else v-for="doc,i in this.documentos" :key="doc.doc_id">
              
              <td v-text="(i+1)"></td>
              <td v-text="doc.doc_id"></td>
              <td v-text="doc.doc_nombre"></td>
              <td v-text="doc.doc_codigo"></td>
              <td v-text="doc.doc_contenido"></td>
              <td v-text="conversionIdToProceso(doc.doc_id_proceso,dataProcesos)"></td>
              <td v-text="conversionIdToTipo(doc.doc_id_tipo,dataTipoDocs)"></td>
              <td>
                <router-link :to="{path:'editDoc/'+doc.doc_id}" class="btn btn-light">
                  <i class="fa-solid fa-edit"></i>
                </router-link>
                &nbsp;
                <button id="btn-eliminar" v-on:click="$event => eliminar(doc.doc_id,doc.doc_nombre)" class="btn btn-light">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
</template>

<script>
import axios from 'axios';
import $ from 'jquery';
import 'datatables.net';
// Importamos nuestras funciones js creadas

import {confirmar} from '../funciones';


// Logica de peticion
export default{
  data(){
    return{
      documentos:null, //inicializamos la variable donde despues se alamacenara la respuesta de la solicitud get
      dataTable: null,
      dataProcesos:[],
      dataTipoDocs:[],

      cargando:false // es una bandera que indica si los datos se han cargado

    }
  },
  // Este metodo se ejecutara cuando todos los recursos del DOM se hayan cargado, entonces se ejecuta el metodo de solicitud "getDocumentos"
  mounted(){
    this.getDocumentos();
    this.nombreProcesos();
    this.nombreTipos();
  },
  // 
  methods:{

    nombreTipos(){
       
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

    nombreProcesos(){
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
    
    conversionIdToProceso(numeroId,data){
      const nombreConversion = data.find(nombreConversion => nombreConversion.id === numeroId);
      return nombreConversion ? nombreConversion.pro_nombre : '';
    },

    conversionIdToTipo(numeroId,data){
      const nombreConversion = data.find(nombreConversion => nombreConversion.id === numeroId);
      return nombreConversion ? nombreConversion.tip_nombre : '';
    }
    ,
    //---Metodo lista de documentos-----------
    getDocumentos(){
      //Indicamos que se debe esperar a que cargue toda la informacion de la pagina
      this.cargando=true;
      //Asignamos la url donde realizaremos la petición
      axios.get('http://pruebatecnica.test/api/v1/documentos').then(
        //Obtenemos la respuesta
        res=>{
          this.documentos=res.data;
          this.cargando=false;
          // Inicializa DataTables en la tabla
          this.$nextTick(() => {
            this.dataTable = $('#listarDocumentos').DataTable({
              searching: true,
              paging: true,
              lengthChange: false,
              info: false,
              pageLength: 5,
              language: {
                  // Aquí puedes definir las traducciones para el idioma deseado
                  "sEmptyTable": "No hay datos disponibles en la tabla",
                  "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                  "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                  "sLengthMenu": "Mostrar _MENU_ registros por página",
                  "sLoadingRecords": "Cargando...",
                  "sProcessing": "Procesando...",
                  "sSearch": "Buscar:",
                  "sZeroRecords": "No se encontraron registros coincidentes",
                  "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                  }

                }
            });
          });
          
        }
      );
    },
    //-------Eliminar un documento--------
    eliminar(id,nameDoc){
      confirmar('http://pruebatecnica.test/api/v1/documentos/',id,"Eliminar documento",`¿Realmente desea eliminar ${nameDoc}?`);
      this.cargando=false;
    },
    beforeDestroy() {
    // Destruye la instancia de DataTables antes de desmontar el componente
    if (this.dataTable !== null) {
      this.dataTable.destroy();
    }
  }
  }
}
</script>

<style>

/* Organizar tabla */
.table-responsive {
  margin-top: 50px; /* Ajusta la distancia desde la parte superior de la página */
  margin-bottom: 50px; /* Ajusta la distancia desde la parte inferior de la página */
  margin-left: auto; /* Centra horizontalmente el elemento */
  margin-right: auto; /* Centra horizontalmente el elemento */
  max-width: auto; /* Establece un ancho máximo para limitar el tamaño del elemento */
}
/* estilo Buscar */
.dataTables_filter {
  text-align: center;
  margin-bottom: 20px;
}

.dataTables_filter label {
  display: inline-block;
  vertical-align: middle;
  margin-bottom: 0;
  font-size: 0; /* Oculta el texto dentro del label */
}

.dataTables_filter label::before {
  content: '\f002'; /* Código del icono FontAwesome que deseas mostrar */
  font-family: 'Font Awesome\ 5 Free'; /* Nombre de la fuente de FontAwesome */
  font-weight: 900;
  font-size: 16px;
  color: #999;
  margin-right: 5px;
}

.dataTables_filter input[type="search"] {
  width: 200px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
}

/* Estilos para la paginación */
.dataTables_wrapper .dataTables_paginate {
  margin-top: 10px;
  text-align: center;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  display: inline-block;
  padding: 8px 12px;
  margin-right: 5px;
  background-color: #f8f9fa;
  border: 1px solid #dee2e6;
  color: #212529;
  cursor: pointer;
  transition: background-color 0.3s;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background-color: #e9ecef;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
  background-color: #f8f9fa;
}

.dataTables_wrapper .dataTables_paginate .ellipsis {
  display: inline-block;
  padding: 8px 12px;
  margin-right: 5px;
  color: #212529;
}

.dataTables_wrapper .dataTables_paginate .ellipsis:hover {
  background-color: transparent;
  cursor: default;
}
</style>
