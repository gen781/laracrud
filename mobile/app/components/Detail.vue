<template>
  <Page class="page">
    <ActionBar :title="'Detail '+customerData.nama_customer" class="action-bar" >
      <NavigationButton  icon="res://baseline_arrow_back_ios_white_24" @tap="$goto('home', navOptions)" />
      <ActionItem @tap="hapusCustomer"
        ios.systemIcon="9" ios.position="left"
        icon="res://baseline_delete_forever_white_24"
        android.position="actionBar"
      >
      </ActionItem>
    </ActionBar>
    <StackLayout orientation="vertical" width="100%" height="100%">
      <AbsoluteLayout v-if="tampilCircle==true" class="cv">
        <Label class="cv-lbl" />
        <Label class="inner-circle" />
      </AbsoluteLayout>
      <GridLayout rows="auto,*">
        <ScrollView row="1">
          <RadDataForm v-if="tampilData==true" ref="dataForm" :source="customerMap" :metadata="md" :groups="groups">
          </RadDataForm>
        </ScrollView>
        <Button row="2" text="Simpan" @tap="simpanCustomer" />
      </GridLayout>
    </StackLayout>
  </Page>
</template>

<script>
import * as https from "https";
import axios from 'axios';
var dialogs = require("tns-core-modules/ui/dialogs");
export default {
  props: {
    customerData: '',
    tampilCircle: '',
    tampilData: ''
  },
  data() {
    return {
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
                "Editor": "Text"
            },
            {
                "name": "alamat",
                "displayName": "Alamat",
                "index": 1,
                "Editor": "MultilineText"
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
                "Editor": "Text",
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
    customerMap() {
      let newCustomer = Object.assign({}, this.customerData);
      delete newCustomer.id;
      delete newCustomer.updated_at;
      delete newCustomer.created_at;
      return newCustomer;
    }
  },
  mounted(){

  },
  methods: {
    hapusCustomer() {
      this.tampilCircle = true;
      this.tampilData = false;
      axios.delete('https://145.14.144.71/api/customer/'+this.customerData.id).then(response => {
        this.tampilCircle = false;
        dialogs.confirm({
          title: "Info",
          message: "Data "+this.customerData.nama_customer+" berhasil dihapus!",
          okButtonText: "OK"
        }).then((result) => {
          console.log(response);
          this.$goto('home', this.navOptions);
        });
      }).catch(err => {
        dialogs.confirm({
          title: "Error",
          message: error,
          okButtonText: "OK"
        }).then((result) => {
          console.log(error);
        });
      })

      // https.request({
      //   url: 'https://145.14.144.71/api/customer/'+this.customerData.id,
      //   method: "DELETE",
      //   headers: { 
      //     "Access-Control-Allow-Origin": "*",
      //     "Content-Type": "application/json" 
      //   }
      // }).then((response) => {
      //   dialogs.confirm({
      //     title: "Info",
      //     message: "Data "+this.customerData.nama_customer+" berhasil dihapus!",
      //     okButtonText: "OK"
      //   }).then((result) => {
      //     console.log(response.content.toJSON());
      //     this.$goto('home', this.navOptions);
      //   });
      // }, (error) => {
      //   dialogs.confirm({
      //     title: "Error",
      //     message: error,
      //     okButtonText: "OK"
      //   }).then((result) => {
      //     console.log(error);
      //   });
      // });
    }
  },

}
</script>

<style scoped>
  .cv {
    background-color: #53ba82;
    height: 200;
    width: 200;

    animation-name: rotate;
    animation-duration: 2s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;

    clip-path: circle(60% at 50% 50%);
    margin: 20;
  }

  .cv-lbl {
    height: 100;
    width: 100;
    background-color: #ffffff;
  }

  .inner-circle {
    height: 100;
    width: 100;
    background-color: #ffffff;
    border-radius: 50%;
    top: 50;
    left: 50;
  }

  @keyframes rotate {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }
    
  .home-panel {
    vertical-align: center;
    font-size: 20;
    margin: 15;
  }

  .description-label {
    margin-bottom: 15;
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