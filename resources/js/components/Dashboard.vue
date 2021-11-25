<template>
    <div>

        <div class="container-fluid px-4">
            
            <titulo titulo="Dasboard" breadcrumb="Dashboard"></titulo>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            Dashboard
                        </div>
                        <div class="card-body">
                            <!-- {{ $user  }} -->

                            <div v-if="is('Super-Admin')">
                                Eres Super Admin
                            </div>
                            <div v-else>No eres super-Admin</div>

                            <div v-if="can('permiso-create')">
                                puedes permiso-create
                            </div>
                            <div v-else> no puedes permiso-create </div>


                        </div>
                    </div>
                </div> 
                
                
            </div>
            
        </div>



        
    </div>
</template>

<script>
    import Titulo from './Titulo.vue'

    export default {
        components: {
            Titulo
        },        
        mounted() {
            
        }
    }
</script>

<style lang="scss" scoped>

</style>