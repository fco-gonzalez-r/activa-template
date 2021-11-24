<template>
    <div>
        <div class="container-fluid px-4">
            
            <titulo titulo="Usuarios"></titulo>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            Listado de usuarios
                        </div>
                        <div class="card-body">
                            {{ $user  }}
                        </div>
                    </div>
                </div> 
                
                
            </div>
            
        </div>
    </div>
</template>

<script>
    import Titulo from '../Titulo.vue'
    export default {
        components: {
            Titulo
        },
        methods: {
            loadUsers(){
                // this.$Progress.start();
                // if(this.$gate.isAdmin()){
                    axios.get("api/user").then(({ data }) => (this.users = data.data));
                // }
                // this.$Progress.finish();
            },
        },
        created () {
            this.loadUsers();
        },
    }
</script>

<style lang="scss" scoped>

</style>