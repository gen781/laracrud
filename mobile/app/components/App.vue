<template>
    <Page class="page">
        <ActionBar class="action-bar" title="CRUD Data Customer">          
        </ActionBar>

        <GridLayout>
            <ListView for="p in pokemon" class="list-group">
                <v-template>
                    <StackLayout class="list-group-item">
                        <Label :text="p.nama_customer" />
                    </StackLayout>
                </v-template>
            </ListView>
            <fab
              @tap="tambahCustomer"
              row="1"
              icon="res://ic_add_white"
              rippleColor="#f1f1f1"
              class="fab-button"
            ></fab>
        </GridLayout>
    </Page>
</template>

<script>
    import Vue from "nativescript-vue";
    Vue.registerElement(
      'Fab',
      () => require('nativescript-floatingactionbutton').Fab
    );

    import * as http from "http";
    export default {
        methods: {
            onButtonTap() {
                console.log("Button was pressed");
            },
            tambahCustomer() {
                console.log("Button was pressed");
            }
        },

        data() {
            return {
                pokemon: []
            };
        },
        mounted() {
            http.getJSON(
                "https://laracrudbasic.000webhostapp.com/api/customer"
            ).then(
                result => {
                    this.pokemon = result.customers;
                },
                error => {
                    console.log(error);
                }
            );
        }
    };
</script>

<style scoped>
  .fab-button {
    height: 70;
    margin: 15;
    background-color: #ff4081;
    horizontal-align: right;
    vertical-align: bottom;
  }
</style>