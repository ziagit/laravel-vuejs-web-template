<template>
  <div>
    <md-card md-with-hover>
      <md-list class="md-triple-line">
        <md-subheader>Applications</md-subheader>
        <div v-for="app in apps" v-bind:key="app.id">
          <md-list-item>
            <md-avatar>
              <img :src="config.imagePath + app.image" class="image-thumbnail">
            </md-avatar>
            <div class="md-list-item-text">
              <router-link class="router-link" :to="'/app' + app.id">
                <span>{{app.title}}</span>
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
import CONFIG from '../../../config';
import Axios from 'axios';
export default {
    name: 'App',
    data: function() {
        return {
          apps: '',
          config: CONFIG
        };
    },
    methods:{
      getData(){
        Axios.get(this.config.baseUrl + 'app').then(res=>{
          this.apps = res.data;
        }).catch(err=>{
          console.log("Couldn't get data");
        })
      }
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