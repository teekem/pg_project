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
	<h3 class="card-title">New Programme</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form @submit.prevent="newProgramme" role="form">
	<div class="card-body">
	
	  <div class="form-group">
		<input type="text" v-model="form.programme" class="form-control" id="programme" 
        name="programme" :class="{ 'is-invalid': form.errors.has('programme') }" placeholder="programme">
      <has-error :form="form" field="programme"></has-error>
	  </div>
	  
	  <div class="form-group">
		<input type="text" v-model="form.programme_id"  class="form-control" id="programme_id" name="programme_id"
         :class="{ 'is-invalid': form.errors.has('programme_id') }" placeholder="Programme Code">
      <has-error :form="form" field="programme_id"></has-error>
	  </div>


    <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text custom-select-sm" for="department_id">Department</label>
  </div>
  <select v-model="form.department_id"   class="custom-select custom-select-sm form-control" 
        id="department_id" name="department_id"
       :class="{ 'is-invalid': form.errors.has('department_id') }">
      <has-error :form="form" field="department_id"></has-error>>
          
            <option v-for="department in departments" :key="department.id" :value="department.id"> {{department.department}}</option>
            
     </select>
</div>
    </div>


  <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend ">
    <label class="input-group-text custom-select-sm" for="faculty_id">Faculty</label>
  </div>
   <select v-model="form.faculty_id"   class="custom-select custom-select-sm form-control" id="faculty_id" name="faculty_id"
       :class="{ 'is-invalid': form.errors.has('faculty_id') }">
      <has-error :form="form" field="faculty_id"></has-error>>
    
            <option v-for="faculty in faculties" :key="faculty.id" :value="faculty.id"> {{faculty.faculty}}</option>
            
     </select>
</div>
    </div>

	</div>
	<!-- /.card-body -->

	<div class="card-footer">
	  <button type="submit" class="btn btn-primary float-right">Submit</button>
	</div>
  </form>
</div>
</div>

                <div class="col-sm-9">
                
<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Available Programme</h3>

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
                      <th>Programme</th>
                      <th>Proramme Code</th>
                      <th>Department</th>
                      <th>Faculty</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="programme in programmes" :key="programme.id">
                      <td>{{programme.id}}</td>
                      <td>{{programme.programme}}</td>
                      <td>{{programme.programme_id}}</td>
                      <td>{{programme.department}}</td>
                      <td>{{programme.faculty}}</td>
                       <td>
                          <a href="#" @click="editProgramme(programme)"> <i class="fa fa-edit blue"></i> </a> /
                          <a href="#" @click="deleteProgramme(programme.id)"> <i class="fa fa-trash red"></i> </a>
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

            <form @submit.prevent="updateProgramme()">
        <div class="modal fade" id="updateProgramme" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="addnewLabel">Update Programme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
      <input v-model="form.programme" type="text" name="programme"
        class="form-control" :class="{ 'is-invalid': form.errors.has('programme') }" placeholder="Programme">
      <has-error :form="form" field="programme"></has-error>
    </div>


      <div class="form-group">
      <input v-model="form.programme_id" type="text" name="programme_id"
        class="form-control" :class="{ 'is-invalid': form.errors.has('programme_id') }" placeholder="Programme Code">
      <has-error :form="form" field="programme_id"></has-error>
    </div>

    <div class="form-group">
      <input v-model="form.unit" type="number" name="unit"
        class="form-control" :class="{ 'is-invalid': form.errors.has('unit') }" placeholder="Unit">
      <has-error :form="form" field="unit"></has-error>
    </div>

    <div class="form-check">
		<input type="checkbox" v-model="form.borrowable"  class="form-check-input" name="borrowable" id="borrow1"
       :class="{ 'is-invalid': form.errors.has('borrowable') }" >
      <has-error :form="form" field="borrowable"></has-error>
		<label class="form-check-label" for="borrow">Borrowable?</label>
	  </div>

      </div>
      <div class="modal-footer">
        <button type="button" @click="cancle" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                pro_dep_fac: {},
                faculties: {},
                departments: {},
                programmes: {},
                form : new Form({
                    id: '',
                    programme: '',
                    programme_id: '',
                    department_id: '',
                    faculty_id: ''

                })
            }
        },

        methods: {
            cancle(){
              this.form.programme = '',
              this.form.programme_id = '',
             this.form.department_id ='',
             this.form.faculty_id = ''

               
            }
            ,
            newProgramme(){
            this.$Progress.start()
            this.form.post('postnewprogramme')
            .then(()=> {
                Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Programme created successfully'
              })
              this.form.programme = '',
              this.form.programme_id = '',
              this.form.department_id= '',
              this,form.faculty_id= ''

            this.$Progress.finish()
            })
            .catch(()=> {
              
            });
            },

            loadProgrammes(){
                axios.get('loadprogramme')
                .then(({data})=> {this.pro_dep_fac = data
                                  this.programmes = this.pro_dep_fac.pro
                                  this.departments = this.pro_dep_fac.dep
                                  this.faculties = this.pro_dep_fac.fac})
                
                .catch()
            },
            editProgramme(programme){
             this.form.reset();
              $('#updateProgramme').modal('show')
              this.form.fill(programme);
          },
          updateProgramme(){
                this.$Progress.start()
                this.form.put('updateprogramme/'+ this.form.id)
                .then(() => {
                    $('#updateProgramme').modal('hide')
                    swal.fire(
                    'Updated!',
                    "User's Info Updated successfully.",
                    'success'
                    )
                    this.form.programme = '',
                    this.form.programme_id = '',
                    this.form.department_id= '',
                    this.form.faculty_id= ''

                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                     this.$Progress.fail();
                })

          },

          deleteProgramme(id){
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
          this.form.delete('deleteprogramme/'+id)
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

        },

         created() {
            this.loadProgrammes()
            Fire.$on('AfterCreate', () => {
              this.loadProgrammes()
            })
            //setInterval(()=> this.loadUsers(), 3000);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
