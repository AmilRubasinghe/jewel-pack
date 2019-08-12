<template>
  <div>
    <navDrawer></navDrawer>
    <br />
    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
      <v-card>
        <v-card-title>
          <h3>Sales Order Reports</h3>

          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>

          <v-btn fab dark color="blue" @click="download">
            <v-icon dark>save_alt</v-icon>
          </v-btn>
          <v-btn fab dark color="blue" @click="report">
            <v-icon dark>refresh</v-icon>
          </v-btn>
        </v-card-title>

        <v-card-title>
          <v-flex xs12 sm6 md6>
            <v-menu
              v-model="menu1"
              :close-on-content-click="false"
              :nudge-right="40"
              transition="scale-transition"
              offset-y
              full-width
              min-width="290px"
            >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="startDate"
                  label="Start Date"
                  prepend-icon="event"
                  readonly
                  v-on="on"
                  name="startD"
                ></v-text-field>
              </template>
              <v-date-picker :max="today" v-model="startDate" @input="menu1= false" landscape></v-date-picker>
            </v-menu>
          </v-flex>

          <v-flex xs12 sm6 md6>
            <v-menu
              v-model="menu2"
              :close-on-content-click="false"
              :nudge-right="40"
              transition="scale-transition"
              offset-y
              full-width
              min-width="290px"
            >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-validate="'after:'+startDate+'|date_format:yyyy-MM-dd'"
                  data-vv-as="End day"
                  name="endD"
                  v-model="endDate"
                  label="End Date"
                  prepend-icon="event"
                  readonly
                  v-on="on"
                  :error-messages="errors.collect('endD')"
                ></v-text-field>
              </template>
              <v-date-picker :max="today" v-model="endDate" @input="menu2 = false" landscape></v-date-picker>
            </v-menu>
          </v-flex>
        </v-card-title>

        <!--
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Reports</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="report">Refresh </button>
                     <button class="btn btn-success" @click="downloadWithCSS">Save as PDF </button>
                </div>

              </div>
              
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
        </tbody></table>-->

        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="reports"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="oid"
          class="elevation-1"
        >
          <template v-slot:headers="props">
            <tr>
              <th
                v-for="header in props.headers"
                :key="header.text"
                :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
                @click="changeSort(header.value)"
              >
                <v-icon small>arrow_upward</v-icon>
                {{ header.text }}
              </th>
            </tr>
          </template>
          <template v-slot:no-data>
            <v-alert :value="true" color="error" icon="warning">Sorry, nothing to display here :(</v-alert>
          </template>
          <template v-slot:items="props">
            <tr :active="props.selected" @click="props.selected = !props.selected">
              <td class="text-xs-right">{{ props.item.oid }}</td>
              <td class="text-xs-right">{{ props.item.customerEmail }}</td>
              <td class="text-xs-right">{{ props.item.contactNo }}</td>
              <td class="text-xs-right">{{props.item.TotQuantity }}</td>
              <td class="text-xs-right">{{ props.item.TotPrice }}</td>
              <td class="text-xs-right">{{ props.item.orderDate }}</td>
            </tr>
          </template>
        </v-data-table>
      </v-card>
    </div>
  </div>
</template>

<script>
import navDrawer from "./navDrawer.vue";
import axios from "axios";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
import autoTable from "jspdf-autotable";
export default {
  data() {
    return {
      date_limit: "2019-06-05",
      search: "",

      startDate: "",
      endDate: "",
      menu1: false,
      menu2: false,

      allReports: [],
      reports: [],
      pagination: {
        sortBy: "oid"
      },
      selected: [],
      headers: [
        { text: "Order ID", value: "oid" },
        { text: "Customer Email", value: "customerEmail" },
        { text: "contact No", value: "contactNo" },
        { text: "Tot Quantity", value: "TotQuantity" },
        { text: "Tot Price", value: "TotPrice" },
        { text: "Order Date", value: "orderDate" }
      ]
    };
  },

  components: {
    navDrawer
  },

  mounted() {
    this.report();
  },

  watch: {
    // whenever keywords changes, this function will run
    startDate: function() {
      if (this.endDate) {
        this.filterD();
      }
    },
    endDate: function() {
      if (this.startDate) {
        this.filterD();
      }
    }
  },

  methods: {
    filterD() {
      this.reports = this.dateFilter;
    },

    report() {
      let $Token = localStorage.getItem("token");
      axios
        .get(this.$baseUrl + "/salesReport?token=" + $Token, {})
        .then(response => {
          this.reports = response.data.salesReport;
          this.allReports = this.reports;
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    changeSort(column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending;
      } else {
        this.pagination.sortBy = column;
        this.pagination.descending = false;
      }
    },

    downloadWithCSS() {
      const doc = new jsPDF();
      /** WITH CSS */
      var canvasElement = document.createElement("canvas");
      html2canvas(this.$refs.content, { canvas: canvasElement }).then(function(
        canvas
      ) {
        const img = canvas.toDataURL("image/png");
        doc.addImage(img, "JPEG", 20, 20);
        doc.save("sample.pdf");
      });
    },

    down() {
      let pdfName = "test";
      var doc = new jsPDF();
      doc.text("this.name", 10, 10);
      doc.save(pdfName + ".pdf");
    },

    download() {
      var vm = this;
      var columns = [
        { title: "Order_ID", datakey: "oid" },
        { title: "Customer_Email", datakey: "customerEmail" },
        { title: "contact_No", datakey: "contactNo" },
        { title: "Total_Quantity", datakey: "totQuantity" },
        { title: "Tot_Price", datakey: "totPrice" },
        { title: "orderDate", datakey: "orderDate" }
      ];

      var rows = [];

      for (var item in this.reports) {
        // console.log("Item.oid");
        // console.log(this.reports[item]);
        var temp = [
          this.reports[item].oid,
          this.reports[item].customerEmail,
          this.reports[item].contactNo,
          this.reports[item].TotQuantity,
          this.reports[item].TotPrice,
          this.reports[item].orderDate
        ];
        rows.push(temp);
      }

      var doc = new jsPDF("p", "pt");
      doc.setFontSize(18);
      doc.setTextColor(40);
      doc.setFontStyle("normal");
      doc.text("Sales Report", 50, 25);
      doc.autoTable(columns, rows);
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
    }
  },
  computed: {

 

    today: function() {
      return new Date().toJSON();
    },

    pages() {
      if (
        this.pagination.rowsPerPage == null ||
        this.pagination.totalItems == null
      )
        return 0;

      return Math.ceil(
        this.pagination.totalItems / this.pagination.rowsPerPage
      );
    },
    dateFilter() {
      var startDate = this.startDate;
      var endDate = this.endDate;
      return _.filter(this.allReports, function(data) {
        if (_.isNull(startDate) && _.isNull(endDate)) {
          return true;
        } else {
          var date = data.orderDate;
          return date >= startDate && date <= endDate;
        }
      });
    }
  }
};
</script>