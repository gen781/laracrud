<template>
  <Page class="page">
    <ActionBar title="Data Customer" class="action-bar" />


        <!-- Positions an input field, a button, and the list of tasks in a vertical stack. -->
        <StackLayout orientation="vertical" width="100%" height="100%">

          <GridLayout columns="2*,*" rows="*" width="100%" height="25%">
            <TextField col="0" row="0" v-model="textFieldValue" hint="Nama customer..." editable="true" @returnPress="onButtonTap" />
            <!-- Configures the text field and ensures that pressing Return on the keyboard produces the same result as tapping the button. -->
            <Button col="1" row="0" text="+ Tambah" @tap="onButtonTap" />
          </GridLayout>

          <ListView class="list-group" for="customer in customers" @itemTap="onItemTap" style="height:100%" separatorColor="transparent">
            <v-template>
              <Label id="active-task" :text="customer.nama_customer" class="list-group-item-heading" />
            </v-template>
          </ListView>
        </StackLayout>

  </Page>
</template>

<script>
import * as http from "http";
var dialogs = require("tns-core-modules/ui/dialogs");
export default {
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
    onItemTap: function(args) {
     action('What do you want to do with this task?', 'Cancel', ['Mark completed', 'Delete forever']) 
      .then(result => { 
        console.log(result); // Logs the selected option for debugging.
        switch (result) {
          case 'Mark completed': 
            this.dones.unshift(args.item); // Places the tapped active task at the top of the completed tasks.
            this.todos.splice(args.index, 1); // Removes the tapped active  task.
            break;
          case 'Delete forever':
            this.todos.splice(args.index, 1); // Removes the tapped active task.
            break; 
          case 'Cancel' || undefined: // Dismisses the dialog
            break; 
        }
      })
    },

   onDoneTap: function(args) { 
    action('What do you want to do with this task?', 'Cancel', ['Mark to do', 'Delete forever'])
      .then(result => { 
        console.log(result); // Logs the selected option for debugging. 
        switch (result) { 
          case 'Mark to do':
            this.todos.unshift(args.item); // Places the tapped completed task at the top of the to do tasks. 
            this.dones.splice(args.index,1); // Removes the tapped completed task. 
            break; 
          case 'Delete forever': 
            this.dones.splice(args.index, 1); // Removes the tapped completed task. 
            break; 
          case 'Cancel' || undefined: // Dismisses the dialog 
            break; 
        } 
      }) 
    },

    onButtonTap() {
      dialogs.prompt({
        title: "Form Input",
        message: "Tambah Customer",
        okButtonText: "Kirim",
        cancelButtonText: "Batal",
        inputType: dialogs.inputType.text
      }).then(function (r) {
          console.log("Dialog result: " + r.result + ", text: " + r.text);
      });
      // console.log("New task added: " + this.textFieldValue + "."); // Logs the newly added task in the console for debugging.
      // this.todos.unshift({
      //   name: this.textFieldValue
      // }); // Adds tasks in the ToDo array. Newly added tasks are immediately shown on the screen.
      // this.textFieldValue = ""; // Clears the text field so that users can start adding new tasks immediately.
    },
  },

  data() {
    return {
      dones: [],
      todos: [],
      textFieldValue: "",
      customers: []
    };
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
  margin-top: 10;
  margin-bottom: 10;
  margin-right: 5;
  margin-left: 20;
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
  padding-bottom: 10;
}
</style>