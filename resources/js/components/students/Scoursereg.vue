<style >
  div.inline { float:left; }
.clearBoth { clear:both; }
.outstanding { color: crimson; }
.main_reg { color: goldenrod; }
hr.carry {
  border-top: 1px dotted red;
}
</style>
<template>
  <div>

    <!-- toast -->
      <div>
    <b-toast id="my-toast"  v-if="totalunits > 0 " v-model="btoast" :variant="toastColor" solid>
      <template v-slot:toast-title>
        <div class="d-flex flex-grow-1 align-items-baseline">
          <b-img blank blank-color="#ff5555" class="mr-2" width="12" height="12"></b-img>
          <strong class="mr-auto">{{toastTitle}}</strong>
        </div>
      </template>
            <span v-if="totalunits > 0 && totalcarryoverunits !=0">  You have just selected total units of {{ totalunits }} and {{totalcarryoverunits }}unit carryover</span>

            <span v-else>No  selected total units of</span>
           
    </b-toast>
  </div>
    <!-- toast end -->
    <!-- Tabs with card integration -->
    <b-card no-body>
      <b-tabs v-model="tabIndex" small card>
        <b-tab title="Registration History">I'm the first fading tab</b-tab>

        <b-tab title="New Registration">
            <div>
  <b-card no-body class="overflow-hidden" >
    <b-row no-gutters>
      <b-col md="12">
        <b-card-body >
          <!-- carryover table -->
    <div>
        <div v-if="carryover_courses.length > 0">
          <b-table-simple caption-top hover striped small responsive="sm">
     <caption class="outstanding"> Outstanding Course(s):</caption>
    <thead >
      <tr>
        <th  class="align-middle">Course Code</th>
        <th  class="align-middle">Course Title</th>
        <th  class="align-middle">Course Unit</th>
        <th class="align-middle">Course Type</th>
      </tr>
     
    </thead>
    <tbody>
     
      <tr class="table-danger" v-for="carryO in carryover_courses" :key="carryO.course_code">
        <td>{{carryO.course_code}}</td>
        <td>{{carryO.course}}</td>
        <td>{{carryO.unit}}</td>
        <td>
              <b-badge pill :variant="getColor(carryO.status)" v-if="carryO.status==='C'"  >Compulsory Course</b-badge>
              <b-badge pill :variant="getColor(carryO.status)" v-else  >Elective Course</b-badge>
        </td>
     
     
      </tr>
    </tbody>
  </b-table-simple>
        </div>
        <div v-else>
            <h3 style="text-alignment:center;color:green;"> You have NO outstanding course(s) for this semester!</h3>
        </div>
  </div>
         <!-- carryover table ends -->

          <hr class="carry">

          <!--  course table start -->

             <div>
    <b-form-group class="main_reg" label="Courses available for registration:" label-cols-md="4">
       <b-overlay  class="float-right"
      :show="busy"
      rounded
      opacity="0.6"
      spinner-small
      spinner-variant="primary" 
      
    >
          <div class="text-center inline">
            <b-button disabled variant="danger" pill>
              Total Units Registered <b-badge variant="light">{{ totalunits }} </b-badge>
            </b-button>
        
        
          
      <b-button size="md" @click="selectAllRows" pill  variant="primary">Select all</b-button>
      <b-button size="md" @click="clearSelected" pill  variant="primary">Clear selected</b-button>
   
      <b-button :disabled="regbtn" @click="updateregistration" v-if="submitUpdate > 0"  pill  variant="success">Update Registration</b-button>
      <b-button :disabled="regbtn" @click="registercourse" v-else  pill  variant="success">Submit Registration</b-button>
    </div>
    </b-overlay>
    </b-form-group>

    <b-table
      ref="selectableTable"
      selectable
      :select-mode="selectMode"
      :items="norm_courses"
      :fields="fields"
      @row-selected="onRowSelected"
      responsive="sm"
    >

        <template v-slot:head()="data">
        <span class="text-info">{{ data.label.toUpperCase() }}</span>
      </template>
       
     <template v-slot:cell(course_type)="{ item }">
               <b-badge pill :variant="getColor(item.status)" v-if="item.status==='C'"  >Compulsory Course</b-badge>
              <b-badge pill :variant="getColor(item.status)" v-else  >Elective Course</b-badge>
              
              
      </template>

      <!-- Example scoped slot for select state illustrative purposes -->
      <template v-slot:cell(selected)="{ rowSelected }">
        <template v-if="rowSelected">
          <span aria-hidden="true">&check;</span>
          <span class="sr-only">Selected</span>
        </template>
        <template v-else>
          <span aria-hidden="true">
              <b-form-checkbox disabled />
              <!-- <b-form-checkbox value="sam" id="'selected'+rowSelected.index" v-model="rowSelected.item.selected" /> -->
          </span>
          <span class="sr-only">Not selected</span>
        </template>
      </template>

      <!-- footer  -->
      <template v-slot:foot()="data">
        <i>{{ data }}</i>
      </template>
      <!-- footer ends -->
    </b-table>

    <b-row>
        <b-col>
     
          <div>
                
                <b-badge class="big" pill variant="primary" >Compulsory Courses</b-badge>
                <b-badge pill variant="dark">Elective Courses</b-badge>
                <b-badge pill variant="danger">Carryover Courses</b-badge>     
        </div>
           
        </b-col>

        <b-col>
              <!-- Minimum and maximum course unit -->
      <div>
    <b-toast id="my-toast"  variant="danger" solid>
      <template v-slot:toast-title>
        <div class="d-flex flex-grow-1 align-items-baseline">
          <b-img blank blank-color="#ff5555" class="mr-2" width="12" height="12"></b-img>
          <strong class="mr-auto"> Course Unit Requirment</strong>
        </div>
      </template>
            The requirements are: Min units is {{min}} and maximum is {{max}}
    </b-toast>
  </div>
    <!-- Minimum and maximum course unit end -->
        </b-col>
    </b-row>
  
     
  </div>

          <!-- course table end -->

        </b-card-body>
      </b-col>
    </b-row>
  </b-card>
