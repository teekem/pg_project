<style >
    .row{
        padding:0;
    }
     .col-md-12 {
        padding:0;
    }
    #but{
        margin-bottom:0 ;
    }
</style>
<template>
   
        <div class="row">
            
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="row" id="but">
                        <div class="col-sm-3">
                            
<div class="card card-primary">
  <div class="card-header">
	<h3 class="card-title">New Faculty</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form @submit.prevent="newFaculty" role="form">
	<div class="card-body">
	
	  <div class="form-group">
		<input type="text" v-model="form.faculty" class="form-control" id="faculty" 
        name="faculty" :class="{ 'is-invalid': form.errors.has('faculty') }" placeholder="Your new faculty Here">
      <has-error :form="form" field="faculty"></has-error>
	  </div>
	  
	  <div class="form-group">
		<input type="text" v-model="form.faculty_code"  class="form-control" id="faculty_code" name="faculty_code"
         :class="{ 'is-invalid': form.errors.has('faculty_code') }" placeholder="faculty Code">
      <has-error :form="form" field="faculty_code"></has-error>
	  </div>
	</div>
	<!-- /.card-body -->

	<div class="card-footer">
	  <button type="submit" class="btn btn-primary">Create</button>
	</div>
  </form>
</div>
</div>

                <div class="col-sm-9">
                
<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Available Faculties</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Faculty</th>
                      <th>Faculty Code</th>
                      <th>Dean</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="faculty in faculties" :key="faculty.id">
                      <td>{{faculty.id}}</td>
                      <td>{{faculty.faculty}}</td>
                      <td>{{faculty.faculty_code}}</td>
                      <td>{{faculty.dean}}</td>
                      <td>{{faculty.created_at | dateFormat}}</td>
                       <td>
                          <a href="#" @click="editFaculty(faculty)"> <i class="fa fa-edit blue"></i> </a> /
                          <a href="#" @click="deleteFaculty(faculty.id)"> <i class="fa fa-trash red"></i> </a>
                        </td>
                    </tr>
                 
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

                </div>


        </div>
                </div>
            </div>

            <form @submit.prevent="updateFaculty()">
        <div class="modal fade" id="updateFaculty" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="addnewLabel">Update Faculty</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
      <input v-model="form.faculty" type="text" name="faculty"
        class="form-control" :class="{ 'is-invalid': form.errors.has('faculty') }" placeholder="Faculty Description ">
      <has-error :form="form" field="faculty"></has-error>
    </div>


      <div class="form-group">
      <input v-model="form.faculty_code" type="text" name="faculty_code"
        class="form-control" :class="{ 'is-invalid': form.errors.has('faculty_code') }" placeholder="Faculty Code">
      <has-error :form="form" field="faculty_code"></has-error>
    </div>

    <div class="form-group">
      <input v-model="form.dean" type="text" name="dean"
        class="form-control" :class="{ 'is-invalid': form.errors.has('dean') }" placeholder="Dean">
      <has-error :form="form" field="dean"></has-error>
    </div>
   
      </div>

      <div class="modal-footer">
        <button @click="cancle" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button  type="submit" class="btn btn-success">Update</button>
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
                faculties : {},
                form : new Form({
                    id: '',
                    faculty: '',
                    faculty_code: '',
                    dean : '',

                })
            }
        },

        methods: {

               cancle(){
              this.form.faculty = '',
              this.form.faculty_code = '',
              this.form.dean = ''
            }
            ,
            loadFaculty(){
                    axios.get('loadfaculty')
                    .then(({data}) => (this.faculties = data.data))
                    .catch()
            },

            newFaculty(){
                     this.$Progress.start()
                    this.form.post('postnewfaculty')
                    .then(()=> {
                     Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Faculty created successfully'
              })
              this.form.faculty = '',
              this.form.faculty_code = '',

               this.$Progress.finish()
            })
            .catch(()=> {
              
            });
            },
           
            editFaculty(faculty){
             this.form.reset();
              $('#updateFaculty').modal('show')
              this.form.fill(faculty);
          },

          updateFaculty(){
                this.$Progress.start()
                this.form.put('updatefaculty/'+ this.form.id)
                .then(() => {
                    $('#updateFaculty').modal('hide')
                    swal.fire(
                    'Updated!',
                    "User's Info Updated successfully.",
                    'success'
                    )
                    this.form.faculty = '',
                    this.form.faculty_code = '',
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                     this.$Progress.fail();
                })

          },

          deleteFaculty(id){
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
          this.form.delete('deletefaculty/'+id)
          .then(() => {
                swal.fire(
                'Deleted!',
               'Faculty deleted successfully.',
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

        },

         created() {
           
            this.loadFaculty()
            Fire.$on('AfterCreate', () => {
              this.loadFaculty()
            })
            //setInterval(()=> this.loadUsers(), 3000);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
