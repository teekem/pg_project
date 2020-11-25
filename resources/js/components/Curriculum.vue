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
	<h3 class="card-title">New Curriculum</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form @submit.prevent="newCurriculum" role="form">
	<div class="card-body">

    <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text custom-select-md" for="programme_id">Programmes</label>
  </div>
  <select v-model="form.programme_id"   class="custom-select custom-select-md form-control" 
        id="programme_id" name="programme_id"
       :class="{ 'is-invalid': form.errors.has('programme_id') }">
      <has-error :form="form" field="programme_id"></has-error>>
          
            <option v-for="programme in programmes" :key="programme.id" :value="programme.id"> {{programme.programme}}</option>
            
     </select>
</div>
    </div>

          <!-- assign course to programme start -->
    <div class="form-group">
    <div class="input-group">
  <!-- <div class="input-group-prepend ">
    <label class="input-group-text custom-select-sm" for="semester">Semester</label>
  </div> -->
                <vue-multi-select
          ref="multiSelect"
        
          v-model="form.course_id"
          search
          historyButton
          :options="options"
          :filters="filters"
          :btnLabel="btnLabel"
          @open="open"
          @close="close"
          :selectOptions="this.courses">
          <template v-slot:option="{option}">
            <input type="checkbox" :checked="option.selected"/>
            <span>{{option.name}}</span>
          </template>
        </vue-multi-select>
</div>
    </div>
        <!-- assign course to programme end -->

        <!-- semester start -->
          <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend ">
    <label class="input-group-text custom-select-md" for="semester">Semester</label>
  </div>
   <select v-model="form.semester"   class="custom-select custom-select-md form-control" id="semester" name="semester"
       :class="{ 'is-invalid': form.errors.has('semester') }">
      <has-error :form="form" field="semester"></has-error>>
    
            <option v-for="semester in semesters " :key="semester.id" :value="semester.id"> {{semester.semester}}</option>
            
     </select>
</div>
    </div>
      <!-- semester end -->

      
        <!-- level start -->
          <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend ">
    <label class="input-group-text custom-select-md" for="level">Level</label>
  </div>
   <select v-model="form.level"   class="custom-select custom-select-md form-control" id="level" name="level"
       :class="{ 'is-invalid': form.errors.has('level') }">
      <has-error :form="form" field="level"></has-error>>
    
            <option v-for="level in levels " :key="level.id" :value="level.id"> {{level.name}}</option>
            
     </select>
</div>
    </div>
      <!-- level end -->

    <!-- Select course status for programme-->
                          
    <div class="form-group">
    <div class="input-group">
    <vue-multi-select
          ref="multiSelect"
        
          v-model="form.course_status"
          search
          historyButton
          :options="options"
          :filters="filters"
          :btnLabel="btnLabel2"
          @open="open"
          @close="close"
          :selectOptions="this.form.course_id">
          <template v-slot:option="{option}">
            <input type="checkbox" :checked="option.selected"/>
            <span>{{option.name}}</span>
          </template>
        </vue-multi-select>
</div>
    </div>
       <!-- status ends -->

	</div>
	<!-- /.card-body -->

	<div class="card-footer">
	  <button type="submit" class="btn btn-primary float-right">Submit</button>
	</div>
  </form>
</div>
</div>

                <div class="col-sm-9">
                
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Curriculum Table</h3>
              <!-- table header card -->
                <div class="card-tools">
                  <nav class="navbar navbar-expand ">
                 
         <div class="col-md-4 mt-0">
    <div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text custom-select-sm" for="programme_id">By Programmes</label>
  </div>
  <select v-model="byprogramme"  @change="searchcurriculum2"  class="custom-select custom-select-sm form-control" 
        id="programme_id" name="programme_id"
       :class="{ 'is-invalid': form.errors.has('programme_id') }">
      <has-error :form="form" field="programme_id"></has-error>>
            <option value="" 
            v-html="this.byprogramme? this.byprogramme+ 'selected (click to deselect)'
             : ' select programme'"> </option>
            <option v-for="programme in programmes" :key="programme.id" :value="programme.programme_id"> {{programme.programme}}</option>
            
     </select>
</div>
    </div>
    <!-- end search by programm -->
    <div class="col-md-4 mt-0">
    <div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text custom-select-sm" for="programme_id">By Status</label>
  </div>
    <select v-model="bystatus" @change="searchcurriculum2"    class="custom-select custom-select-sm form-control" id="status" name="status"
       :class="{ 'is-invalid': form.errors.has('status') }">
      <has-error :form="form" field="status"></has-error>>
            <option value="" 
            v-html="this.bystatus? this.bystatus+ 'selected (click to deselect)'
             : ' select status'"> </option>
            <option v-for="status in statuses" :key="status.id" :value="status.value"> {{status.name}}</option>
            
     </select>