</div>
        </b-tab>

        <b-tab title="Registration approval" >Sibzamini!</b-tab>
        <b-tab title="Info">I'm the last tab</b-tab>
      </b-tabs>
    </b-card>
        <!-- card ends here -->
    
  </div>
</template>

<script>
  export default {
    data() {
      return {
        submit_update: '',
        regstatus:false,
        combined:[],
         busy: false,
         min: "10",
         max: "15",
        btoast:false,
        all_available_courses_for_reg: [],
        norm_courses:[],
        carryover_courses:[],
        tabIndex : 1,
        fields: [
          'selected',
         'course_code',
         {key: 'course', label: 'course_title'}, 
         {key:'unit', label:'course_unit'}, 
         {key:'course_type', sortable:true}],
       
        selectMode: 'multi',
        selected: [ ],
       
        
      }
    },

    methods: {

       getColor(type) {
      if (type === 'C') return "primary";
       else if (type === 'E') return "dark";
      else return "danger";
    },
     
     
    registercourse(){
        //this.$Progress.start()
        this.busy = true
         let registeredcourses = {reg_courses :[... this.selected, ...this.all_available_courses_for_reg.db_carryover_courses]};
         axios.post('/registercourse', registeredcourses )
         .then(()=> {
                Fire.$emit('AfterSubmit');
                toast.fire({
                icon: 'success',
                title: 'Registration submited successfully'
              })
              this.busy = false

            //this.$Progress.finish()
            })
            .catch(()=> {
              
            });
      
    },
    updateregistration(){
        this.busy = true
         let registeredcourses = {reg_courses :[... this.selected, ...this.all_available_courses_for_reg.db_carryover_courses]};
         axios.post('/updateregistration', registeredcourses )
         .then(()=> {
                Fire.$emit('AfterSubmit');
                toast.fire({
                icon: 'success',
                title: 'Registration updated successfully'
              })
              this.busy = false

            //this.$Progress.finish()
            })
            .catch(()=> {
              
            });
    }
    
          ,
        loadCourseReg(){
            axios.get('loadcoursereg')
            .then(({data})=> {this.all_available_courses_for_reg = data
                              this.norm_courses = this.all_available_courses_for_reg.db_norm_courses
                              this.carryover_courses = this.all_available_courses_for_reg.db_carryover_courses
                              this.submit_update = this.all_available_courses_for_reg.db_submit_update
                              })
            
            .catch()
        },

      onRowSelected(norm_courses) {
        
        this.selected = norm_courses
      },
      selectAllRows() {
        this.$refs.selectableTable.selectAllRows()
      },
      clearSelected() {
        this.$refs.selectableTable.clearSelected()
      },
      selectThirdRow() {
        // Rows are indexed from 0, so the third row is index 2
        this.$refs.selectableTable.selectRow(2)
      },
      unselectThirdRow() {
        // Rows are indexed from 0, so the third row is index 2
        this.$refs.selectableTable.unselectRow(2)
      }
    },
      created(){
          
            this.loadCourseReg()
             Fire.$on('AfterSubmit', () => {
              this.loadCourseReg()
            })
           

      
        },

        computed: {
    
    totalunits(){
          let total = 0;
          this.carryover_courses.forEach(element => {
              total = total + element.unit
          });
          this.selected.forEach(element => {
              total = total + element.unit
          });
           this.btoast = true
          return total;

      },
        totalcarryoverunits(){
          let total = 0;
          this.carryover_courses.forEach(element => {
              total = total + element.unit
          });
          return total;

      },
        toastTitle(){
        if(this.totalunits < this.min){
            return 'Total units is lower than the min'
        }
        else if(this.totalunits == this.max){
            return 'Perfect!  Total units select is okay'
        }
        else if(this.totalunits > this.max){
            return 'Total units is more than the MAX unit'
        }
        },
         toastColor(){
        if(this.totalunits< this.min || this.totalunits > this.max){
            return 'danger'
        }else{
            return 'success'
        }
     },
       regbtn(){
         if(this.totalunits < this.min){
            return true
        }
        else if(this.totalunits > this.max){
            return true
        }else{
            return false
        }
    },
     submitUpdate(){
            return this.submit_update
          }
        },

      
  }
</script>