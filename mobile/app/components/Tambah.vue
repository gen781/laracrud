<template>
  <Page class="page">
    <ActionBar title="Tambah Customer" class="action-bar" >
      <NavigationButton  icon="res://baseline_arrow_back_ios_white_36" @tap="$goto('home', navOptions)" />
      <ActionItem @tap="tambahCustomer"
        ios.systemIcon="9" ios.position="left"
        text="SUBMIT"
        android.position="actionBar"
      >
      </ActionItem>
    </ActionBar>
    <StackLayout orientation="vertical" width="100%" height="100%">
      <ScrollView>
        <RadDataForm  ref="dataForm" :source="customer" :metadata="md" :groups="groups">
        </RadDataForm>
      </ScrollView>
    </StackLayout>
  </Page>
</template>

<script>
import 'nativescript-ui-dataform';
import * as http from "http";
import axios from "axios";
require("nativescript-vue").registerElement(
    "RadDataForm",
    () => require("nativescript-ui-dataform").RadDataForm
);
var dialogs = require("tns-core-modules/ui/dialogs");
export default {
  props: {
  },
  data() {
    return {
      customer: {
        nama_customer: '',
        alamat: '',
        tgl_masuk: '',
        limit: null,
        no_ktp: '',
        operator: null,
        no_rek: ''
      },
      md: {
        "isReadOnly": false,
        "commitMode": "Immediate",
        "validationMode": "Immediate",
        "propertyAnnotations":
        [
            {
                "name": "nama_customer",
                "displayName": "Nama",
                "index": 0,
                "Editor": "Text",
                "validators": [
                  { "name": "NonEmpty" }
                ]
            },
            {
                "name": "alamat",
                "displayName": "Alamat",
                "index": 1,
                "Editor": "Text"
            },
            {
                "name": "tgl_masuk",
                "displayName": "Tgl. Masuk",
                "index": 2,
                "Editor": "DatePicker"
            },
            {
                "name": "limit",
                "displayName": "Limit",
                "index": 3,
                "Editor": "Number"
            },
            {
                "name": "no_ktp",
                "displayName": "No. KTP",
                "index": 4,
                "Editor": "Text"
            },
            {
                "name": "operator",
                "displayName": "Operator",
                "index": 5,
                "Editor": "Number"
            },
                {
                "name": "no_rek",
                "displayName": "No. Rekening",
                "index": 6,
                "Editor": "Text"
            },
        ]
      }
    };
  },
  computed: {
    navOptions() {
      return {
        clearHistory: true,
        backstackVisible: true,
        transition: {
          name: "fade",
          duration: 380,
          curve: "easeIn"
        }
      }
    },
  },
  mounted(){
  },
  methods: {
    tambahCustomer() {
      // dialogs.alert(this.customer.tgl_masuk+" & "+this.customer.nama_customer+" & "+this.customer.alamat+" & "+this.customer.no_ktp+" & "+this.customer.operator+" & "+this.customer.no_rek+" & "+this.customer.limit).then(function() {
      //   console.log("Dialog closed!");
      // });
      axios.post('https://laracrudbasic.000webhostapp.com/api/customer', this.customer,
        {
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        }
      )
      .then(response => {
        dialogs.alert(response.data.nama_customer).then(function() {
          console.log("Dialog closed!");
        });
        // this.$goto('home', this.navOptions);
      }).catch(error => {
        dialogs.alert(error).then(function() {
          console.log("Dialog closed!");
        });
      });

      // http.request({
      //   url: "https://laracrudbasic.000webhostapp.com/api/customer",
      //   method: "POST",
      //   headers: { "Content-Type": "application/json" },
      //   content: JSON.stringify(this.customer)
      // }).then((response) => {
      //   this.$goto('home', this.navOptions);
      // }, (error) => {
      //   console.log(error);
      //   dialogs.alert(error).then(function() {
      //     console.log("Dialog closed!");
      //   });
      // });
    }
  },
}
</script>

<style scoped>
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
  margin-top: 5;
  margin-bottom: 5;
  margin-right: 20;
  margin-left: 20;
}

ActionBar {
  background-color:  #53ba82;
  color: white;
}

ActionItem {
  background-color: white;
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