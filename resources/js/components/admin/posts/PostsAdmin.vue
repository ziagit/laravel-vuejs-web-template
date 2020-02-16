<template>
  <div>
    <!-- delete dialog -->
      <md-dialog-confirm
      :md-active.sync="deleteDialog"
      md-title="I assure what you doing"
      md-content=""
      md-confirm-text="OK"
      md-cancel-text="Cancel"
      @md-confirm="onConfirm()"
      @md-cancel="onCancel" />
    <!-- add dialog -->
      <md-dialog :md-active.sync="addDialog">
        <md-dialog-title>Add New Post</md-dialog-title>
        <md-dialog-content>
          <AddPost 
          v-on:close-dialog="refresh"/>
        </md-dialog-content>
      </md-dialog>
      <!-- edit dialog -->
      <md-dialog :md-active.sync="editDialog">
        <md-dialog-title>Update Post</md-dialog-title>
        <md-dialog-content>
          <EditPost 
          v-on:close-dialog="refresh"
          :postData="postData"/>
        </md-dialog-content>
      </md-dialog>

    <md-table v-model="searched" md-sort="title" md-sort-order="asc" md-card md-fixed-header>
      <md-table-toolbar>
        <button class="md-button md-mini md-fab md-primary" @click="addPost()">
            <md-icon>add</md-icon>
        </button>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Post</h1>
        </div>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No posts found"
        :md-description="`No post found for this '${search}' query. Try a different search term or create a new user.`">
        <md-button class="md-primary md-raised" @click="addPost()">Create New Post</md-button>
      </md-table-empty-state>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell md-label="image">
          <img :src="config.imagePath + item.image" class="image-thumbnail" width="300">
        </md-table-cell>
        <md-table-cell md-label="Title" md-sort-by="title">{{ item.title }}</md-table-cell>
        <md-table-cell md-label="Subtitle" md-sort-by="subtitle">{{ item.subtitle }}</md-table-cell>
        <md-table-cell md-label="Body" md-sort-by="body" v-html="item.body"></md-table-cell>
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

import Axios from 'axios';
import AddPost from './AddPost';
import EditPost from './EditPost';
import CONFIG from '../../../config';
  const toLower = text => {
    return text.toString().toLowerCase()
  }

  const searchByName = (items, term) => {
    if (term) {
      return items.filter(item => toLower(item.title).includes(toLower(term)))
    }
    return items
  }
export default {
  name: "PostAdmin",
  data: () => ({
    addDialog:false,
    editDialog:false,
    search: null,
    searched: [],
    postData: '',
    deleteDialog:false,
    selectedId: 0,
    config: CONFIG,
  }),
    methods: {
        getData(){
            Axios.get(this.config.baseUrl + 'admin/post').then(res=>{
              this.searched = res.data
            }).catch(err=>{
              console.log("Error: ", err);
            })
        },
        addPost() {
          this.addDialog=true;
        },
        refresh(){
          this.addDialog=false;
          this.editDialog=false;
          this.getData();
        },
        editData(data){
          this.editDialog=true;
          this.postData = data;
        },
        deleteData(id){
          this.deleteDialog=true;
          this.selectedId = id;
        },
        searchOnTable () {
          this.searched = searchByName(this.posts, this.search)
        },
        searchOnTable () {
          this.searched = searchByName(this.posts, this.search)
        },
        onConfirm(){
          Axios.delete(this.config.baseUrl + 'admin/post/'+this.selectedId).then(res=>{
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
      AddPost, 
      EditPost
    }
};
</script>
<style scoped>
  .main-container{
      width:100%;
  }
  .md-dialog {
  width: 90% !important;
  }
 
</style>