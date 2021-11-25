<template>
    <div>
        <div class="container-fluid px-4">
            <titulo titulo="Roles"></titulo>


            <!-- <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-filter"></i>
                            Filtro
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <input type="text" v-model="filter.name" class="form-control" id="inputEmail3" placeholder="Nombre">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" @click="getResults()" class="btn btn-sm btn-primary">Filtrar</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div> 
            </div> -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-tools d-flex justify-content-end">
                                
                                <button class="btn btn-sm btn-primary " type="button" @click="newModal">
                                    <i class="fa fa-plus-square"></i>
                                    Agregar role
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- table table-responsive-sm table-sm -->
                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Guard</th>
                                        <th>Permisos</th>
                                        <th>Modify</th>
                                </tr>


                                <tr v-for="role in roles.data" :key="role.id">

                                    <td>{{role.id}}</td>
                                    <td>{{role.name}}</td>
                                    <td>{{role.guard_name}}</td>
                                    <td>
                                        <span v-for="permission in role.permissions" :key="permission.id" class="badge bg-success">{{ permission.name }}</span>
                                    </td>

                                    <td>
                                        <a href="#" @click="editModal(role)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteRole(role.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                                </tbody>
                            </table>



                        </div>
                        <div class="card-footer">
                            <pagination :data="users" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                </div> 
            </div>
            
        </div>

        <!-- Modal -->
        <div  class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form @submit.prevent="editmode ? updateUser() : createRole()" @keydown="form.onKeydown($event)">
                        
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode">Crea nuevo Usuario</h5>
                            <h5 class="modal-title" v-show="editmode">Actualiza información del Usuario</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input class="form-control" v-model="form.name" type="text" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <div class="invalid-feedback" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Permisos</label>
                            </div>
                            <div class="row">
                                <div v-for="permission in permissions" :key="permission.id" class="col-sm-3">
                                    <input class="form-check-input" v-model="form.permission" type="checkbox" :value="permission.id" :id="permission.id">
                                    <label class="form-check-label" for="flexCheckDefault">{{ permission.name }}</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
                            <!-- <button class="btn btn-primary" type="submit">Agregar</button> -->
                            <button v-show="editmode" type="submit" class="btn btn-success">Actualizar</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Crear</button>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Titulo from '../Titulo.vue'
    import Form from 'vform'
    export default {
        components: {
            Titulo
        },
        data() {
            return {
                editmode: false,
                users: {},
                roles: {},
                permissions: {},
                filter: new Form({
                    'name' : '',
                    'type' : ''
                }),
                form: new Form({
                    id: '',
                    name: '',
                    permission: []
                })
            }
        },
        methods: {
            getResults(page = 1) {
                const link = 'api/roles?page=' + page + '&name=' + this.filter.name;
                axios.get(link)
                    .then(data => {
                        this.roles = data.data.data;
                    });
            },
            editModal(role){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                const permissions = role.permissions.map(function(element) { 
                    return element.id; 
                })
                role.permission = permissions;
                this.form.fill(role);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadPersmissions(){
                this.$Progress.start();
                // if(this.$gate.isAdmin){
                    axios.get('api/permissions').then(({data}) => (this.permissions = data.data));
                // }
                this.$Progress.finish();
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/roles/'+this.form.id)
                .then((response) => {
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');
                    this.getResults();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            createRole() {
                this.$Progress.start();
                this.form.post('api/roles')
                .then((response)=>{
                    $('#addNew').modal('hide');
                    toast.fire({
                            icon: 'success',
                            title: response.data.message
                    });
                    this.$Progress.finish();
                    this.getResults();
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            },
            deleteRole(id){
                swal.fire({
                    title: '¿Está usted seguro?',
                    text: "¡No podrás revertir esto!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/roles/'+id).then(()=>{
                                    swal.fire(
                                        '¡Eliminado!',
                                        'El usuario ha sido eliminado.',
                                        'success'
                                    );
                                    // Fire.$emit('AfterCreate');
                                    this.getResults();
                                }).catch((data)=> {
                                  swal.fire("Failed!", data.message, "warning");
                              });
                         }
                    })
            },
        },
        created () {
            this.getResults();
            this.loadPersmissions();
        },
        watch: {
            filter: {
                handler: function(val, oldVal) {
                    this.getResults(); // call it in the context of your component object
                },
                deep: true
            }
      }
    }
</script>

<style lang="scss" scoped>

</style>