</div>
    </div>
      <div class="col-md-4 mt-0">
    <div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text custom-select-sm" for="programme_id">By Level</label>
  </div>
     <select v-model="bylevel" @change="searchcurriculum2"  class="custom-select custom-select-sm form-control" id="level" name="level"
       :class="{ 'is-invalid': form.errors.has('level') }">
      <has-error :form="form" field="level"></has-error>>
          <option value="" 
            v-html="this.bylevel? this.bylevel+ 'selected (click to deselect)'
             : ' select level'"> </option>
            <option v-for="level in levels " :key="level.id" :value="level.id"> {{level.name}}</option>
            
     </select>
</div>
    </div>
                   
                  </nav>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <!-- <th>Id</th> -->
                      <th>Proramme Code</th>
                      <th>Course Code</th>
                      <th>Status</th>
                      <th>Level</th>
                      <th>Semester</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="curriculum in curriculums" :key="curriculum.id">
                      <!-- <td>{{curriculum.id}}</td> -->
                      <td>{{curriculum.programme_id}}</td>
                      <td>{{curriculum.course_code}}</td>
                      <td>{{curriculum.status}}</td>
                      <td>{{curriculum.level}}</td>
                      <td>{{curriculum.semester}}</td>
                       <td>
                          <a href="#" @click="editCurriculum(curriculum)"> <i class="fa fa-edit blue"></i> </a> /
                          <a href="#" @click="deleteCurriculum(curriculum.id)"> <i class="fa fa-trash red"></i> </a>
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

            <form @submit.prevent="updateCurriculum()">
        <div class="modal fade" id="updateCurriculum" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="addnewLabel">Update Curriculum</h5>
        <button type="button" @click="cancle" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <!-- semester start -->
          <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend ">
    <label class="input-group-text custom-select-sm" for="semester">Semester</label>
  </div>
   <select v-model.trim="form.semester"  class="custom-select custom-select-sm form-control" id="semester" name="semester"
       :class="{ 'is-invalid': form.errors.has('semester') }">
      <has-error :form="form" field="semester"></has-error>>
    
        <option v-for="semester in semesters " :key="semester.id" :value="semester.semester"> {{semester.semester}}</option>
            
     </select>

</div>
    </div>
      <!-- semester end -->

      
        <!-- level start -->
          <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend ">
    <label class="input-group-text custom-select-sm" for="level">Level</label>
  </div>
   <select v-model="form.level"   class="custom-select custom-select-sm form-control" id="level" name="level"
       :class="{ 'is-invalid': form.errors.has('level') }">
      <has-error :form="form" field="level"></has-error>>
    
            <option v-for="level in levels " :key="level.id" :value="level.id"> {{level.name}}</option>
            
     </select>
</div>
    </div>
      <!-- level end -->

  <!-- status start -->
            <div class="form-group">
    <div class="input-group">
  <div class="input-group-prepend ">
    <label class="input-group-text custom-select-sm" for="level">Status</label>
  </div>
   <select v-model="form.status"   class="custom-select custom-select-sm form-control" id="status" name="status"
       :class="{ 'is-invalid': form.errors.has('status') }">
      <has-error :form="form" field="status"></has-error>>
    
            <option v-for="status in statuses" :key="status.id" :value="status.value"> {{status.name}}</option>
            
     </select>
