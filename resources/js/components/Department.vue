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
	<h3 class="card-title">New Department</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form @submit.prevent="newDepartment" role="form">
	<div class="card-body">
	
	  <div class="form-group">
		<input type="text" v-model="form.department" class="form-control" id="department" 
        name="department" :class="{ 'is-invalid': form.errors.has('department') }" placeholder="Your new department Here">
      <has-error :form="form" field="department"></has-error>
	  </div>
	  
	  <div class="form-group">
		<input type="text" v-model="form.department_id"  class="form-control" id="department_id" name="department_id"
         :class="{ 'is-invalid': form.errors.has('department_id') }" placeholder="department Code">
      <has-error :form="form" field="department_id"></has-error>
	  </div>

     <div class="form-group">
        <select v-model="form.faculty_id"   class="custom-select custom-select-sm form-control" id="faculty_id" name="faculty_id"
       :class="{ 'is-invalid': form.errors.has('faculty_id') }">
      <has-error :form="form" field="faculty_id"></has-error>>
            <option selected disabled>Select faculty</option>
            <option v-for="faculty in faculties" :key="faculty.id" :value="faculty.id"> {{faculty.faculty}}</option>
            
     </select>
	  </div>
      
      

	</div>
	<!-- /.card-body -->

	<div class="card-footer">
	  <button type="submit" class="btn btn-primary float-right">Create</button>
	</div>
  </form>
</div>
</div>

                <div class="col-sm-9">
                
<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Available Departments</h3>

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
                      <th>Department</th>
                      <th>Department Code</th>
                      <th>HOD</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="department in departments" :key="department.id">
                      <td>{{department.id}}</td>
                      <td>{{department.department}}</td>
                      <td>{{department.department_id}}</td>
                      <td>{{department.hod}}</td>
                      <td>{{department.created_at | dateFormat}}</td>
                       <td>
                          <a href="#" @click="editDepartment(department)"> <i class="fa fa-edit blue"></i> </a> /
                          <a href="#" @click="deleteDepartment(department.id)"> <i class="fa fa-trash red"></i> </a>
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

            <form @submit.prevent="updateDepartment()">
        <div class="modal fade" id="updateDepartment" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="addnewLabel">Update Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
      <input v-model="form.department" type="text" name="department"
        class="form-control" :class="{ 'is-invalid': form.errors.has('department') }" placeholder="Department Description ">
      <has-error :form="form" field="department"></has-error>
    </div>


      <div class="form-group">
      <input v-model="form.department_id" type="text" name="department_id"
        class="form-control" :class="{ 'is-invalid': form.errors.has('department_id') }" placeholder="Department Code">
      <has-error :form="form" field="department_id"></has-error>
    </div>

     <div class="form-group">
        <select v-model="form.faculty_id"   class="custom-select custom-select-sm form-control" id="faculty_id" name="faculty_id"
       :class="{ 'is-invalid': form.errors.has('faculty_id') }">
      <has-error :form="form" field="faculty_id"></has-error>>
            <option selected>Select faculty</option>
            <option v-for="faculty in faculties" :key="faculty.id" :value="faculty.id"> {{faculty.faculty}}</option>
            
     </select>
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
                dep_fac: {},
                departments : {},
                faculties: {},
                form : new Form({
                    id: '',
                    department: '',
                    department_id: '',
                    hod : '',
                    faculty_id: ''

                })
            }
        },

        methods: {
               cancle(){
              this.form.department = '',
              this.form.department_id = '',
              this.form.faculty_id   = ''

               
            }
            ,

            loadDepartment(){
                    axios.get('loaddepartment')
                    .then(({data}) => {this.dep_fac = data
                                      this.departments = this.dep_fac.dep.data
                                      this.faculties = this.dep_fac.fac})
                    .catch()
            },

            newDepartment(){
                     this.$Progress.start()
                    this.form.post('postnewdepartment')
                    .then(()=> {
                     Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Department created successfully'
              })
              this.form.department = '',
              this.form.department_id = '',
              this.form.faculty_id   = '',

               this.$Progress.finish()
            })
            .catch(()=> {
              
            });
            },
           
            editDepartment(department){
             this.form.reset();
              $('#updateDepartment').modal('show')
              this.form.fill(department);
          },

          updateDepartment(){
                this.$Progress.start()
                this.form.put('updatedepartment/'+ this.form.id)
                .then(() => {
                    $('#updateDepartment').modal('hide')
                    swal.fire(
                    'Updated!',
                    "User's Info Updated successfully.",
                    'success'
                    )
                    this.form.department = '',
                    this.form.department_id = '',
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                     this.$Progress.fail();
                })

          },

          deleteDepartment(id){
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
          this.form.delete('deletedepartment/'+id)
          .then(() => {
                swal.fire(
                'Deleted!',
               'Department deleted successfully.',
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
           
            this.loadDepartment()
            Fire.$on('AfterCreate', () => {
              this.loadDepartment()
            })
            //setInterval(()=> this.loadUsers(), 3000);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
