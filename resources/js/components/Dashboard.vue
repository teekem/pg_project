<template>
    <div>
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Dashboard</h1>
          </div>
          
          <!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content" >
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="color:rgb(255,255,255);background:rgba(211, 165, 80,.99);" >
              <center >
                <div class="inner" style="margin-top:10px">
                <h3>150</h3>
  

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer" style="color:rgb(255,255,255);">More info <i class="fas fa-arrow-circle-right"></i></a>
            
              </center>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="color:rgb(255,255,255);background:rgb(26, 26, 73);" >
              <center >
                <div class="inner" style="margin-top:10px">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer" style="color:rgb(255,255,255);">More info <i class="fas fa-arrow-circle-right"></i></a>
            
              </center>
            </div>
          </div>
          <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background:rgb(255,255,255);color:rgb(26, 26, 73);" >
              <center >
                <div class="inner" style="margin-top:10px">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer" style="color:rgb(26, 26, 73);">More info <i class="fas fa-arrow-circle-right"></i></a>
            
              </center>
            </div>
          </div>
          <!-- ./col -->
             <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="color:rgb(255,255,255);background:rgba(211, 165, 80,.99);" >
              <center >
                <div class="inner" style="margin-top:10px">
                <h3>150</h3>
  

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer" style="color:rgb(255,255,255);">More info <i class="fas fa-arrow-circle-right"></i></a>
            
              </center>
            </div>
          </div>
          <!-- ./col -->
        
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
   
    </div>
</template>

<script>
import {mapGetters,mapActions} from 'vuex'
    export default {
       data(){
          return{
            users: []
          }
        },
      methods:{
        ...mapActions(['requestUsers'])
      },
      computed: mapGetters(['getUsers']),
        mounted() {
            console.log('Component mounted.')
        },
        created() {
          this.requestUsers()
        }
    }
</script>
