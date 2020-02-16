<template>
  <div class="main-container">
    <!-- delete dialog -->
      <md-dialog-confirm
      :md-active.sync="deleteDialog"
      md-title="I assure what you doing"
      md-content=""
      md-confirm-text="OK"
      md-cancel-text="Cancel"
      @md-confirm="onConfirm()"
      @md-cancel="onCancel" />
    <!-- edit dialog -->
      <md-dialog :md-active.sync="editDialog">
        <md-dialog-title>Update Contact Data</md-dialog-title>
        <md-dialog-content>
          <EditContact
          v-on:close-dialog="refresh"
          :contactData="contactData"/>
        </md-dialog-content>
      </md-dialog>
    <!-- add dialog -->
      <md-dialog :md-active.sync="addDialog">
        <md-dialog-title>Add New Contact Data</md-dialog-title>
        <md-dialog-content>
          <AddContact 
          v-on:close-dialog="refresh"/>
        </md-dialog-content>
      </md-dialog>

    <md-table v-model="searched" md-sort="title" md-sort-order="asc" md-card md-fixed-header>
      <md-table-toolbar>
        <button class="md-button md-mini md-fab md-primary" @click="addData">
            <md-icon>add</md-icon>
        </button>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Contact</h1>
        </div>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No posts found"
        :md-description="`No user found for this '${search}' query. Try a different search term or create a new user.`">
        <md-button class="md-primary md-raised" @click="addData">Create New Contact Data</md-button>
      </md-table-empty-state>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Email" md-sort-by="email">{{ item.email }}</md-table-cell>
        <md-table-cell md-label="Message" md-sort-by="message">{{ item.message }}</md-table-cell>
 
        <md-table-cell md-label="Actions">
            <md-button class="md-icon-button md-primary" @click="editData(item)">
                <md-icon>edit</md-icon>
            </md-button>
            <md-button class="md-icon-button md-accent" @click="deleteData(item.id)">
                <md-icon>delete</md-icon>
            </md-button>
        </md-table-cell>
      </md-table-row>
    </md-table>

  </div>
</template>

<script>
import AddContact from "./AddContact";
import EditContact from "./EditContact";
import Axios from 'axios';
const toLower = text => {
  return text.toString().toLowerCase()
}

const searchByName = (items, term) => {
  if (term) {
    return items.filter(item => toLower(item.title).includes(toLower(term)))
  }
  return items
}
import CONFIG from '../../../config';
export default {
  name: "ContactAdmin",
  data: () => ({
    addDialog:false,
    editDialog:false,
    deleteDialog:false,
    selectedId: 0,
    search: null,
    searched: [],
    contactData: {},
    config: CONFIG
  }),
    methods: {
        getData(){
            Axios.get(this.config.baseUrl + 'admin/contact').then(res=>{
                this.searched = res.data
            }).catch(err=>{
              console.log("Error: ", err);
            })
        },
        addData() {
          this.addDialog=true;
        },
        refresh(){
          this.addDialog=false;
          this.editDialog=false;
          this.getData();
        },
        editData(data){
          this.editDialog=true;
          this.contactData = data;
        },
        deleteData(id){
          this.deleteDialog=true;
          this.selectedId = id;
        },
        searchOnTable () {
          this.searched = searchByName(this.posts, this.search)
        },
        onConfirm(){
          Axios.delete(this.config.baseUrl + 'admin/contact/'+this.selectedId).then(res=>{
              console.log("deleted", res.data)
              this.getData();
          }).catch(err=>{
            console.log("Error: ", err);
          })
        },
        onCancel(){}
    },
    created () {
        this.getData();
    },
    computed:{
        computedProperty(){
          return this.searched = this.posts;
        }
    },
    components:{
      AddContact,
      EditContact
    }
};
</script>
<style scoped>
  .main-container{
      width:100%;
  }
 .md-table-content{
   width:100% !important;
 }
</style>