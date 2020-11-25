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
	<h3 class="card-title">New Course</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form @submit.prevent="newCourse" role="form">
	<div class="card-body">
	
	  <div class="form-group">
		<input type="text" v-model="form.course" class="form-control" id="course" 
        name="course" :class="{ 'is-invalid': form.errors.has('course') }" placeholder="Course">
      <has-error :form="form" field="course"></has-error>
	  </div>
	  
	  <div class="form-group">
		<input type="text" v-model="form.course_code"  class="form-control" id="course_code" name="course_code"
         :class="{ 'is-invalid': form.errors.has('course_code') }" placeholder="Course Code">
      <has-error :form="form" field="course_code"></has-error>
	  </div>

       <div class="form-group">
		<input type="number" v-model="form.unit"  class="form-control" id="unit" name="unit"
         :class="{ 'is-invalid': form.errors.has('unit') }" placeholder="Unit">
      <has-error :form="form" field="unit"></has-error>
	  </div>
	 
	  
	  <div class="form-check">
		<input type="checkbox" v-model="form.borrowable"  class="form-check-input" name="borrowable" id="borrow">
		<label class="form-check-label" for="borrow">Borrowable?</label>
	  </div>
	</div>
	<!-- /.card-body -->

	<div class="card-footer">
	  <button type="submit" class="btn btn-primary">Submit</button>
	</div>
  </form>
</div>
</div>

                <div class="col-sm-9">
                
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Available Courses</h3>

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
                      <th>Course id</th>
                      <th>Course</th>
                      <th>Code</th>
                      <th>Unit</th>
                      <th>Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="course in courses.data" :key="course.course_id">
                      <td>{{course.course_id}}</td>
                      <td>{{course.course}}</td>
                      <td>{{course.course_code}}</td>
                      <td>{{course.unit}}</td>
                      <td>{{course.created_at | dateFormat}}</td>
                       <td>
                          <a href="#" @click="editCourse(course)"> <i class="fa fa-edit blue"></i> </a> /
                          <a href="#" @click="deleteCourse(course.id)"> <i class="fa fa-trash red"></i> </a>
                        </td>
                    </tr>
                 
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer ">
                  <pagination :data="courses" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
            </div>
            </div>

                </div>


        </div>
         <!-- 404 page here-->
        <div v-if="!$gate.isAdminOrAuthor()">
           <not-found></not-found>
        </div>

        <!-- Modal -->
            <form @submit.prevent="updateCourse()">
        <div class="modal fade" id="updateCourse" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="addnewLabel">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
      <input v-model="form.course" type="text" name="course"
        class="form-control" :class="{ 'is-invalid': form.errors.has('course') }" placeholder="Course">
      <has-error :form="form" field="course"></has-error>
    </div>


      <div class="form-group">
      <input v-model="form.course_code" type="text" name="course_code"
        class="form-control" :class="{ 'is-invalid': form.errors.has('course_code') }" placeholder="Course Code">
      <has-error :form="form" field="course_code"></has-error>
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
              
                courses: {},
                form : new Form({
                    course_id: '',
                    course: '',
                    course_code: '',
                    unit: '',
                    borrowable: '',

                })
            }
        },

        methods: {
               getResults(page = 1) {
              axios.get('loadCourses?page=' + page)
                .then(response => {
                  this.courses = response.data;
                });
            },

            cancle(){
              this.form.course = '',
              this.form.course_code = '',
              this.form.unit = '',
              this.form.borrowable = ''
               
            }
            ,
            newCourse(){
            this.$Progress.start()
            this.form.post('newCourse')
            .then(()=> {
                Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Course created successfully'
              })
              this.form.course = '',
              this.form.course_code = '',
              this.form.unit = '',
              this.form.borrowable = ''
            this.$Progress.finish()
            })
            .catch(()=> {
              
            });
            },

            loadCourses(){
                axios.get('loadCourses')
                .then(({data})=> (this.courses = data))
                
                .catch()
            },
            editCourse(course){
             this.form.reset();
              $('#updateCourse').modal('show')
              this.form.fill(course);
          },
          updateCourse(){
                this.$Progress.start()
                this.form.put('updatecourse/'+ this.form.id)
                .then(() => {
                    $('#updateCourse').modal('hide')
                    swal.fire(
                    'Updated!',
                    "User's Info Updated successfully.",
                    'success'
                    )
                    this.form.course = '',
                    this.form.course_code = '',
                    this.form.unit = '',
                    this.form.borrowable = ''
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                     this.$Progress.fail();
                })

          },

          deleteCourse(id){
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
          this.form.delete('deletecourse/'+id)
          .then(() => {
                swal.fire(
                'Deleted!',
               'User deleted successfully.',
                'success'
            )
            Fire.$emit('AfterCreate');
            this.cancle()
          })
          .catch(()=> {
            swal("Failed", "There was something wrong" , "warning");
            this.cancle()
          })
          }
        })
     },

        },

         created() {
            this.loadCourses()
            Fire.$on('AfterCreate', () => {
              this.loadCourses()
            })
            //setInterval(()=> this.loadUsers(), 3000);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
