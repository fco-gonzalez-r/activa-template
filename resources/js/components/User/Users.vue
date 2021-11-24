<template>
    <div>
        <div class="container-fluid px-4">
            <titulo titulo="Usuarios"></titulo>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-tools d-flex justify-content-end">
                                
                                <button class="btn btn-sm btn-primary " type="button" @click="newModal">
                                    <i class="fa fa-plus-square"></i>
                                    Agregar usuarios
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <!-- <th>Type</th> -->
                                        <th>Registered At</th>
                                        <th>Modify</th>
                                </tr>


                                <tr v-for="user in users.data" :key="user.id">

                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <!-- <td>{{user.type | upText}}</td> -->
                                    <td>{{user.created_at | myDate}}</td>

                                    <td>
                                        <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(user.id)">
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
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- <form @submit.prevent="createUser" @keydown="form.onKeydown($event)"> -->
                    <form @submit.prevent="editmode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode">Crea nuevo Usuario</h5>
                            <h5 class="modal-title" v-show="editmode">Actualiza información del Usuario</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input class="form-control" v-model="form.name" type="text" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <div class="invalid-feedback" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" v-model="form.email" type="email" name="email" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <div class="invalid-feedback" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Clave</label>
                                <div class="col-sm-10">
                                    <input class="form-control" v-model="form.password" type="password" name="password" :class="{ 'is-invalid': form.errors.has('password') }">
                                    <div class="invalid-feedback" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                                </div>
                            </div>

                            <!-- <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Tipo de usuario</label>
                                <div class="col-sm-10">
                                    <select class="form-select" v-model="form.type" name="type" aria-label="Default select example" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <option value="user" selected>User</option>
                                        <option value="admin" selected>Admin</option>
                                    </select>
                                    <div class="invalid-feedback" v-if="form.errors.has('type')" v-html="form.errors.get('type')" />
                                </div>
                            </div> -->

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
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(data => {
                        this.users = data.data.data;
                    });
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadUsers(){
                // this.$Progress.start();
                // if(this.$gate.isAdmin){
                    axios.get('api/user').then(({data}) => (this.users = data.data));
                // }
                // this.$Progress.finish();
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                .then((response) => {
                    // success
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
            createUser() {
                this.$Progress.start();
                this.form.post('api/user')
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
            deleteUser(id){
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
                                this.form.delete('api/user/'+id).then(()=>{
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
        },
    }
</script>

<style lang="scss" scoped>

</style>