</div>
    </div>

  <!-- status end  -->

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
import vueMultiSelect from 'vue-multi-select';
import 'vue-multi-select/dist/lib/vue-multi-select.css';
    export default {

        data(){
            return{
                searchpara: '',
                bystatus: '',
                bylevel:'',
                byprogramme:'',
                pro_cur: {},
                courses: [],
                programmes: {},
                curriculums: {},
                 statuses : [
                 { name:'Compulsary', id:1, value:'C'},
                 {name: 'Elective', id:2, value:'E'},
                ],
                semesters : [
                //  { name:'first semester', value:'first semester', id:1},
                //  {name: 'second semester', value:'second semester', id:2},
                //  { name: 'third semester', value: 'third semester', id:3}
                ],
                 levels : [
                 { name:'100 level', id:100},
                 {name: '200 level', id:200},
                 { name: '300 level', id:300},
                 { name: '400 level', id:400},
                 { name: '500 level', id:500},
                 { name: '600 level', id:600},
                 { name: '700 level', id:700},
                 { name: '800 level', id:800},
                ],
                form : new Form({
                    id: '',
                    programme_id: '',
                    level: '',
                    semester: '',
                    course_id: [] ,
                    course_status: [] ,
                    status : ''

                }),

                btnLabel: values => `Asign Course(s) to programme (${values.length})`,
                btnLabel2: values => `check only elective Course(s) for this programme (${values.length})`,

                //values: [],
   
      filters: [{
        nameAll: 'Select all',
        nameNotAll: 'Deselect all',
        func() {
          return true;
        },
      }, 
      {
        nameAll: 'select <= 10',
        nameNotAll: 'Deselect <= 10',
        func(elem) {
          return elem.name <= 10;
        },
      }, {
        nameAll: 'Select contains 2',
        nameNotAll: 'Deselect contains 2',
        func(elem) {
          return elem.name.indexOf('2') !== -1;
        },
      }],
      options: {
           multi: true,
           
      },
            }
        },

        methods: {
          searchcurriculum2(){
              Fire.$emit('search2')
          }
          ,

            checkbox(){
                    //console.log('working......')
                     toast.fire({
                icon: 'success',
                title: 'Curriculum created successfully'
              })
            },
                        openManually() {
                this.$refs.multiSelect.openMultiSelect();
                },
                open() {
                console.log('open');
                },
                close() {
                console.log('close');
                },
            
            
            cancle(){
              this.form.programme_id='',
              this.form.level= '',
             this.form.semester= '',
             this.form.course_id= [] ,
             this.form.status = ''

            }
            ,
            newCurriculum(){
                //console.log(this.form.course_id)
            this.$Progress.start()
            this.form.post('postnewcurriculum')
            .then(()=> {
                Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Curriculum created successfully'
              })
             this.form.programme_id='',
              this.form.level= '',
             this.form.semester= '',
             this.form.course_id= [],
            this.form.course_status = [] 


            this.$Progress.finish()
            })
            .catch(()=> {
              
            });
            },

            loadCurriculum(){
                axios.get('loadcurriculum')
                .then(({data})=> {this.pro_cur = data
                                  this.curriculums= this.pro_cur.db_cur
                                  this.programmes = this.pro_cur.db_pro
                                  this.courses = this.pro_cur.db_cou
                                  this.semesters = this.pro_cur.db_seme
                                 })
                
                .catch()
            },
            editCurriculum(curriculum){
             this.form.reset();
              $('#updateCurriculum').modal('show')
              this.form.fill(curriculum);
          },
          updateCurriculum(){
                this.$Progress.start()
                this.form.put('updatecurriculum/'+ this.form.id)
                .then(() => {
                    $('#updateCurriculum').modal('hide')
                    swal.fire(
                    'Updated!',
                    "User's Info Updated successfully.",
                    'success'
                    )
                     this.form.programme_id='',
                     this.form.level= '',
                    this.form.semester= '',
                    this.form.course_id= [] 


                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                     this.$Progress.fail();
                })

          },

          deleteCurriculum(id){
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
          this.form.delete('deletecurriculum/'+id)
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
            this.loadCurriculum()
            Fire.$on('AfterCreate', () => {
              this.loadCurriculum()
            })


            Fire.$on('searching', ()=>{
              let query = this.$parent.search
              axios.get('searchcurriculum?q=' + query)
              .then((data)=> {
                    this.curriculums= data.data
              })
              .catch()
            })

            Fire.$on('search2', ()=> {
            
                let searchpara = {}
                if(this.byprogramme != ''){
                  searchpara.byprogramme = this.byprogramme
                }
                if( this.bystatus != ''){
                     searchpara.bystatus = this.bystatus
                }
                if( this.bylevel != ''){
                     searchpara.bylevel = this.bylevel
                }
            if(this.byprogramme != '' || this.bystatus != '' || this.bylevel != ''){
                axios.get('searchcurriculum2?q=' + JSON.stringify(searchpara) )
           .then((data) => {
                this.curriculums= data.data
                // this.byprogramme = ''
                // this.bystatus = ''
                // this.bylevel = ''
           })
           .catch()
            }
            else{ this.loadCurriculum() }
            })
            
            //setInterval(()=> this.loadUsers(), 3000);
        },
        mounted() {
            console.log('Component mounted.')
        },

        components: {
                vueMultiSelect,
            },
    }
</script>
