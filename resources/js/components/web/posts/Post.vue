<template>
  <div class="container">
    <md-dialog :md-active.sync="showDialog">
        <md-dialog-content>
          <AddComment
          v-on:close-dialog="refresh"
          :pId='pId'/>
        </md-dialog-content>
      </md-dialog>
    <md-card>
        <img :src="config.imagePath + post.image">
        <md-card-header>
          <h1 class="md-title">{{post.title}}</h1>
        </md-card-header>
        <md-card-content v-html="post.body"></md-card-content>
    </md-card>
      <md-button v-if="post" class="button-comment" @click="commentDialog()">Comment</md-button>

      <md-card>
        <md-card-header v-show="post.comments != null"><h3>Comments</h3></md-card-header>
        <div v-for="comment in post.comments" :key="comment.id">
            <span class="user-img">{{comment.user_name}}</span> /
            <span>{{comment.created_at}}</span>
          <md-card-content class="comment" v-html="comment.comment">
          </md-card-content>
        </div>
      </md-card>
  </div>
</template>
<script>
import Axios from 'axios';
import CONFIG from '../../../config';
import AddComment from './AddComment';
export default {
  name: "Post",
  props: ['postId'],
  data: ()=>{
    return {
      title: 'Monkey Class',
      config: CONFIG,
      post: [],
      showDialog: false,
      pId: null
    }
  },
  methods:{
    getPost(){
      Axios.get(this.config.baseUrl + 'posts/'+ this.postId).then(res=>{
        this.post = res.data;
        document.title = this.post.title;
      }).catch(err=>{
        console.log("Faild to load data", err)
      })
    },
    commentDialog(){
      this.showDialog = true;
      this.pId = this.postId;
    },
    refresh(){
      this.showDialog=false;
      this.getPost();
    },
  },
  created(){
    this.getPost();
  },
  components:{
    AddComment
  }
};
</script>
<style lang="scss" scoped>

/* on mobile browsers, I set a width of 100% */
@media (min-width: 300px) {
  .md-card{
    padding:0 !important;
  }
  .md-card-content{
    width: 260px;
  }
}
@media (min-width: 375px) {
  .md-card{
    padding:0 !important;
  }
  .md-card-content{
    width: 276px;
  }
}
@media (min-width: 530px) {
  .md-card{
    padding:0 !important;
  }
  .md-card-content{
    width: 440px;
  }
}
@media (min-width: 601px) {
  .md-card-content{
    width: 440px;
  }
}
@media (min-width: 768px) {
  .md-card-content{
    width: 619px;
  }
}
@media (min-width: 992px) {
  .md-card-content{
    width: 631px;
  }
}
@media (min-width: 1200px) {
  .md-card-content{
    width: 759px;
  }
}

.md-card {
  color: #35495e;
  text-align: left;
  box-shadow: none;
  .md-title {
    font-size: 22px;
    font-weight: 600;
  }
  .md-card-content {
    font-size: 16px;
  }
}
.comment{
  padding-left: 20px;
  /* border-left: 5px solid #aadec7; */
/*   border-radius: 10px; */
}
.md-dialog{
    width: 90% !important;
    .md-dialog-content{
      padding: 0 !important;
    }
}
.button-comment{
  background: #41b883;
  color: #fff;
}
</style>