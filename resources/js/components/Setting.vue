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
    /* .card-primary{
        background-color: rgb(166, 180, 72);
    } */
</style>
<template>
  
       <div >

 <!-- Tabs with card integration -->
    <b-card no-body>
      <b-tabs  small card>
        <b-tab title="General Settings">  <!-- first tab start here -->

                  <div>
                <b-card no-body  >
                    <b-row no-gutters>
                    <b-col md="12">

                              <!-- <div class="card"> -->
                    <div class="row" id="but">
                        <div class="col-sm-3">
    
    <div class="card card-primary">
  <div class="card-header">
	<h3 class="card-title">Switch Semester</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form @submit.prevent="newSetting" role="form">
	<div class="card-body">
	
              
    <div class="form-group">
                    <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text custom-select-md" for="setting_session">Session</label>
                </div>
            <select v-model="form2.setting_session"   class="custom-select custom-select-md form-control" 
                    id="setting_session" name="setting_session"
                :class="{ 'is-invalid': form2.errors.has('setting_session') }">
                <has-error :form="form2" field="setting_session"></has-error>>
                    
                <option v-for="session in sessions" :key="session.id" :value="session.id"> {{session.session}}</option>
                        
            </select>
                </div>
    </div>

    <div class="form-group">
                    <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text custom-select-md" for="setting_semester">Semester</label>
                </div>
            <select v-model="form2.setting_semester"   class="custom-select custom-select-md form-control" 
                    id="setting_semester" name="setting_semester"
                :class="{ 'is-invalid': form2.errors.has('setting_semester') }">
                <has-error :form="form2" field="setting_semester"></has-error>>
                    
                <option v-for="semester in semesters" :key="semester.id" :value="semester.id"> {{semester.semester}}</option>
                        
            </select>
                </div>
    </div>
         
	

         <div class="form-group">
                        <div>
                     <b-input-group class="mb-3">
                         
                    <b-input-group-append>
                        <b-form-datepicker
                        :min="minDate"
                        dropright
                        v-model="form2.setting_started_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="setting_started_at"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                    <b-form-input  name="setting_started_at" :class="{ 'is-invalid': form1.errors.has('setting_started_at') }"
                        id="setting_started_at"
                        v-model="form2.setting_started_at"
                        type="text"
                        placeholder="Start Date"
                        autocomplete="off"
                    ></b-form-input>
                   
                     <has-error :form="form2" field="setting_started_at"></has-error>
                    </b-input-group>

                    <b-input-group class="mb-3">
                        
                    <b-input-group-append>
                        <b-form-datepicker
                        dropright
                        v-model="form2.setting_ended_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="setting_ended_at"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                    <b-form-input  name="setting_ended_at" :class="{ 'is-invalid': form1.errors.has('setting_ended_at') }"
                        id="setting_ended_at"
                        v-model="form2.setting_ended_at"
                        type="text"
                        placeholder="End Date"
                        autocomplete="off"
                    ></b-form-input>
                    
                    <has-error :form="form2" field="setting_ended_at"></has-error>
                    </b-input-group>

                 <b-form-checkbox v-model.number="form2.setting_status" button-variant="primary" value="1">
                     <span  >Set as current semester</span>
                     </b-form-checkbox>

                </div>


       
	  </div>

	</div>
	<!-- /.card-body end -->

	<div class="card-footer">
         <b-button type="submit"  pill variant="primary">Switch</b-button>
	  
	</div>
  </form>
