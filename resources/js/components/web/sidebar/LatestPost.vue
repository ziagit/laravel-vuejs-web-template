<template>
  <div>
    <md-card md-with-hover>
      <md-list class="md-triple-line">
        <md-subheader>Latest Posts</md-subheader>
        <div v-for="post in latestPost" v-bind:key="post.id">
          <md-list-item>
            <md-avatar>
              <img :src="config.imagePath + post.image" class="image-thumbnail">
            </md-avatar>
            <div class="md-list-item-text">
              <router-link class="router-link" :to="'/posts/' + post.id + '/'+ post.title.split(' ').join('-')">
                <span>{{post.title}}</span>
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
    name: 'LatestPost',
    data: function() {
        return {
          latestPost: [],
          config: CONFIG
        };
    },
    methods:{
      getData(){
        Axios.get(this.config.baseUrl + 'latest-posts').then(res=>{
          this.latestPost = res.data;
        }).catch(err=>{
          console.log("Couldn't get data");
        })
      }
    },
    created(){
      this.getData();
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