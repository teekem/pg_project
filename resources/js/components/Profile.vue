<style >
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height :250px;
    }
</style>
<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12 mt-3">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header text-white"
     style="background-image:url('images/logo_1.jpg');
     background-size:cover; background-position:center;">
                <h5 class="widget-user-desc text-right ">Running with a vision ....</h5>
              </div>

              
              <div class="widget-user-image">

                <img class="img-circle" :src="showProfilePhoto()"  alt="User">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">User Type:
                        <span class="description-text">{{form.type}}</span>
                      </h5>
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Name:
                        <span class="description-text">{{form.name}}</span>
                      </h5>
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">Email:
                        <span class="description-text">{{form.email}}</span>
                      </h5>
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
        </div>

       <div class="row">
          <div class="col-md-3">
              <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="showProfilePhoto()" alt="User">
                </div>
        
                <h3 class="profile-username text-center">{{form.name}}</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email:</b> <a class="float-right">{{form.email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>User:</b> <a class="float-right">{{form.type}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Bio</b> <a class="float-right">{{form.bio}}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Refresh</b></a>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

          <div class="col-md-9">
        
                  
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
 
	<div class="card-body">

	</div>
	<!-- /.card-body end -->

	<div class="card-footer">
         <b-button type="submit"  pill variant="primary">Switch</b-button>
	  
	</div>
  
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
            
        </b-tab> <!-- first tab end here -->
    
       
       <!-- Second tab start here -->
        <b-tab title="Info">
            <div class="col-sm-12">
                    <form class="form-horizontal ">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input v-model="form.name"  type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input v-model="form.email" type="text" name="email"
                             class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                     <div class="form-group">
                        <input v-model="form.password" type="password" name="password" id="password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" 
                            placeholder="Password">
                        <has-error :form="form" field="password"></has-error>
                    </div>

               <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Profile Photo</label>
                        <div class="col-sm-10">
                          <input type="file" @change="updateProfile" class="form-control" id="photo" >
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="offset-sm-2 col-sm-12">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                        </form>
                    <!-- /.form -->
                  </div>
  
        </b-tab>  <!-- Second tab end here -->
      </b-tabs>
    </b-card>
            
          </div>
       </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {

                //user_type: window.user.type,
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
        created(){

              axios.get('/adminprofile')
              .then(({data})=> { this.form.fill(data)}) 
              .catch(()=> {}) 
        },

    methods: {
           showProfilePhoto(){
               
     //let  photo = (this.form.photo.length > 200)? this.form.photo: "images/profile/" + this.form.photo;
     let  photo = (this.form.photo !== '')? this.form.photo: "images/profile/" + this.form.photo;
            return photo;
           },
           
        updateInfo(){
        this.$Progress.start();
        this.form.put('api/profile')
        .then(()=>{this.$Progress.finish(); } )
        .catch(()=>{
            this.$Progress.fail(); })
            },   
           
            updateProfile(e){
                //console.log('uploading')
                let file = e.target.files[0];
               // console.log(file)
                let reader = new FileReader();
                if(file['size'] < 2111775) {
                     reader.onloadend = (file) => {
                //console.log('RESULT', reader.result)
                   this.form.photo = reader.result
                }
                reader.readAsDataURL(file);
                }else{
                    swal.fire({
                        type:'error',
                        title:'Oops ...',
                        text:'You are uploading too large file'
                    })
                }
               
            }
    },
        
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