</div>
</div>

                <div class="col-sm-9">
                
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Semester / Session Settings</h3>

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
              <div class="card-body table-responsive p-0" >
                      <!-- carryover table -->
            <div>
  <b-table-simple caption-top hover striped  responsive="sm">
      
    <thead>
      <tr>
        <th  class="align-middle">Id</th> 
        <th  class="align-middle">Session </th>
        <th  class="align-middle">Semester</th>
        <th  class="align-middle">Registration Status</th>
        <th  class="align-middle">Active Semester</th>
        <th class="align-middle">Started Date</th>
        <th class="align-middle">Ended Date</th>
        <th class="align-middle">Action</th>
      </tr>
     
    </thead>
    <tbody>
     
      <tr v-for="setting in settings" :key="setting.id">
          <td>{{setting.setting_id}}</td> 
        <td>{{setting.setting_session}}</td>
        <td>{{setting.setting_semester}}</td>
        <!-- <td>{{setting.setting_reg_status}}</td> -->
        <td v-if="setting.setting_reg_status == 0" > Registration CLosed </td>
        <td v-else-if="setting.setting_reg_status == 1" > Late Registration  </td>
        <td v-else > Registration In Progress</td>


        <td v-if="setting.setting_status == 1">Active</td>
        <td v-else>Non Active</td>
        <td>{{setting.setting_started_at}}</td>
        <td>{{setting.setting_ended_at}}</td>
        <td>
           <a href="#" @click="editSetting(setting)"> <i class="fa fa-edit blue"></i> </a> /
          <a href="#" @click="deleteSetting(setting.setting_id)"> <i class="fa fa-trash red"></i> </a>
        </td>
     
     
      </tr>
    </tbody>

  </b-table-simple>
</div>
         <!-- carryover table ends -->

              </div> 
              <!-- /.card-body -->
              <div class="card-footer ">
                  <!-- <pagination ></pagination> -->
                  <span>pagination here</span>
                  
                </div>
            </div>
            </div>
            </div>

                <!-- </div> -->
                    
                    </b-col>
                    </b-row>
                </b-card>
            </div>
             <!-- Modal start -->
            <form @submit.prevent="updateSetting()">
        <div class="modal fade" id="updateSetting" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="addnewLabel">Update Setting</h5>
        <button type="button"  @click="settingCancle"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         
    <div class="form-group">
                    <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text custom-select-md" for="setting_status">Activate Semester</label>
                </div>
            <select v-model="form2.setting_status"   class="custom-select custom-select-md form-control" 
                    id="setting_status" name="setting_status"
                :class="{ 'is-invalid': form2.errors.has('setting_status') }">
                <has-error :form="form2" field="setting_status"></has-error>>
                    
                <option v-for="status in set_status" :key="status.id" :value="status.value"> {{status.name}}</option>
                        
            </select>
                </div>
    </div>
         

        <div class="form-group">
                <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text custom-select-md" for="setting_reg_status">Reg Status</label>
            </div>
        <select v-model.number="form2.setting_reg_status"   class="custom-select custom-select-md form-control" 
                id="setting_reg_status" name="setting_reg_status"
            :class="{ 'is-invalid': form2.errors.has('setting_reg_status') }">
            <has-error :form="form2" field="setting_reg_status"></has-error>>
                
             <option v-for="reg in reg_status" :key="reg.id" :value="reg.value"> {{reg.name}}</option>
                    
        </select>
            </div>
    </div>


        <div class="form-group">
                        <div>
                     <b-input-group class="mb-3">
                          <b-input-group-append>
                        <b-form-datepicker
                        dropright
                        :min="minDate"
                        v-model="form2.setting_started_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="setting_started_at"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                    <b-form-input  name="setting_started_at" :class="{ 'is-invalid': form1.errors.has('setting_started_at') }"
                        id="setting_started_at"
                        v-model="form2.setting_started_at"
                        type="text"
                        placeholder="Start Date"
                        autocomplete="off"
                    ></b-form-input>
                     <has-error :form="form1" field="setting_started_at"></has-error>
                    </b-input-group>

                    <b-input-group class="mb-3">  
                    <b-input-group-append>
                        <b-form-datepicker
                        dropright
                        v-model="form2.setting_ended_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="setting_ended_at"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                    <b-form-input  name="setting_ended_at" :class="{ 'is-invalid': form1.errors.has('setting_ended_at') }"
                        id="setting_ended_at"
                        v-model="form2.setting_ended_at"
                        type="text"
                        placeholder="End Date"
                        autocomplete="off"
                    ></b-form-input>
                    <has-error :form="form2" field="setting_ended_at"></has-error>
                    </b-input-group>
                    
                </div>
	  </div>
      </div>
      <div class="modal-footer">
           <b-button-group size="sm" class="mr-1">
                <b-button @click="settingCancle" variant="danger" data-dismiss="modal">Close</b-button>
                <b-button type="submit" variant="success" >Update</b-button>
            </b-button-group>
        
      </div>
    </div>
  </div>
