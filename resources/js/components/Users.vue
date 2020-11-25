<style>
  .card-header-teewhy{
    background: rgb(26, 26, 73);
    color: #ffffff;
  }
  .btn-success{
   background: rgba(211, 165, 80,.99); 
   border: 5px #ffffff solid;
  }
  .btn-success:hover{
     background:rgb(26, 26, 73) ; 
   border: 5px rgba(211, 165, 80,.99) solid;
   border-radius: 5px;
  }

  .btn-primary{
       background:rgb(26, 26, 73) ; 
     
  }
  
</style>
<template>

    <div class="container">
       <div class="row mt-5">
          <div class="col-md-12" v-if="$gate.isAdminOrAuthor()">
            <div class="card card-primary" >
              <div class="card-header" style="background: rgb(26, 26, 73);">
                <h3 class="card-title">Users List</h3>

                <div class="card-tools" >
                    <button  class="btn btn-success" @click="newModal">Add New 
                    <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Registered At</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type | upText}}</td>
                      <td>{{user.created_at | dateFormat}}</td>
                      <td>
                          <a href="#" @click="editModal(user)"> <i class="fa fa-edit blue"></i> </a> /
                          <a href="#" @click="deleteUser(user.id)"> <i class="fa fa-trash red"></i> </a>
                        </td>
                    </tr>
               
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer " >
                  <pagination  :data="users" @pagination-change-page="getResults"></pagination>
                </div>
            </div>

            <!-- /.card -->
          </div>
        </div>
        <!-- 404 page here-->
        <div v-if="!$gate.isAdminOrAuthor()">
           <not-found></not-found>
        </div>
<!-- Modal -->
<form @submit.prevent="editMode ? updateUser() : createUser()">
        <div class="modal fade" id="addnew" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 v-show="editMode" class="modal-title" id="addnewLabel">Update User's Info</h5>
        <h5 v-show="!editMode" class="modal-title" id="addnewLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
      <input v-model="form.name" type="text" name="name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name">
      <has-error :form="form" field="name"></has-error>
    </div>


      <div class="form-group">
      <input v-model="form.email" type="text" name="email"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email">
      <has-error :form="form" field="email"></has-error>
    </div>

    <div class="form-group">
      <textarea v-model="form.bio" type="text" name="bio"
        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" 
         placeholder="Short bio for user (optional)"> </textarea>
      <has-error :form="form" field="bio"></has-error>
    </div>

     <div class="form-group">
      <select v-model="form.type"  name="type" id="type"
        class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" 
         >
         <option value="">Select User Role</option>
         <option value="admin">Admin User</option>
         <option value="standard">Standard User</option>
         <option value="author">Author</option>
          </select>
      <has-error :form="form" field="type"></has-error>
    </div>

     <div class="form-group">
      <input v-model="form.password" type="password" name="password" id="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" 
         placeholder="Password">
      <has-error :form="form" field="password"></has-error>
    </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
        <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>
</form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
              editMode: false,
                users : {},
                form: new Form({
                    id  : '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },

        methods: {
          updateUser(){
            this.$Progress.start();
            this.form.put('updateuser/'+ this.form.id )
            .then(()=> {
              $('#addnew').modal('hide')
                swal.fire(
                'Updated!',
               "User's Info Updated successfully.",
                'success'
              )
              this.$Progress.finish();
            Fire.$emit('AfterCreate');
            })
            .catch(()=> {
              this.$Progress.fail();
            })
          },
             editModal(user){
            this.editMode = true;
             this.form.reset();
              $('#addnew').modal('show')
              this.form.fill(user);
          },
          newModal(){
            this.editMode = false;
             this.form.reset();
              $('#addnew').modal('show')
          },
       
          deleteUser(id){
          swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
             if (result.value) {
          this.form.delete('/deleteUser/'+id)
          .then(() => {
                swal.fire(
                'Deleted!',
               'User deleted successfully.',
                'success'
            )
            Fire.$emit('AfterCreate');
          })
          .catch(()=> {
            swal("Failed", "There was something wrong" , "warning");
          })
          }
        })
     },
          loadUsers(){
            if(this.$gate.isAdminOrAuthor()){
                 axios.get('adminusers')
              .then(({data}) => (this.users = data))
            }
             
          },

          getResults(page = 1) {
			axios.get('adminusers?page=' + page)
				.then(response => {
					this.users = response.data;
				});
		},


        createUser(){
            this.$Progress.start()
            this.form.post('/createUser')
            .then(()=> {
                Fire.$emit('AfterCreate');
                $('#addnew').modal('hide')
                toast.fire({
                icon: 'success',
                title: 'User created successfully'
              })
            this.$Progress.finish()
            })
            .catch(()=> {
              
            });
          
        }

        },

         created() {
            this.loadUsers()
            Fire.$on('AfterCreate', () => {
              this.loadUsers()
            })
            //setInterval(()=> this.loadUsers(), 3000);
        },
        // mounted() {
        //     console.log('Component mounted.')
        // }
    }
</script>
