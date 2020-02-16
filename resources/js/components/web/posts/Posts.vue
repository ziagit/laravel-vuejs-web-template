<template>
  <div>
    <md-card v-for="post in posts" v-bind:key="post.id">
      <md-ripple class="md-layout">
        <div class="md-layout-item md-size-20 md-xsmall-size-100">
          <img :src="config.imagePath + post.image" class="image-thumbnail">
        </div>
        <div class="md-layout-item">
          <md-card-header>
            <div class="md-title">{{post.title}}</div>
            <div class="md-subhead">zia</div>
          </md-card-header>
          <md-card-content>{{post.subtitle}}</md-card-content>
          <md-card-actions>
            <router-link :to="'/posts/' + post.id + '/'+ post.title.split(' ').join('-')">
              <md-button>more</md-button>
            </router-link>
          </md-card-actions>
        </div>
      </md-ripple>
    </md-card>

<ul class="paginate">
  <li>
    <a href="#" @click.prevent="getPreviousPage()">
      Prev
    </a>
  </li>
  <li v-for="n in paginate.last_page">
    <a href="#" @click.prevent="getPage(n)">
    <span >
      {{n}}
    </span>
    </a>
  </li>
  <li v-show="paginate.next_page_url">
    <a href="#" @click.prevent="getNextPage()">
      Next
    </a>
  </li>
</ul>

  </div>
</template>
<script>
import Axios from "axios";
import CONFIG from '../../../config';
export default {
  name: "Posts",
  data: ()=> {
    return {
      title: 'Posts',
      posts: [],
      projects: [],
      config: CONFIG,
      paginate: {},
      curPage:'',
      prevPage: ''
    }
  },
  methods: {
    getPosts() {
      Axios.get(this.config.baseUrl + 'posts').then(res => {
          this.posts=res.data.data;
          this.paginate = res.data;
          this.curPage = res.data.
          console.log("paginate: ", this.paginate)
        }
      )
    },
    getPage(pageNo){
      Axios.get(this.config.baseUrl + 'posts?page='+pageNo).then((res)=>{
        this.posts=res.data.data;
      },(res)=>{
      });
    },
    getPreviousPage(){
      let pageNo = this.paginate.current_page-1;
      Axios.get(this.config.baseUrl+'posts?page='+pageNo).then((res)=>{
          this.posts=res.data.data;
      },(res)=>{
      });
    },
    getNextPage(){
      let pageNo = this.paginate.current_page+1;
      Axios.get(this.config.baseUrl+'posts?page='+pageNo).then((res)=>{
          this.posts=res.data.data;
      },(res)=>{
      });
    },
  },
  created(){
    this.getPosts();
    document.title = this.title;
  }
};
</script>
<style lang="scss" scoped>
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
  .md-button {
    color: #35495e !important;
  }
  .md-button:hover {
    background: #41b883;
  }
  .md-layout{
    align-items: center;
  }
  .paginate{
    display: flex;
    li{
      list-style:none;
      margin: 2px;
      a{
        color: #41b883;
      }
    }
  }
}
</style>