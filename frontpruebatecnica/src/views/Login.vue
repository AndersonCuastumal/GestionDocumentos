

<template>
    <div class="container py-4">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    Iniciar sesión
                </div>
                <div class="card-body" >
                    <form @submit.prevent="login">



                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="email" v-model="email" id="email" placeholder="ejemplo@email.com" class="form-control" required/>
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="password" v-model="password" class="form-control" required/>
                      </div>
                      <div class="d-grid col-6 mx-auto mb-3">
                        <button type="submit" class="btn btn-success">Ingresar</button>
                      </div>
                      
                    </form>
                </div>
              </div>
            </div>
          </div>
  
  </template>
  
  <script>


    import {enviarSolicitud} from '../funciones';

    export default {
        data() {
        return {
            email: '',
            password: '',
            linkApi:'http://pruebatecnica.test/api/v1/login'
        };
        },
        methods: {
        login() {

            event.preventDefault();
            var parametros={
                email: this.email,
                password: this.password,
            };
            
            enviarSolicitud('POST',parametros,this.linkApi,'Bienvenido!');
            
        },
        },
    };
  </script>