</div>
</form>
<!-- modal ends here -->
        </b-tab> <!-- first tab end here -->
       

        <b-tab title="Session">  <!-- second tab start here -->
            <div>
                <b-card no-body  >
                    <b-row no-gutters>
                    <b-col md="12">

                              <!-- <div class="card"> -->
                    <div class="row" id="but">
                        <div class="col-sm-3">
    
    <div class="card card-primary">
  <div class="card-header">
	<h3 class="card-title">New Session</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form @submit.prevent="newSession" role="form">
	<div class="card-body">
	
	  <div class="form-group">
		<input type="text" v-model="form1.session" class="form-control" id="session" 
        name="session" :class="{ 'is-invalid': form1.errors.has('session') }" placeholder="Session Description">
      <has-error :form="form1" field="session"></has-error>
	  </div>
	  
	  <div class="form-group">
                        <div>
                     <b-input-group class="mb-3">
                    <b-form-input  name="session_started_at" :class="{ 'is-invalid': form1.errors.has('session_started_at') }"
                        id="session_started_at"
                        v-model="form1.session_started_at"
                        type="text"
                        placeholder="Start Date"
                        autocomplete="off"
                    ></b-form-input>
                   
                    <b-input-group-append>
                        <b-form-datepicker
                        :min="minDate"
                        dropright
                        v-model="form1.session_started_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="session_started_at"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                     <has-error :form="form1" field="session_started_at"></has-error>
                    </b-input-group>

                    <b-input-group class="mb-3">
                    <b-form-input  name="session_ended_at" :class="{ 'is-invalid': form1.errors.has('session_ended_at') }"
                        id="session_ended_at"
                        v-model="form1.session_ended_at"
                        type="text"
                        placeholder="End Date"
                        autocomplete="off"
                    ></b-form-input>
                    
                    <b-input-group-append>
                        <b-form-datepicker
                        dropright
                        v-model="form1.session_ended_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="session_ended_at"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                    <has-error :form="form1" field="session_ended_at"></has-error>
                    </b-input-group>
                    
                </div>
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
                
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Available Sessions</h3>

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
              <div class="card-body table-responsive p-0" >
                      <!-- carryover table -->
            <div>
  <b-table-simple caption-top hover striped  responsive="sm">
     
     
    <thead>
      <tr>
        <th  class="align-middle">Id</th>
        <th  class="align-middle">Session Description</th>
        <th  class="align-middle">Started Date</th>
        <th class="align-middle">Ended Date</th>
        <th class="align-middle">Action</th>
      </tr>
     
    </thead>
    <tbody>
     
      <tr v-for="session in sessions" :key="session.id">
          <td>{{session.id}}</td>  <!-- Note: value stands for ID but fetch from database AS value  -->
        <td>{{session.session}}</td> <!-- NOte: text stands for session also -->
        <td>{{session.session_started_at}}</td>
        <td>{{session.session_ended_at}}</td>
        <td>
           <a href="#" @click="editSession(session)"> <i class="fa fa-edit blue"></i> </a> /
          <a href="#" @click="deleteSession(session.id)"> <i class="fa fa-trash red"></i> </a>
        </td>
     
     
      </tr>
    </tbody>

  </b-table-simple>
