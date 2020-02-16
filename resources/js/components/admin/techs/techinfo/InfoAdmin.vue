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
        <md-dialog-title>Update data</md-dialog-title>
        <md-dialog-content>
          <EditInfo 
          v-on:close-dialog="refresh"
          :techData="techData"
          :info="info"/>
        </md-dialog-content>
      </md-dialog>
    <!-- add dialog -->
      <md-dialog :md-active.sync="addDialog">
        <md-dialog-title>Add a new data</md-dialog-title>
        <md-dialog-content>
          <AddInfo 
          v-on:close-dialog="refresh"
          :info="info"/>
        </md-dialog-content>
      </md-dialog>

    <md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
      <md-table-toolbar>
        <button class="md-button md-mini md-fab md-primary" @click="addData">
            <md-icon>add</md-icon>
        </button>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Technology data</h1>
        </div>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No tech found"
        :md-description="`No tech found for this '${search}' query. Try a different search term or create a new user.`">
        <md-button class="md-primary md-raised" @click="addData">Add a new technology</md-button>
      </md-table-empty-state>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
    
        <md-table-cell md-label="Date" md-sort-by="date">{{ item.date }}</md-table-cell>
        <md-table-cell md-label="Users" md-sort-by="user">{{ item.users }}</md-table-cell>
     
  
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
import AddInfo from "./AddInfo";
import EditInfo from "./EditInfo";
import Axios from 'axios';
import CONFIG from '../../../../config';
const toLower = text => {
  return text.toString().toLowerCase()
}

const searchByName = (items, term) => {
  if (term) {
    return items.filter(item => toLower(item.name).includes(toLower(term)))
  }
  return items
}
export default {
  name: "InfoAdmin",
  data: () => ({
    addDialog:false,
    editDialog:false,
    deleteDialog:false,
    selectedId: 0,
    search: null,
    searched: [],
    techData: {},
    info: {},
    config: CONFIG
  }),
    methods: {
        getData(){
            Axios.get(this.config.baseUrl+'admin/techs-info').then(res=>{
               this.info = res.data.techs;
               this.searched = res.data.techinfos;
            }).catch(err=>{
              console.log("Error: ", err);
            })
        },

        addData() {
          this.addDialog=true;
          this.getData();
        },
        refresh(){
          this.addDialog=false;
          this.editDialog=false;
          this.getData();
        },
        editData(data){
          this.editDialog=true;
          this.techData = data;
          this.getData();
        },
        deleteData(id){
          this.deleteDialog=true;
          this.selectedId = id;
        },
        searchOnTable () {
          this.searched = searchByName(this.posts, this.search)
        },
        onConfirm(){
          Axios.delete(this.config.baseUrl+'admin/techs-info/'+this.selectedId).then(res=>{
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
      AddInfo,
      EditInfo
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