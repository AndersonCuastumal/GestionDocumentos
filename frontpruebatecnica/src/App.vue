<template>
  <!-- Agregamos nuestro nav bar de bootstrap-->
    
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">GESTIÓN DOCUMENTOS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Documentos
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <router-link class="dropdown-item" to="/home" >Lista Documentos</router-link><!-- Esto hace referencia a que se rediriga a una nueva vista-->
                    
                  </li>
                  <li>
                    <router-link class="dropdown-item" to="/createDoc" >Registrar Nuevo</router-link>
                    
                  </li>
                  
                </ul>
              </li>

            </ul>
            <button @click="logout" class="btn btn-light"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp; Cerrar sesión</button>
          </div>
        </div>
      </nav>
      <div class="container-fluid">
        <RouterView/>
      </div>
  
</template>

<script>
  import Cookies from 'js-cookie';
  export default{
    name:'App',
    methods: {
      logout() {
          // Eliminar el token de sesión de localStorage
          Cookies.remove('token');

          // Redirigir a la página de inicio de sesión
          this.$router.push('/');
        },
      },
      mounted() {
        // Verificar si el usuario ha iniciado sesión
        const token = Cookies.get('token');
        if (!token) {
          // Si no hay token, redirigir a la página de inicio de sesión
          this.$router.push('/');
        }
      },
  };

  

</script>
