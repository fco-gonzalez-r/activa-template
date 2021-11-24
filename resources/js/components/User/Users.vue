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
                                        <!-- <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(user.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a> -->

                                    </td>
                                </tr>
                                </tbody>
                            </table>



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
        data() {
            return {
                users: {},
            }
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