</div>
         <!-- carryover table ends -->

              </div> 
              <!-- /.card-body -->
              <div class="card-footer ">
                  <!-- <pagination ></pagination> -->
                  <span>pagination here</span>
                  
                </div>
            </div>
            </div>
            </div>

                <!-- </div> -->
                    
                    </b-col>
                    </b-row>
                </b-card>
            </div>
             <!-- Modal start -->
            <form @submit.prevent="updateSession()">
        <div class="modal fade" id="updateSession" tabindex="-1" role="dialog" 
        aria-labelledby="addnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="addnewLabel">Update Session</h5>
        <button type="button"  @click="sessionCancle"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       <div class="form-group">
		<input type="text" v-model="form1.session" class="form-control" id="session" 
        name="session" :class="{ 'is-invalid': form1.errors.has('session') }" placeholder="Session Description">
      <has-error :form="form1" field="session"></has-error>
	  </div>

        <div class="form-group">
                        <div>
                     <b-input-group class="mb-3">
                    <b-form-input  name="session_started_at" :class="{ 'is-invalid': form1.errors.has('session_started_at') }"
                        id="session_started_at_modal"
                        v-model="form1.session_started_at"
                        type="text"
                        placeholder="Start Date"
                        autocomplete="off"
                    ></b-form-input>
                   
                    <b-input-group-append>
                        <b-form-datepicker
                        dropright
                        :min="minDate"
                        v-model="form1.session_started_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="session_started_at_modal"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                     <has-error :form="form1" field="session_started_at"></has-error>
                    </b-input-group>

                    <b-input-group class="mb-3">
                    <b-form-input  name="session_ended_at" :class="{ 'is-invalid': form1.errors.has('session_ended_at') }"
                        id="session_ended_at_modal"
                        v-model="form1.session_ended_at"
                        type="text"
                        placeholder="End Date"
                        autocomplete="off"
                    ></b-form-input>
                    
                    <b-input-group-append>
                        <b-form-datepicker
                        dropright
                        v-model="form1.session_ended_at"
                        button-only
                        right
                        locale="en-US"
                        aria-controls="session_ended_at"
                       :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        ></b-form-datepicker>
                    </b-input-group-append>
                    <has-error :form="form1" field="session_ended_at"></has-error>
                    </b-input-group>
                    
                </div>
	  </div>
      </div>
      <div class="modal-footer">
           <b-button-group size="sm" class="mr-1">
                <b-button @click="sessionCancle" variant="danger" data-dismiss="modal">Close</b-button>
                <b-button type="submit" variant="success" >Update</b-button>
            </b-button-group>
        
      </div>
    </div>
  </div>
</div>
</form>
<!-- modal ends here -->
        </b-tab> <!-- second tab end here -->

       
       <!-- third tab start here -->
        <b-tab title="Info">I'm the last tab

        </b-tab>  <!-- third tab end here -->
      </b-tabs>
    </b-card>

    







            <div class="col-md-12 mt-4">

            

        </div>
        
           
          
        </div>    
</template>

