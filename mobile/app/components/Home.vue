<template>
  <Page class="page">
    <ActionBar title="Data Customer" class="action-bar" ></ActionBar>
      <GridLayout rows="auto,*">
        <ListView row="1" class="list-group" for="customer in customers" @itemTap="gotoEditPage" style="height:100%" separatorColor="transparent">
          <v-template>
            <StackLayout orientation="vertical" width="100%" height="100%">
            <Label id="active-task" :text="customer.nama_customer" class="list-group-item-heading" />
            <Label id="active-task-bottom" :text="customer.no_ktp" class="list-group-item-heading" />
            </StackLayout>
          </v-template>
        </ListView>
        <fab
          @tap="$goto('tambah', navOptions)"
          row="1"
          icon="res://baseline_add_white_48"
          rippleColor="#f1f1f1"
          class="fab-button"
        ></fab>
      </GridLayout>
  </Page>
</template>

<script>
import * as http from "http";
var dialogs = require("tns-core-modules/ui/dialogs");
require("nativescript-vue").registerElement(
  'Fab',
  () => require('nativescript-floatingactionbutton').Fab
);
export default {
  computed: {
    navOptions() {
      return {
        clearHistory: true,
        backstackVisible: true,
        transition: {
          name: "fade",
          duration: 380,
          curve: "easeIn"
        },
        props: {
          customerData: this.customerEditData,
        }
      }
    }
  },
  mounted(){
    http.getJSON(
        "https://laracrudbasic.000webhostapp.com/api/customer"
    ).then(
        result => {
            this.customers = result.customers;
        },
        error => {
            console.log(error);
        }
    );
  },
  methods: {   
    gotoEditPage: function(args) {
      this.customerEditData=args.item;
      this.$goto('detail', this.navOptions);
    }
  },
  data() {
    return {
      customers: [],
      customerEditData: ''
    };
  },
}
</script>

<style scoped>
.fab-button {
  height: 70;
  margin: 15;
  background-color: #53ba82;
  horizontal-align: right;
  vertical-align: bottom;
}

.home-panel {
  vertical-align: center;
  font-size: 20;
  margin: 15;
}

.description-label {
  margin-bottom: 15;
}

TextField {
  font-size: 20;
  color: #53ba82;
  margin-top: 10;
  margin-bottom: 10;
  margin-right: 5;
  margin-left: 20;
}

ActionBar {
  background-color:  #53ba82;
  color: white;
}

Button { 
  font-size: 15; 
  font-weight: bold; 
  color: white; 
  background-color: #53ba82; 
  height: 40;
  margin-top: 10; 
  margin-bottom: 10; 
  margin-right: 10; 
  margin-left: 10; 
  border-radius: 20px; 
}

#active-task {
  font-size: 20;
  font-weight: bold;
  color: #53ba82;
  margin-left: 20;
  padding-top: 5;
}

#active-task-bottom {
  font-size: 15;
  color: #4E504D;
  margin-left: 20;
  padding-bottom: 10;
}
</style>