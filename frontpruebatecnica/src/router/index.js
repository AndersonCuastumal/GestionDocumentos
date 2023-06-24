import { createRouter, createWebHistory } from 'vue-router'
import ListaDocumentos from '../views/ListaDocumentos.vue'


import Vue from 'vue';
import VueRouter from 'vue-router';
import Cookies from 'js-cookie';
import axios from 'axios';


//Vistas principales para registro de documentos
import DocumentoNew from '../views/DocumentoNew.vue'
import DocumentoEdit from '../views/DocumentoEdit.vue'
import Login from '../views/Login.vue'

  //--- creamos nuestras rutas o direcciones---

const routes = [
  {
    path: '/home',
    name: 'home',
    component: ListaDocumentos,
    meta:{requiresAuth:true} //Indicamos que esta ruta necesita de autenticacion
  },


  {
    path: '/createDoc',
    name: 'createDoc',
    component: DocumentoNew,
    meta:{requiresAuth:true} //Indicamos que esta ruta necesita de autenticacion
  },
  {
    path: '/editDoc/:id',
    name: 'editDoc',
    component: DocumentoEdit,
    meta:{requiresAuth:true} //Indicamos que esta ruta necesita de autenticacion
  },{
    path: '/',
    name: 'Login',
    component: Login
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});


// Middleware para verificar si se requiere autenticación en la ruta
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    // Verificar si el token de autenticación está presente y es válido
    const token = Cookies.get('token');
    console.log("Valor del token es: "+token);
    if (token) {
      // Enviar el token al backend para verificar si es válido
      var linkApi='http://pruebatecnica.test/api/v1/usuarios/'+token;
      axios.get(linkApi)
      .then(response => {
        // El token es válido, permitir el acceso a la ruta
        next();
      })
      .catch(error => {
        console.error(error);
        // El token no es válido, redireccionar al usuario al inicio de sesión
        next('/');
      });
    } else {
      // El token no está presente, redireccionar al usuario al inicio de sesión
      next('/');
    }
  } else {
    // La ruta no requiere autenticación, permitir el acceso
    next();
  }
});




export default router
