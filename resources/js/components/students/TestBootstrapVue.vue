<template>
  <div style="width: 80vw;">
<b-card no-body>
      <b-tabs card v-model="tabIndex" >
        <b-tab title="Übersicht">
          <b-table responsive flex style="width: 100%; max-height: 70vh;"
           @click="tableClick" striped hover
            :items="items" :fields="fields"
              >

        <template v-slot:cell(full_name)="data">
            {{data.item.first_name + " " + data.item.last_name}}
        </template>
    <template v-slot:cell(action)="row">
        <b-button size="sm" @click.stop="tableClick(row.item)" class="mr-1">
          Info
        </b-button>
    </template>
    </b-table>
    <div class="pagination-div">
      <!-- <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage"/> -->
    </div>
        </b-tab>
        <b-tab title="Details">
            <b-form-checkbox :value="data.first_name" v-for="data in datas" :key="data.age" v-model="ans" /> 
            {{ans}}
        </b-tab>
      </b-tabs>
    </b-card>       
    </div> 
</template>

<script>
 
    export default {
 
  data () {
    return {
      //...,
      ans: ["Dickerson"],
      tabIndex : 1,
      tours: [{
        id: '',
        kfz: '',
        loadno: '',
        driver: '',
        contracts: [''],
        device: ''
      }],

          fields: [
        {
          key: 'isActive',
          label: 'isActive',
          sortable: true
        },
        {
          key: 'age',
          label: 'age',
          sortable: true
        },
        {
          key: 'full_name',
          sortable: true
        },
        
        {
          key: 'actions',
          label: 'actions',
          sortable: false
        }
      ],
        datas: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          {  age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          {  age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { age: 38, first_name: 'Jami', last_name: 'Carney' }],

        items: [
          { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
        ],
     
    }
  },
  methods: {
    tableClick (row, index) {
      //...
    },
    // fetchInitialData () {
    //   HTTP.get('tour')
    //    .then(response => {
    //      this.totalRows = response.data.length
    //      for (let index = 0; index < response.data.length; index++) {
    //        HTTP.get('driver/' + response.data[index]['driverID'])
    //         .then(drv => {
    //           response.data[index].driver = drv.data['firstname'] + ' ' + drv.data['lastname']
    //         })
    //      }
    //      console.log(response.data)
    //      this.tours = response.data
    //    })
    // }
  },
//   mounted () {
//     this.fetchInitialData()
//   }
}
</script>
