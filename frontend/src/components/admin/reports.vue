<template>
<div>
<navDrawer></navDrawer>

<div class="container">
        
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Reports</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="report">Refresh </button>
                     <button class="btn btn-success" @click="exportPDF">Save as PDF </button>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th v-for="header in headers" :key="header.text">{{header.text}}</th>
                      
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
            reports: {},
            headers: [
        { text: 'Order ID', value: 'oid' },
        { text: 'Customer Email', value: 'customerEmail' },
        { text: 'contact No', value: 'contactNo' },
        { text: 'Tot Quantity', value: 'TotQuantity' },
        { text: 'Tot Price', value: 'TotPrice' },
        { text: 'Order Date', value: 'orderDate' },
      ],
          }
  },

  
  components:{
     navDrawer
  },


   mounted(){
            this.report();
            
   },

  methods:{

          report(){
              let $Token=localStorage.getItem('token');
              axios.post('http://localhost:8000/api/salesReport?token='+$Token
                  , {

              })
                  .then(response => {
                      this.reports=response.data.salesReport;
                      
                      
                  })
                  .catch(error => {
                      console.log(error.response);
                      console.log("ERROR");
                  })
          },

          exportPDF(){
 
                const doc = new jsPDF();
                /** WITH CSS */
                var canvasElement = document.createElement('canvas');
                  html2canvas(this.$refs.content, { canvas: canvasElement 
                    }).then(function (canvas) {
                  const img = canvas.toDataURL("image/png");
                  doc.addImage(img,'JPEG',20,20);
                  doc.save("sample.pdf");
   });
 },
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