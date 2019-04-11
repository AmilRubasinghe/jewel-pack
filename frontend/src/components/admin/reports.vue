<template>
<div>
<navDrawer></navDrawer>

<div class="container">
        
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="report">Add New <i></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>OrderID</th>
                        <th>customerEmail</th>
                        <th>contactNo</th>
                        <th>TotQuantity</th>
                        <th>TotPrice</th>
                        <th>orderDate</th>
                  </tr>


                  <tr v-for="report in reports" :key="report.oid">

                    <td>{{report.oid}}</td>
                    <td>{{report.customerEmail}}</td>
                    <td>{{report.contactNo}}</td>
                    <td>{{report.TotQuantity}}</td>
                    <td>{{report.TotPrice}}</td>
                    <td>{{report.orderDate}}</td>

                   
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->
          </div>
        
</div>
</div>
</template>

<script>
import navDrawer from './navDrawer.vue';
import axios from 'axios'
  export default {      
      data () {
          return {
            search: '',
            pagination: {},
            reports: {},
            rowsPerPageItems: [10, 20, 30, 40],
            pagination: {
              rowsPerPage: 10
            },      
            selected: [],
            headers: [
              { text: 'OrderID', value: 'orderID' },
              { text: 'customerEmail', value: 'customerEmail' },
              { text: 'contactNo', value: 'contactNo' },
              { text: 'TotQuantity', value: 'TotQuantity' },
              { text: 'TotPrice', value: 'TotPrice' },
              { text: 'orderDate', value: 'orderDate' }
            ],
            
          }
  },

  
  components:{
     navDrawer
  },


   mounted(){
            this.report();
            console.log("this.reports");
            console.log(this.reports);
            
   },

  methods:{

          report(){
              let $Token=localStorage.getItem('token');
              axios.post('http://localhost:8000/api/salesReport?token='+$Token
                  , {

              })
                  .then(response => {
                      this.reports=response.data.salesReport;
                      console.log("this.reports");
                      console.log(this.reports);
                      
                      
                  })
                  .catch(error => {
                      console.log(error.response);
                      console.log("ERROR");
                  })
          }
        },
  computed: {
        pages () {
          if (this.pagination.rowsPerPage == null ||
            this.pagination.totalItems == null
          ) return 0

          return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
        }
   }
  }
</script>