<script>

    export default {

        data(){

            return{
                semesters: [],
                tabIndex : 1,
                all_setting: [],
                sessions:[],
                settings:[],
                reg_status: [
                    {name:'Registration ON' ,value: 2 ,id:2 },  // 2 -> for opened registration
                    {name:'Registration Late ' ,value: 1 ,id:1 }, // 1 -> for late registration
                    {name:'Registration Closed' ,value: 0 ,id:0 }, // 0 -> for closed registration 
                ],
                set_status: [
                    {name:'Active' ,value: 1 ,id:1 }, 
                    {name:'Non Active ' ,value: 0 ,id:2 }, 
                ],
                form1 : new Form({
                    id: '',   // Note: value stands for id
                    session: '',    // Note: text stands for session desc
                    session_started_at: '',
                    session_ended_at: '',

                }),

                form2 : new Form({
                    setting_id: '',
                    setting_session: '',
                    setting_semester:'',
                    setting_reg_status:'',
                    setting_status:'',
                    setting_started_at: '',
                    setting_ended_at: '',

                })
            }
     
          
        },

        methods: {
             

            sessionCancle(){
              this.form1.session = ''
              this.form1.session_started_at = ''
              this.form1.session_ended_at = ''
               
            },
            settingCancle(){
              this.form2.setting_session = ''
              this.form2.setting_semester = ''
              this.form2.setting_status = ''
              this.form2.setting_started_at = ''
              this.form2.setting_ended_at = ''
               
            },

            //  loadSetting(){
            //     axios.get('loadsetting')
            //     .then(({data})=> (this.setting = data))
                
            //     .catch()
            // },
            newSession(){
            this.$Progress.start()
            this.form1.post('postnewsession')
            .then(()=> {
                Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Session created successfully'
              })
              this.form1.session = ''
              this.form1.session_started_at = ''
              this.form1.session_ended_at = ''
            this.$Progress.finish()
            })
            .catch(()=> {
              
            });
            },

            newSetting(){
            this.$Progress.start()
            this.form2.post('postnewsetting')
            .then((data)=> {

                //console.log(data.data.message)
                if(data.data.message != null){
                     swal.fire(
                    'Updated!',
                    data.data.message,
                    'success'
                    )
                    console.log(data.data.message)
                }
                else{
                         Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Session created successfully'
              })
               this.form2.setting_session = ''
              this.form2.setting_semester = ''
              this.form2.setting_status = ''
               this.setting_reg_status = '',
              this.form2.setting_started_at = ''
              this.form2.setting_ended_at = ''
            this.$Progress.finish()
                }
           
            })
            .catch(()=> {
              
            });
            },

            loadSetting(){
            axios.get('loadsetting')
            .then(({data})=> {
                              this.sessions = data.db_session
                              this.settings = data.db_setting
                              this.semesters = data.db_semester
                              })
            
            .catch()
        },

            editSetting(setting){
                // console.log(setting)
              this.form2.reset();
              $('#updateSetting').modal('show')
               this.form2.fill(setting);
          },
            editSession(session){
              this.form1.reset();
              $('#updateSession').modal('show')
               this.form1.fill(session);
          },
          updateSetting(){
                this.$Progress.start()
                this.form2.put('updatesetting/'+ this.form2.setting_id)  // Note: value stands for id
                .then((data) => {
                    $('#updateSetting').modal('hide')
                    swal.fire(
                    'Updated!',
                    data.data.message,
                    'success'
                    )
                    this.form2.setting_session = ''
                    this.form2.setting_semester = ''
                    this.form2.setting_status = ''
                    this.setting_reg_status = '',
                    this.form2.setting_started_at = ''
                    this.form2.setting_ended_at = ''
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                     this.$Progress.fail();
                })

          },

          updateSession(){
                this.$Progress.start()
                this.form1.put('updatesession/'+ this.form1.id)  // Note: value stands for id
                .then((data) => {
                    $('#updateSession').modal('hide')
                    swal.fire(
                    'Updated!',
                    data.data.message,
                    'success'
                    )
                     this.form1.session = ''
                     this.form1.session_started_at = ''
                     this.form1.session_ended_at = ''
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                     this.$Progress.fail();
                })

          },

            // Note: you can not delete current setting
           deleteSetting(id){
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
          this.form2.delete('deletesetting/'+id)
          .then((data) => {
              if(data.data.failed != null){
                     swal.fire(
                     "Failed",
                     data.data.failed,
                     "warning"
                     )
              }
              else{
                     swal.fire(
                'Deleted!',
                data.data.message,
                'success'
                     )
              }
            Fire.$emit('AfterCreate');
            this.sessionCancle()
          })
          .catch(()=> {
            swal("Failed", "There was something wrong" , "warning");
            this.sessionCancle()
          })
          }
        })
     },
             // Note: you can not delete current session
           deleteSession(id){
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
          this.form1.delete('deletesession/'+id)
          .then((data) => {
                swal.fire(
                'Deleted!',
                data.data.message,
                'success'
            )
            Fire.$emit('AfterCreate');
            this.sessionCancle()
          })
          .catch(()=> {
            swal("Failed", "There was something wrong" , "warning");
            this.sessionCancle()
          })
          }
        })
     },

        },

         created() {
            this.loadSetting()

            Fire.$on('AfterCreate', () => {
              this.loadSetting()
            })
            //setInterval(()=> this.loadUsers(), 3000);
        },

    

        computed:{

            minDate(){
                     const now = new Date()
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
            // 15th two months prior
            const minDate = new Date(today)
            minDate.setMonth(minDate.getMonth() - 2)
            minDate.setDate(15)
            // 15th in two months
            const maxDate = new Date(today)
            maxDate.setMonth(maxDate.getMonth() + 2)
            maxDate.setDate(15)
                return minDate

            }
        }
        ,
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
