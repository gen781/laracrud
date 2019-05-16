<template>
    <Page class="page">
        <ActionBar title="CRUD Data Customer" class="action-bar" />
        <ScrollView>
            <StackLayout class="home-panel">
                <ListView class="list-group" for="country in countries" @itemTap="onItemTap" style="height:1600px">
                <v-template>
                    <FlexboxLayout flexDirection="row" class="list-group-item">
                      <Label :text="country.nama_customer" class="list-group-item-heading" style="width: 60%" />
                    </FlexboxLayout>
                </v-template>
                </ListView>
            </StackLayout>
        </ScrollView>
    </Page>
</template>

<script>
import axios from 'axios';

export default {
    methods: {
        onItemTap: function(args) {
            console.log('Item with index: ' + args.index + ' tapped');
        },
        showCustomer() {
          axios.get('http//:localhost:8000/api/customer')
          .then(response => {
            this.countries=response.data.customers;
          }).catch(err => {
            console.log(err)
          })
        }
    },
    mounted() {
      this.showCustomer;
    },

    data() {
        return {
          countries: [],
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
</style>