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
                     <button class="btn btn-success" @click="download">Save as PDF </button>
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
import jsPDF from 'jspdf';
import html2canvas from "html2canvas"
import autoTable from 'jspdf-autotable'
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
      html2canvas(this.$refs.content, { canvas: canvasElement }).then(function (canvas) {
        const img = canvas.toDataURL("image/png");
        doc.addImage(img,'JPEG',20,20);
        doc.save("sample.pdf");
      });
    },

    download() {
      var vm =this
      var columns = [
      
        {title: "Order_ID", datakey: "oid"},
        {title: "Customer_Email", datakey: "customerEmail"},
        {title: "contact_No", datakey: "contactNo" },
        {title: "Total_Quantity"	, datakey: "totQuantity"	 },
        {title: "Tot_Price", datakey: "totPrice" },
        {title: "orderDate", datakey: "orderDate" },
      ];

        var rows = [];

        for(var item in this.reports){
            // console.log("Item.oid");
           // console.log(this.reports[item]);
            var temp = [
              this.reports[item].oid,
              this.reports[item].customerEmail,
              this.reports[item].contactNo,
              this.reports[item].TotQuantity,
              this.reports[item].TotPrice,
              this.reports[item].orderDate,
            ];
            rows.push(temp);
            
        }



      var doc = new jsPDF('p','pt');
      doc.setFontSize(18);
      doc.setTextColor(40);
      doc.setFontStyle('normal');
      doc.text("Sales Report",50,25)
      doc.autoTable(columns,rows);
      doc.save("Sales_Report.pdf");
/*
        const doc = new jsPDF();
      
      var canvasElement = document.createElement('canvas');
      html2canvas(this.$refs.content, { canvas: canvasElement }).then(function (canvas) {
        const img = canvas.toDataURL("image/png");
        doc.addImage(img,'JPEG',20,20);
        doc.save("sample.pdf");
      });
    */
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