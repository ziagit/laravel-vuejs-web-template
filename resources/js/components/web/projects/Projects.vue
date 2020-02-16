<template>
  <div>
    <md-card md-with-hover>
      <md-list class="md-triple-line">
        <md-subheader>List of Projects</md-subheader>
        <div v-for="project in projects" v-bind:key="project.id">
          <md-list-item>
            <md-avatar>
              <img :src="config.imagePath + project.image" class="image-thumbnail" width="50">
            </md-avatar>
            <div class="md-list-item-text">
              <router-link class="router-link" :to="'/projects/'+ project.id + '/'+ project.title.split(' ').join('-')">
                <span>{{project.title}}</span>
              </router-link>
            </div>
          </md-list-item>
          <md-divider class="md-inset"></md-divider>
        </div>
      </md-list>
    </md-card>
  </div>
</template>

<script>
import Axios from 'axios';
import CONFIG from '../../../config';
import Project from './Project';
export default {
    name: 'Projects',
    data: function() {
        return {
          projects: '',
          config: CONFIG
        }
    },
    methods:{
      getProjects(){
        Axios.get(this.config.baseUrl + 'projects').then(res=>{
          this.projects = res.data;
        }).catch(err=>{
          console.log("Couldn't get projects");
        })
      },
    },
    created(){
      this.getProjects();
    }
}
</script>

<style lang="scss" scoped>
.md-card {
  margin-bottom: 5px;
  box-shadow: none;
  .md-list {
    color: #35495e;
    .router-link{
      color: #41b883;
    }
  }
}
</style>