<template>
  <Page class="page">
    <ActionBar title="Tambah Customer" class="action-bar" >
      <NavigationButton  icon="res://baseline_arrow_back_ios_white_24" @tap="$goto('home', navOptions)" />
      <ActionItem @tap="tambahCustomer"
        ios.systemIcon="9" ios.position="left"
        icon="res://baseline_send_white_24"
        android.position="actionBar"
      >
      </ActionItem>
    </ActionBar>
    <StackLayout orientation="vertical" width="100%" height="100%">
      <AbsoluteLayout v-if="tampilCircle==true" class="cv">
        <Label class="cv-lbl" />
        <Label class="inner-circle" />
      </AbsoluteLayout>
      <ScrollView>
        <RadDataForm 
          v-if="tampilData==true" 
          ref="dataForm" 
          :source="customer" 
          :metadata="md" 
          :groups="groups"
          @propertyCommitted="onPropertyCommitted"
        >
        </RadDataForm>
      </ScrollView>
    </StackLayout>
  </Page>
</template>

<script>
import 'nativescript-ui-dataform';
import * as http from "http";
require("nativescript-vue").registerElement(
    "RadDataForm",
    () => require("nativescript-ui-dataform").RadDataForm
);
var dialogs = require("tns-core-modules/ui/dialogs");
export default {
  props: {
    tampilCircle: '',
    tampilData: ''
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
      customerCommitted: {},
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
    onPropertyCommitted (data) {
      this.customerCommitted = data.object.editedObject;
      console.log(this.customerCommitted);
    },
    tambahCustomer() {
      if(Object.keys(this.customerCommitted).length === 0) {
        dialogs.alert({
          title: "Perhatian",
          message: "Sebagian data masih kosong, silahkan lengkapi data!",
          okButtonText: "OK"
        })
      } else {
        let cstParse = JSON.parse(this.customerCommitted);
        console.log(cstParse)
        if(cstParse.nama_customer==''||cstParse.alamat==''||cstParse.tgl_masuk==''
        ||cstParse.limit==''||cstParse.no_ktp==''||cstParse.operator==''||cstParse.no_rek=='') {
          dialogs.alert({
            title: "Perhatian",
            message: "Sebagian data masih kosong, silahkan lengkapi data!",
            okButtonText: "OK"
          })
        } else {
          this.tampilCircle = true;
          this.tampilData = false;
          http.request({
            url: "https://laracrudbasic.000webhostapp.com/api/customer",
            method: "POST",
            headers: { 
              "Access-Control-Allow-Origin": "*",
              "Content-Type": "application/json" 
            },
            content: this.customerCommitted
          }).then((response) => {
            this.tampilCircle = false;
            dialogs.confirm({
              title: "Info",
              message: "Data "+cstParse.nama_customer+" berhasil ditambahkan!",
              okButtonText: "OK"
            }).then((result) => {
              console.log(response.content.toJSON());
              this.$goto('home', this.navOptions);
            });
          }, (error) => {
            dialogs.confirm({
              title: "Error",
              message: error,
              okButtonText: "OK"
            }).then((result) => {
              console.log(error);
            });
          });
        }
      }
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