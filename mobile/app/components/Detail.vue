<template>
  <Page class="page">
    <ActionBar :title="'Detail '+customerData.nama_customer" class="action-bar" >
      <NavigationButton  android.systemIcon="ic_menu_back" @tap="$goto('home', navOptions)" />
      <ActionItem tap="onShare"
        ios.systemIcon="9" ios.position="left"
        text="HAPUS"
        android.position="actionBar"
      >
      </ActionItem>
    </ActionBar>
    <StackLayout orientation="vertical" width="100%" height="100%">
      <ScrollView>
        <RadDataForm  ref="dataForm" :source="customerMap" :metadata="md" :groups="groups">
        </RadDataForm>
      </ScrollView>
    </StackLayout>
  </Page>
</template>

<script>
import * as http from "http";
var dialogs = require("tns-core-modules/ui/dialogs");
export default {
  props: {
    customerData: ''
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